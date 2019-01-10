<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsAttachments */

$this->title = Yii::t('app/modules/tickets', 'Update Tickets Attachments: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/tickets', 'Update');
?>
<div class="tickets-attachments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
