<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Material;

/* @var $this yii\web\View */
/* @var $model app\models\RequisicaoMaterial */
/* @var $form yii\widgets\ActiveForm */


$materiais = Material::find()->all();
$listMateriais = ArrayHelper::map($materiais, 'id', 'nome');
?>

<div class="requisicao-material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->widget(Select2::className(), ['data' => $listMateriais]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
