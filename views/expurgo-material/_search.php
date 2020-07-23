<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpurgoMaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expurgo-material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'expurgo_id') ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'carga_id') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'quantidade') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
