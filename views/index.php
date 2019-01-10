<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tickets\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tickets', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/modules/tickets', 'Create Tickets'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subunit',
            'subject',
            'message:ntext',
            'user_id',
            //'assigned_id',
            //'task_id',
            //'access_token',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
