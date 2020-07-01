<?php

use wdmg\widgets\SelectInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wdmg\widgets\Editor;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->widget(Editor::class, [
        'options' => [],
        'pluginOptions' => []
    ]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'assigned_id')->textInput() ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'subunit_id')->textInput() ?>

    <?= $form->field($model, 'access_token')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'label')->widget(SelectInput::class, [
        'items' => $model->getAllLabelsList(),
        'options' => [
            'id' => 'ticket-form-label',
            'class' => 'form-control'
        ]
    ]); ?>

    <?= $form->field($model, 'status')->widget(SelectInput::class, [
        'items' => $model->getAllStatusesList(),
        'options' => [
            'id' => 'ticket-form-status',
            'class' => 'form-control'
        ]
    ]); ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to list'), ['list/all'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/tickets', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
