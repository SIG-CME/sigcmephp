<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpurgoMaterial */

$this->title = Yii::t('app', 'Create Expurgo Material');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expurgo Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expurgo-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
