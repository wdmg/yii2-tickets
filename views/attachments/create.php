<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsAttachments */

$this->title = Yii::t('app/modules/tickets', 'Create Tickets Attachments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-attachments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
