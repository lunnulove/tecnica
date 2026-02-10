<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $user common\models\User */
/** @var $permisos yii\rbac\Permission[] */
/** @var $assigned array */

$this->title = 'Asignar Permisos a ' . Html::encode($user->username);
?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>

<div class="form-group">
    <?php
    $modulos = [];
    foreach ($permisos as $perm) {
        [$mod, $accion] = explode('-', $perm->name);
        $modulos[$mod][$perm->name] = ucfirst($accion);
    }

    foreach ($modulos as $modulo => $acciones): ?>
        <h5><?= ucfirst($modulo) ?></h5>
        <?php foreach ($acciones as $permName => $accionLabel): ?>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="permisos[]"
                           value="<?= $permName ?>"
                        <?= in_array($permName, $assigned) ? 'checked' : '' ?>>
                    <?= Html::encode($accionLabel) ?>
                </label>
            </div>
        <?php endforeach; ?>
        <hr>
    <?php endforeach; ?>
</div>

<div class="form-group mt-3">
    <?= Html::submitButton('Guardar Permisos', ['class' => 'btn btn-success']) ?>
    <?= Html::a('Volver', ['index'], ['class' => 'btn btn-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>
