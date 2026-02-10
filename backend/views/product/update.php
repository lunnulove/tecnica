<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'description')->textarea([
        'rows' => 4,
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'sku')->textInput([
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'price')->input('number', [
        'step' => '0.01',
        'min' => 0
    ]) ?>

    <?= $form->field($model, 'stock')->input('number', [
        'min' => 0
    ]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
