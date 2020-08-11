<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;

use app\models\Colaborador;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'id_colaborador')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Colaborador::find()->all(), 'id', 'nome'),
    'options' => ['placeholder' => 'Select um colaborador ...'],
    'pluginOptions' => [
      'allowClear' => true     
    ],
  ]);
  ?>

  <div class="row">
    <div class="col-md-6">
      <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
      <?= $form->field($model, 'senha')->passwordInput(['maxlength' => true]) ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
    <?= $form->field($model, 'nivel_acesso')->dropdownlist(['IGREJA' => 'Igreja', 'CIDADE' => 'Cidade', 'DISTRITO' => 'Distrito', 'REGIONAL' => 'Regional', 'FULL' => 'Geral']) ?>
    </div>
  </div>
  
  <?= $form->field($model, 'demonstracao')->widget(SwitchInput::classname(), []); ?>

  <?= $form->field($model, 'modulo_ids')
    ->checkboxList($modules, ['multiple' => true])
  ?>


  <div class="form-group">
      <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
