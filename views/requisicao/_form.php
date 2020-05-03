<?php

use app\models\Material;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use app\models\Unidade;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */
/* @var $form yii\widgets\ActiveForm */

$unidades = Unidade::find()->all();
$listUnidades = ArrayHelper::map($unidades, 'id', 'descricao');

$materiais = Material::find()->all();
$listMateriais = ArrayHelper::map($materiais, 'id', 'nome');

?>

<div class="requisicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->widget(DatePicker::className(), ['language' => 'pt-BR']) ?>

    <?= $form->field($model, 'unidadeid')->widget(Select2::className(), ['data' => $listUnidades]) ?>

    <?= $form->field($model, 'material_ids')->widget(
        Select2::className(),
        [
            'data' => $listMateriais,
            'options' => ['placeholder' => 'Selecione os materiais', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]
    )
        /* or, you may use a checkbox list instead */
        /* ->checkboxList($categories) */
        ->hint('Selecione os materiais dessa requisição.');
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>