<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

class ProductSearch extends Product
{
    public $price_from;
    public $price_to;

    public function rules()
    {
        return [
            [['name', 'sku'], 'safe'],
            [['price_from', 'price_to'], 'number'],
        ];
    }

        public function attributeLabels()
        {
            return [
                'name'       => 'Nombre',
                'sku'        => 'SKU',
                'price_from' => 'Precio desde',
                'price_to'   => 'Precio hasta',
            ];
        }


    public function search($params)
    {
        $query = Product::find()->where(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'sku', $this->sku]);

        $query->andFilterWhere(['>=', 'price', $this->price_from])
              ->andFilterWhere(['<=', 'price', $this->price_to]);

        return $dataProvider;
    }
}
