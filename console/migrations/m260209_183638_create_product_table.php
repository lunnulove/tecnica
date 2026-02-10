<?php

use yii\db\Migration;

class m260209_183638_create_product_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'sku' => $this->string(50)->notNull()->unique(),
            'price' => $this->decimal(10,2)->notNull(),
            'stock' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('idx-product-sku', '{{%product}}', 'sku');
    }

    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
