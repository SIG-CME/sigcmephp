<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;

use app\models\Colaborador;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_colaborador')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Colaborador::find()->all(), 'id', 'nome'),
        'options' => ['placeholder' => 'Select um colaborador ...'],
        'pluginOptions' => [
        'allowClear' => true     
        ],
    ]);
    ?>

    <?= $form->field($model, 'usuario') ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'nivel_acesso')->dropdownlist(['IGREJA' => 'Igreja', 'CIDADE' => 'Cidade', 'DISTRITO' => 'Distrito', 'REGIONAL' => 'Regional', 'FULL' => 'Geral']) ?>
        </div>
    </div>
  
    <?= $form->field($model, 'demonstracao')->widget(SwitchInput::classname(), []); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
