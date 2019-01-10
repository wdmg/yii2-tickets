<?php

namespace wdmg\tickets\models;

use Yii;

/**
 * This is the model class for table "tickets_messages".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $sender_id
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 * @property int $attachment_id
 *
 * @property TicketsAttachments $attachment
 * @property Tickets $ticket
 */
class TicketsMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id'], 'required'],
            [['ticket_id', 'sender_id', 'attachment_id'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketsAttachments::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/tickets', 'ID'),
            'ticket_id' => Yii::t('app/modules/tickets', 'Ticket ID'),
            'sender_id' => Yii::t('app/modules/tickets', 'Sender ID'),
            'message' => Yii::t('app/modules/tickets', 'Message'),
            'created_at' => Yii::t('app/modules/tickets', 'Created At'),
            'updated_at' => Yii::t('app/modules/tickets', 'Updated At'),
            'attachment_id' => Yii::t('app/modules/tickets', 'Attachment ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachment()
    {
        return $this->hasOne(TicketsAttachments::className(), ['id' => 'attachment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::className(), ['id' => 'ticket_id']);
    }
}
