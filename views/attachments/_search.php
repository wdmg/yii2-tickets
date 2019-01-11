<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsAttachmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            <a data-toggle="collapse" href="#ticketsAttachmentsSearch">
                <span class="glyphicon glyphicon-search"></span> <?= Yii::t('app/modules/tickets', 'Attachments search') ?>
            </a>
        </h5>
    </div>
    <div id="ticketsAttachmentsSearch" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="tickets-attachments-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                <?= $form->field($model, 'id') ?>

                <?= $form->field($model, 'ticket_id') ?>

                <?= $form->field($model, 'sender_id') ?>

                <?= $form->field($model, 'filename') ?>

                <?= $form->field($model, 'created_at') ?>

                <?php // echo $form->field($model, 'updated_at') ?>

                <?php // echo $form->field($model, 'status') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app/modules/tickets', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app/modules/tickets', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
