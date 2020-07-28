<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Carga */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carga-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data:date',
            'categoria.descricao',
        ],
    ]) ?>

    <hr />
    <h3>Materiais</h3>
    <?= GridView::widget([
        'dataProvider' => $materiais,
        'columns' => [
            'expurgo_id',
            ['attribute' => 'material.nome'],
            'quantidade',
        ],
    ]); ?>

</div>