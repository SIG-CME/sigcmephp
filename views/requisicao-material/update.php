<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequisicaoMaterial */

$this->title = Yii::t('app', 'Update Requisicao Material: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requisicao Materiais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="requisicao-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'materiaisDisponiveis'=>$materiaisDisponiveis
    ]) ?>

</div>
