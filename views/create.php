<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */

$this->title = Yii::t('app/modules/tickets', 'Create Tickets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tickets', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
