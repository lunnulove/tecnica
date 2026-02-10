<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'status')->dropDownList([
    10 => 'Activo',
    0 => 'Inactivo'
]) ?>

<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
