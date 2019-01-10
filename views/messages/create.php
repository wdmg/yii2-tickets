<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsMessages */

$this->title = Yii::t('app/modules/tickets', 'Create Tickets Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
