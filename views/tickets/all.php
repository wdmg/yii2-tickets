<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tickets\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tickets', 'All tickets');
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

            'subject',
            'message:ntext',
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'header' => Yii::t('app/modules/tickets', 'User'),
                'value' => function($model) {
                    if($model->user_id == $model->user['id'])
                        if($model->user['id'] && $model->user['username'])
                            return Html::a($model->user['username'], ['../admin/users/view/?id='.$model->user['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->user_id;
                    else
                        return $model->user_id;
                }
            ],
            [
                'attribute' => 'assigned_id',
                'format' => 'html',
                'header' => Yii::t('app/modules/tickets', 'Assigned user'),
                'value' => function($model) {
                    if($model->assigned_id == $model->assigned['id'])
                        if($model->assigned['id'] && $model->assigned['username'])
                            return Html::a($model->assigned['username'], ['../admin/users/view/?id='.$model->assigned['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->assigned_id;
                    else
                        return $model->assigned_id;
                }
            ],
            [
                'attribute' => 'task_id',
                'format' => 'html',
                'header' => Yii::t('app/modules/tickets', 'Task'),
                'value' => function($model) {
                    if($model->task_id == $model->task['id'])
                        if($model->task['id'] && $model->task['title'])
                            return Html::a($model->task['title'], ['../admin/tasks/item/view/?id='.$model->task['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->id;
                    else
                        return $model->id;
                }
            ],
            [
                'attribute' => 'subunit_id',
                'format' => 'html',
                'header' => Yii::t('app/modules/tickets', 'Subunit'),
                'value' => function($model) {
                    if($model->subunit_id == $model->subunit['id'])
                        if($model->subunit['id'] && $model->subunit['title'])
                            return Html::a($model->subunit['title'], ['../admin/tasks/subunits/view/?id='.$model->subunit['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->subunit_id;
                    else
                        return $model->subunit_id;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function($data) {

                    if ($data->status == $data::TK_STATUS_OPEN)
                        return '<span class="label label-danger">'.Yii::t('app/modules/tickets','Open').'</span>';
                    elseif ($data->status == $data::TK_STATUS_WATING)
                        return '<span class="label label-info">'.Yii::t('app/modules/tickets','Waiting').'</span>';
                    elseif ($data->status == $data::TK_STATUS_INWORK)
                        return '<span class="label label-warning">'.Yii::t('app/modules/tickets','In Work').'</span>';
                    elseif ($data->status == $data::TK_STATUS_CLOSED)
                        return '<span class="label label-success">'.Yii::t('app/modules/tickets','Closed').'</span>';
                    else
                        return false;

                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app/modules/tickets', 'Actions'),
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'urlCreator' => function ($action, $model, $key, $index) {

                    if ($action === 'view')
                        return \yii\helpers\Url::toRoute(['item/view', 'id' => $key]);

                    if ($action === 'update')
                        return \yii\helpers\Url::toRoute(['item/update', 'id' => $key]);

                    if ($action === 'delete')
                        return \yii\helpers\Url::toRoute(['item/delete', 'id' => $key]);

                }
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

    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
