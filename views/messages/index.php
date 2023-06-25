<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tickets\models\TicketsMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tickets', 'Tickets Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-messages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/modules/tickets', 'Create Tickets Messages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ticket_id',
            'sender_id',
            'message:ntext',
            'created_at',
            //'updated_at',
            //'attachment_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pager' => [
            'options' => [
                'class' => 'pagination',
            ],
            'maxButtonCount' => 5,
            'activePageCssClass' => 'active',
            'linkContainerOptions' => [
                'class' => 'linkContainerOptions',
            ],
            'linkOptions' => [
                'class' => 'linkOptions',
            ],
            'prevPageCssClass' => '',
            'nextPageCssClass' => '',
            'firstPageCssClass' => 'previous',
            'lastPageCssClass' => 'next',
            'firstPageLabel' => Yii::t('app/modules/tickets', 'First page'),
            'lastPageLabel'  => Yii::t('app/modules/tickets', 'Last page'),
            'prevPageLabel'  => Yii::t('app/modules/tickets', '&larr; Prev page'),
            'nextPageLabel'  => Yii::t('app/modules/tickets', 'Next page &rarr;')
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
