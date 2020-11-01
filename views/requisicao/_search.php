<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\RequisicaoSearch */
/* @var $form yii\widgets\ActiveForm */

$filterTipo = [
    ""=>"Todos",
    "Coleta"=>"Coleta", 
    "Distribuicao"=>"Distribuição"];

$filterStatus = [
    ""=>"Todos",
    "Coleta"=>"Coleta", 
    "Expurgo"=>"Expurgo",
    "Processada"=>"Processada"];
?>

<div class="requisicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
        ],
        
    ]); ?>

    <div class="row">
        <div class='col-md-4'>
            <?= $form->field($model, 'tipo')->widget(Select2::class, ['data' => $filterTipo]) ?>
        </div>
        <div class='col-md-4'>
            <?= $form->field($model, 'status')->widget(Select2::class, ['data' => $filterStatus]) ?>
        </div>
        <div class='col-md-4'>
            <div class="form-group">
                <br/>
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
