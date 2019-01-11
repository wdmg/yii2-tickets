<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsMessages */

$this->title = Yii::t('app/modules/tickets', 'Create ticket messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['../tickets']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tickets-messages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
