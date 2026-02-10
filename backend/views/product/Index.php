<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (Yii::$app->user->can('product.create')): ?>
    <p>
        <?= Html::a('Nuevo producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>

<div class="card mb-3">
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
        ]); ?>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($searchModel, 'name')->textInput(['placeholder' => 'Nombre']) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'sku')->textInput(['placeholder' => 'SKU']) ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($searchModel, 'price_from')->textInput(['placeholder' => 'Desde']) ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($searchModel, 'price_to')->textInput(['placeholder' => 'Hasta']) ?>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary me-2']) ?>
                <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',
            'sku',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return '$ ' . number_format($model->price, 2);
                },
            ],
            'stock',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>
                    (Yii::$app->user->can('product.update') ? '{update} ' : '') .
                    (Yii::$app->user->can('product.delete') ? '{delete}' : ''),
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('Editar', $url, ['class' => 'btn btn-sm btn-primary me-1']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Eliminar', $url, [
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => '¿Eliminar producto?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
