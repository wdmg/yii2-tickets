<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\TicketsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            <a data-toggle="collapse" href="#ticketsSearch">
                <span class="glyphicon glyphicon-search"></span> <?= Yii::t('app/modules/tickets', 'Tickets search') ?>
            </a>
        </h5>
    </div>
    <div id="ticketsSearch" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="tickets-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                <?= $form->field($model, 'id') ?>


                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'message') ?>

                <?= $form->field($model, 'user_id') ?>
                <?= $form->field($model, 'task_id') ?>
                <?= $form->field($model, 'subunit_id') ?>

                <?php // echo $form->field($model, 'assigned_id') ?>

                <?php // echo $form->field($model, 'access_token') ?>

                <?php // echo $form->field($model, 'created_at') ?>

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
