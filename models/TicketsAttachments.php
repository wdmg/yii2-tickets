<?php

namespace wdmg\tickets\models;

use Yii;
use \yii\behaviors\TimeStampBehavior;

/**
 * This is the model class for table "tickets_attachments".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $sender_id
 * @property string $filename
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Tickets $ticket
 * @property TicketsMessages[] $ticketsMessages
 */
class TicketsAttachments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets_attachments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id'], 'required'],
            [['ticket_id', 'sender_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['filename'], 'string', 'max' => 64],
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
            'filename' => Yii::t('app/modules/tickets', 'Filename'),
            'created_at' => Yii::t('app/modules/tickets', 'Created At'),
            'updated_at' => Yii::t('app/modules/tickets', 'Updated At'),
            'status' => Yii::t('app/modules/tickets', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketsMessages()
    {
        return $this->hasMany(TicketsMessages::className(), ['attachment_id' => 'id']);
    }
}
