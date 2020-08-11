<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Expurgo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expurgos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expurgo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data:date'
        ],
    ]) ?>
    <hr />
    <h3>Materiais</h3>
    <?= GridView::widget([
        'dataProvider' => $materiais,
        'columns' => [
            ['attribute' => 'material.nome'],
            'quantidade',
            [
                'label' => 'Foi para Carga',
                'value' => function ($model) {
                    return $model->carga_id > 0 ? 'Sim' : 'Não';
                }
              ],
            'observacao',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{editar}',
                'header' => 'Editar Observacao',
                'buttons' => [
                    'editar' => function ($url, $model) {
                        return Html::a(
                            '<span class="btn btn-light glyphicon glyphicon-pencil"></span>',
                            Url::to(['expurgo-material/update', 'id' => $model->id]),
                            [
                                'title' => 'editar',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ]
            ],
        ],
    ]); ?>

</div>