<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Requisições');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Requisicao'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Criar Expurgo'), ['create-expurgo'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'data:date',
            'tipo',
            'status',
            ['attribute' => 'unidade.descricao'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{materiais}',
                'header' => 'Materiais',
                'buttons' => [
                    'materiais' => function ($url) {
                        return Html::a(
                            '<span class="btn btn-info glyphicon glyphicon-barcode"></span>',
                            $url, 
                            [
                                'title' => 'Materiais',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{distribuicao}',
                    'header' => 'Distribuição',
                    'buttons' => [
                        'distribuicao' => function ($url, $model) {
                            return $model->tipo != 'Coleta' ? '': Html::a(
                                '<span class="btn btn-light glyphicon glyphicon-road"></span>',
                                $url, 
                                [
                                    'title' => 'Distribuição',
                                    'data-pjax' => '0',
                                ]
                            );
                        },
                    ]
                    ],
            ['header'=> 'Ações','class' => 'app\components\MyActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
