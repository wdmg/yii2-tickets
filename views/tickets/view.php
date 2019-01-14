<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['index']];
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
            'user_id',
            'assigned_id',
            [
                'attribute' => 'task_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tickets', 'Task'),
                'value' => function($model) {
                    if($model->task_id == $model->task['id'])
                        return Html::a($model->task['title'], ['../admin/tasks/view/?id='.$model->task['id']], [
                            'target' => '_blank',
                            'data-pjax' => 0
                        ]);
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
                        return Html::a($model->subunit['title'], ['../admin/tasks/subunits/view/?id='.$model->subunit['id']], [
                            'target' => '_blank',
                            'data-pjax' => 0
                        ]);
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

                    $datenow = new DateTime("now");
                    $created = new DateTime($data->created_at);
                    $interval = $datenow->diff($created);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->created_at) . $along;
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $updated = new DateTime($data->updated_at);
                    $interval = $datenow->diff($updated);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->updated_at) . $along;
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
                    <dt>User:</dt>
                    <dd><?= $data->sender_id ?></dd>
                    <dt>Date/time:</dt>
                    <dd><?= \Yii::$app->formatter->asDatetime($data->created_at, 'long') ?></dd>
                    <dt>Message:</dt>
                    <dd><?= $data->message ?></dd>
                    <?php if ($data->attachment_id) : ?>
                        <?php if (($data->attachment_id == $data->attachment['id']) && ($data->sender_id == $data->attachment['sender_id'])) : ?>
                            <dt>Attachment:</dt>
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
    <p>
        <?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to list'), ['tickets/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app/modules/tickets', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/tickets', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/tickets', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
