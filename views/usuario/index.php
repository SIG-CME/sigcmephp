<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <a onclick="$('.usuario-search').toggle()"><?= Yii::t('app', 'Advanced Search') ?></a>

    <p class="text-right">
        <?= Html::a(Yii::t('app', 'Create Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'colaborador.nome'],
            'usuario',
            'nivel_acesso',
            ['attribute' => 'demonstracao', 'label' => 'Demonstração'],
            ['class' => 'app\components\MyActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<style>
a{
    cursor: pointer;
}
.usuario-index .btn{
    margin-top: 10px;
}
.usuario-index .usuario-search{
    display: none;
    padding-top: 10px;
}
</style>
