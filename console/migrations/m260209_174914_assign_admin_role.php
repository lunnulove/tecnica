<?php

use yii\db\Migration;

class m260209_174914_assign_admin_role extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');

        $auth->assign($admin, 1);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        $auth->revoke($admin, 1);
    }
}
