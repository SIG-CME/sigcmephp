<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Carga */
/* @var $form yii\widgets\ActiveForm */
$categorias = Categoria::find()->all(); 
$listCategoria=ArrayHelper::map($categorias,'id','descricao'); 
?>

<div class="carga-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoriaid')->dropDownList($listCategoria) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
