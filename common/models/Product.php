<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['name', 'sku', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number', 'min' => 0],
            [['stock'], 'integer', 'min' => 0],
            [['sku'], 'unique'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'sku' => 'SKU',
            'price' => 'Precio',
            'stock' => 'Stock',
        ];
    }
}
