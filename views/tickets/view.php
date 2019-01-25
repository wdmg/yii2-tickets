<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use wdmg\helpers\DateAndTime;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['list/all']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tickets-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'subject',
            'message:ntext',
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tickets', 'User'),
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
                'label' => Yii::t('app/modules/tickets', 'Assigned user'),
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
                'label' => Yii::t('app/modules/tickets', 'Task'),
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
                'label' => Yii::t('app/modules/tickets', 'Subunit'),
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
                'attribute' => 'access_token',
                'format' => 'html',
                'value' => function($model) {
                    if($model->access_token)
                        return Html::a($model->access_token, '#'.$model->access_token, [
                            'target' => '_blank',
                            'data-pjax' => 0
                        ]);
                    else
                        return $model->$model->access_token;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->created_at) . DateAndTime::diff($data->created_at." ", null, [
                            'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                            'inpastClass' => 'text-danger',
                            'futureClass' => 'text-success',
                        ]);
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->updated_at) . DateAndTime::diff($data->updated_at." ", null, [
                            'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                            'inpastClass' => 'text-danger',
                            'futureClass' => 'text-success',
                        ]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
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
        ],
    ]) ?>

    <h3 class="page-header"><?= Yii::t('app/modules/tickets', 'Messages') ?></h3>
    <?php Pjax::begin(); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($data, $key, $index, $widget) use ($model) {
            if ($data->ticket_id == $model->id) {
                ?>
                <dl id="ticketMessage-<?= $data->ticket_id ?>" class="dl-horizontal border-bottom">
                    <dt><?= Yii::t('app/modules/tickets', 'User') ?>:</dt>
                    <dd><?php
                        if($data->sender_id == $data->sender['id'])
                            if($data->sender['id'] && $data->sender['username'])
                                echo Html::a($data->sender['username'], ['../admin/users/view/?id='.$data->sender['id']], [
                                    'target' => '_blank',
                                    'data-pjax' => 0
                                ]);
                            else
                                echo $data->sender_id;
                        else
                            echo $data->sender_id;

                    ?></dd>
                    <dt><?= Yii::t('app/modules/tickets', 'Date/time') ?>:</dt>
                    <dd><?= \Yii::$app->formatter->asDatetime($data->created_at, 'long') ?></dd>
                    <dt><?= Yii::t('app/modules/tickets', 'Message text') ?>:</dt>
                    <dd><?= $data->message ?></dd>
                    <?php if ($data->attachment_id) : ?>
                        <?php if (($data->attachment_id == $data->attachment['id']) && ($data->sender_id == $data->attachment['sender_id'])) : ?>
                            <dt><?= Yii::t('app/modules/tickets', 'Attachment') ?>:</dt>
                            <dd><?= Html::a($data->attachment['filename'], "#", ['id' => 'ticketAttachment-'.$data->attachment_id]) ?></dd>
                        <? endif; ?>
                    <? endif; ?>
                </dl>
                <?php
            }
            return;
        }
    ]); ?>

    <?php Pjax::end(); ?>
    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to list'), ['tickets/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app/modules/tickets', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/tickets', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/tickets', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
