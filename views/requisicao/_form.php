<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Unidade;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */
/* @var $form yii\widgets\ActiveForm */
$unidades = Unidade::find()->all(); 
$listUnidades=ArrayHelper::map($unidades,'id','descricao'); 
?>

<div class="requisicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'unidadeid')->dropDownList($listUnidades) ?>

    <div class="form-group">
        <label class="control-label">Inserir materiais</label>
        Em construção...
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
