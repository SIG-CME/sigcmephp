<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpurgoMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expurgo-material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'expurgo_id')->textInput() ?>

    <?= $form->field($model, 'material_id')->textInput() ?>

    <?= $form->field($model, 'carga_id')->textInput() ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
