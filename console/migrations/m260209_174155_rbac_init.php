<?php

use yii\db\Migration;

class m260209_174155_rbac_init extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Crear roles
        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');
        $viewer = $auth->createRole('viewer');

        $auth->add($admin);
        $auth->add($editor);
        $auth->add($viewer);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        return true;
    }
}
