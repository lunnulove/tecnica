<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $user common\models\User */
/** @var $roles yii\rbac\Role[] */
/** @var $assigned array */
/** @var $permissions array */

$this->title = 'Asignar Roles y Permisos a ' . Html::encode($user->username);
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['readonly' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['readonly' => true]) ?>
    <?= $form->field($user, 'status')->dropDownList([10 => 'Activo', 0 => 'Inactivo'], ['disabled' => true]) ?>

    <hr>
<h4>Roles</h4>
<div class="form-group">
    <?php foreach ($roles as $roleName => $roleObj): ?>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="roles[]"
                       value="<?= Html::encode($roleName) ?>"
                    <?= in_array($roleName, $assigned) ? 'checked' : '' ?>>
                <?= Html::encode($roleObj->description ?: $roleName) ?>
            </label>
        </div>
    <?php endforeach; ?>
</div>


    <hr>
    <h4>Permisos por módulo</h4>
    <div class="form-group">
        <?php foreach ($permissions as $module => $perms): ?>
            <h5><?= Html::encode($module) ?></h5>
            <div class="d-flex gap-3 mb-2">
                <?php foreach (['view' => 'Ver', 'create' => 'Crear', 'update' => 'Editar', 'delete' => 'Eliminar'] as $permKey => $permLabel): ?>
                    <?php 
                        $permName = "{$module}.{$permKey}"; 
                        $checked = in_array($permName, $assigned);
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="permissions[]" 
                               value="<?= $permName ?>" 
                               <?= $checked ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $permLabel ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar Roles y Permisos', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
