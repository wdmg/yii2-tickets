<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wdmg\tickets\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'assigned_id')->textInput() ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'subunit_id')->textInput() ?>

    <?= $form->field($model, 'access_token')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        $model::TK_STATUS_OPEN => Yii::t('app/modules/tickets','Open'),
        $model::TK_STATUS_WATING => Yii::t('app/modules/tickets','Waiting'),
        $model::TK_STATUS_INWORK => Yii::t('app/modules/tickets','In Work'),
        $model::TK_STATUS_CLOSED => Yii::t('app/modules/tickets','Closed')
    ]); ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to list'), ['list/all'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/tickets', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
