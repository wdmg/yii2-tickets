<?php

namespace wdmg\tickets\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $subunit
 * @property string $subject
 * @property string $message
 * @property int $user_id
 * @property int $assigned_id
 * @property int $task_id
 * @property string $access_token
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Tasks $task
 * @property TicketsAttachments[] $ticketsAttachments
 * @property TicketsMessages[] $ticketsMessages
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subunit', 'user_id', 'assigned_id', 'task_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject', 'access_token'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/tickets', 'ID'),
            'subunit' => Yii::t('app/modules/tickets', 'Subunit'),
            'subject' => Yii::t('app/modules/tickets', 'Subject'),
            'message' => Yii::t('app/modules/tickets', 'Message'),
            'user_id' => Yii::t('app/modules/tickets', 'User ID'),
            'assigned_id' => Yii::t('app/modules/tickets', 'Assigned ID'),
            'task_id' => Yii::t('app/modules/tickets', 'Task ID'),
            'access_token' => Yii::t('app/modules/tickets', 'Access Token'),
            'created_at' => Yii::t('app/modules/tickets', 'Created At'),
            'updated_at' => Yii::t('app/modules/tickets', 'Updated At'),
            'status' => Yii::t('app/modules/tickets', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketsAttachments()
    {
        return $this->hasMany(TicketsAttachments::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketsMessages()
    {
        return $this->hasMany(TicketsMessages::className(), ['ticket_id' => 'id']);
    }
}
