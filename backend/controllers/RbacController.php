<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $permissions = [
            'product.view'   => 'Ver productos',
            'product.create' => 'Crear productos',
            'product.update' => 'Editar productos',
            'product.delete' => 'Eliminar productos',
        ];

        foreach ($permissions as $name => $desc) {
            if ($auth->getPermission($name) === null) {
                $perm = $auth->createPermission($name);
                $perm->description = $desc;
                $auth->add($perm);
            }
        }

        $roles = ['admin', 'editor', 'viewer'];

        foreach ($roles as $roleName) {
            if ($auth->getRole($roleName) === null) {
                $auth->add($auth->createRole($roleName));
            }
        }

        $admin  = $auth->getRole('admin');
        $editor = $auth->getRole('editor');
        $viewer = $auth->getRole('viewer');

        foreach ($permissions as $name => $desc) {
            $perm = $auth->getPermission($name);
            if (!$auth->hasChild($admin, $perm)) {
                $auth->addChild($admin, $perm);
            }
        }

        foreach (['product.view','product.create','product.update'] as $p) {
            $perm = $auth->getPermission($p);
            if (!$auth->hasChild($editor, $perm)) {
                $auth->addChild($editor, $perm);
            }
        }

        $view = $auth->getPermission('product.view');
        if (!$auth->hasChild($viewer, $view)) {
            $auth->addChild($viewer, $view);
        }

        if (!$auth->getAssignment('admin', 1)) {
            $auth->assign($admin, 1);
        }

        echo "RBAC inicializado correctamente \n";
    }
}
