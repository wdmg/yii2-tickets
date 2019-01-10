<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsAttachments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-attachments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/modules/tickets', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/tickets', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/modules/tickets', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ticket_id',
            'sender_id',
            'filename',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
