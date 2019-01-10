<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsMessages */

$this->title = Yii::t('app/modules/tickets', 'Update Tickets Messages: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/tickets', 'Update');
?>
<div class="tickets-messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
