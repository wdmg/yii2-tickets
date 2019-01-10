<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-view">

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

</div>
