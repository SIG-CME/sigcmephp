<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carga */

$this->title = Yii::t('app', 'Create Carga');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
