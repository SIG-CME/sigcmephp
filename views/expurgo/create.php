<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expurgo */

$this->title = Yii::t('app', 'Create Expurgo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expurgos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expurgo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
