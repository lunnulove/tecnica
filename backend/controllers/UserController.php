<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'], 
                    ],
                ],
            ],
            'verbs' => [
    'class' => VerbFilter::class,
    'actions' => [
        'delete' => ['POST'],
        'toggle-status' => ['POST'],
    ],
],

        ];
    }


    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            if (empty($model->password)) {
                $model->addError('password', 'Debe ingresar una contraseña');
                return $this->render('create', compact('model'));
            }

            $model->setPassword($model->password);
            $model->generateAuthKey();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Usuario creado');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (!empty($model->password)) {
                $model->setPassword($model->password);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Usuario actualizado');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        $model->save(false);

        Yii::$app->session->setFlash('info', 'Usuario desactivado');
        return $this->redirect(['index']);
    }


public function actionRoles($id)
{
    $user = $this->findModel($id);
    $auth = Yii::$app->authManager;

    $roles = $auth->getRoles();
    
    $assigned = ArrayHelper::getColumn($auth->getAssignments($id), 'roleName');
    
    $allPermissions = $auth->getPermissions();
    $permissions = [];
    foreach ($allPermissions as $perm) {
        if (strpos($perm->name, '.') !== false) {
            list($module, $action) = explode('.', $perm->name);
            $permissions[$module][$action] = $perm;
            if ($auth->getAssignment($perm->name, $id)) {
                $assigned[] = $perm->name;
            }
        }
    }

    if (Yii::$app->request->isPost) {
        $newRoles = Yii::$app->request->post('roles', []);
        $newPerms = Yii::$app->request->post('permissions', []);

        $auth->revokeAll($id);

        foreach ($newRoles as $roleName) {
            if ($role = $auth->getRole($roleName)) {
                $auth->assign($role, $id);
            }
        }

        foreach ($newPerms as $permName) {
            if ($perm = $auth->getPermission($permName)) {
                $auth->assign($perm, $id);
            }
        }

        Yii::$app->session->setFlash('success', 'Roles y permisos actualizados');
        return $this->redirect(['index']);
    }

    return $this->render('roles', compact('user', 'roles', 'assigned', 'permissions'));
}


    public function actionPermisos($id)
    {
        $user = $this->findModel($id);
        $auth = Yii::$app->authManager;

        $permisos = $auth->getPermissions();

        $assigned = array_keys($auth->getPermissionsByUser($id));

        if (Yii::$app->request->isPost) {
            $newPerms = Yii::$app->request->post('permisos', []);

            foreach ($auth->getPermissionsByUser($id) as $perm) {
                $auth->revoke($perm, $id);
            }

            foreach ($newPerms as $permName) {
                if ($perm = $auth->getPermission($permName)) {
                    $auth->assign($perm, $id);
                }
            }

            Yii::$app->session->setFlash('success', 'Permisos actualizados');
            return $this->redirect(['index']);
        }

        return $this->render('permisos', compact('user', 'permisos', 'assigned'));
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Usuario no encontrado');
    }
    public function actionToggleStatus($id)
{
    $model = $this->findModel($id);

    if ($model->status == User::STATUS_ACTIVE) {
        $model->status = User::STATUS_DELETED;
        Yii::$app->session->setFlash('info', 'Usuario desactivado');
    } else {
        $model->status = User::STATUS_ACTIVE;
        Yii::$app->session->setFlash('success', 'Usuario activado');
    }

    $model->save(false);

    return $this->redirect(['index']);
}

}
