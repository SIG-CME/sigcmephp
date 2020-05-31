<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\RequisicaoMaterial */
/* @var $form yii\widgets\ActiveForm */


$listMateriais = ArrayHelper::map($materiaisDisponiveis, 'id', 'nomecat');

?>

<div class="requisicao-material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->widget(Select2::className(), 
        ['data' => $listMateriais,
        'pluginOptions' => [
            'allowClear' => true
        ]]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Adicionar'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Voltar para listagem'), Url::toRoute('/requisicao/index'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
