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
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tickets-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{summary}<br\/>{items}<br\/>{summary}<br\/><div class="text-center">{pager}</div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app/modules/tickets', 'Actions'),
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
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

    <div>
        <!-- ?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to module'), ['../admin/tickets'], ['class' => 'btn btn-default pull-left']) ? -->
        <?= Html::a(Yii::t('app/modules/tickets', 'Add new ticket'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
