<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User[] $users */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Estado</th>
                <th style="width: 220px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($dataProvider->getModels() as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= Html::encode($user->username) ?></td>
                    <td><?= Html::encode($user->email) ?></td>
                    <td>
                        <?= $user->status == 10 ? 'Activo' : 'Inactivo' ?>
                    </td>
                    <td>
                        <?= Html::a('Editar', ['update', 'id' => $user->id], [
                            'class' => 'btn btn-sm btn-primary'
                        ]) ?>

                        <?= Html::a('Roles', ['roles', 'id' => $user->id], [
                            'class' => 'btn btn-sm btn-warning'
                        ]) ?>

                    <?php if ($user->status == 10): ?>
                        <?= Html::a('Desactivar', ['toggle-status', 'id' => $user->id], [
                            'class' => 'btn btn-sm btn-danger',
                            'data-confirm' => '¿Deseas desactivar este usuario?',
                            'data-method' => 'post',
                        ]) ?>
                    <?php else: ?>
                        <?= Html::a('Activar', ['toggle-status', 'id' => $user->id], [
                            'class' => 'btn btn-sm btn-success',
                            'data-confirm' => '¿Deseas activar este usuario?',
                            'data-method' => 'post',
                        ]) ?>
                    <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
