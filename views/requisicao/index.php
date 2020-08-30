<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;

$this->title = Yii::t('app', 'Requisições');
$this->params['breadcrumbs'][] = $this->title;
echo Dialog::widget();

$js = <<< JS
$("#btn-criar-expurgo").on("click", function() {
    var keys = $('#gridReq').yiiGridView('getSelectedRows');
    if (!keys){
        krajeeDialog.alert("Nenhuma requisição selecionada. Somente requisições com status Coleta podem ser enviadas a expurgo.");
        return;
    }
    krajeeDialog.confirm("Tem certeza que deseja criar o expurgo?", function (result) {
        if (result) {
            window.location.href = '/requisicao/create-expurgo/?keys='+keys;
        };
    });
});
JS;

// register your javascript
$this->registerJs($js);

?>
<div class="requisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Requisicao'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Criar Expurgo'), null, ['class' => 'btn btn-primary', 'id' => 'btn-criar-expurgo', 'title' => 'Somente para requisições com Status = Coleta']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'gridReq',
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'Expurgo',
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    if ($model->status == "Coleta") {
                        return ['value' => $key];
                    }
                    return ['style' => ['display' => 'none']]; // OR ['disabled' => true]
                },
            ],
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
                        return $model->tipo != 'Coleta' ? '' : Html::a(
                            '<span class="btn btn-primary">Criar distribuição</span>',
                            $url,
                            [
                                'title' => 'Distribuição',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ]
            ],
            ['header' => 'Ações', 'class' => 'app\components\MyActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>