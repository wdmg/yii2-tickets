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
            'subunit',
            'subject',
            'message:ntext',
            'user_id',
            'assigned_id',
            'task_id',
            'access_token',
            'created_at',
            'updated_at',
            'status',
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
