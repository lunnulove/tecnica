<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model common\models\User */

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        10 => 'Activo',
        0 => 'Inactivo'
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput()->hint('Dejar vacío para generar contraseña aleatoria') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
