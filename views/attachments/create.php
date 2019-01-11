<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsAttachments */

$this->title = Yii::t('app/modules/tickets', 'Add ticket attachment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['../tickets']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tickets-attachments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
