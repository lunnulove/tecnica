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
            'product.update' => 'Actualizar productos',
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

        $auth->addChild($viewer, $auth->getPermission('product.view'));

        $auth->addChild($editor, $viewer);
        $auth->addChild($editor, $auth->getPermission('product.create'));
        $auth->addChild($editor, $auth->getPermission('product.update'));

        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $auth->getPermission('product.delete'));

        if ($auth->getAssignment('admin', 1) === null) {
            $auth->assign($admin, 1);
        }

        echo "RBAC configurado correctamente ✅\n";
    }
}
