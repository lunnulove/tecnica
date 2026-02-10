<?php
use yii\db\Migration;

class m260209_175543_rbac_permissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Crear usuarios';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Actualizar usuarios';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Eliminar usuarios';
        $auth->add($deleteUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'Ver usuarios';
        $auth->add($viewUser);

        $admin = $auth->getRole('admin');
        $editor = $auth->getRole('editor');
        $viewer = $auth->getRole('viewer');

        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);
        $auth->addChild($admin, $viewUser);

        $auth->addChild($editor, $updateUser);
        $auth->addChild($editor, $viewUser);

        $auth->addChild($viewer, $viewUser);
    }

    public function safeDown()
    {
        Yii::$app->authManager->removeAll();
    }
}
