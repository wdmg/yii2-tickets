<?php

namespace wdmg\tickets\models;

use Yii;
use \yii\behaviors\TimeStampBehavior;

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
     * Ticket status
     * const, int: 10 - Open, 20 - Waiting, 30 - In Work, 40 - Closed
     */
    const TK_STATUS_OPEN = 10;
    const TK_STATUS_WATING = 20;
    const TK_STATUS_INWORK = 30;
    const TK_STATUS_CLOSED = 40;

    /**
     * Ticket labels
     * const, int: 1 - Unlabeled, 2 - Bug, 3 - Duplicate, 4 - Enhancement, 5 - Help wanted, 6 - Review needed, 7 - Invalid, 8 - Question, 9 - Skipped, 10 - Wontfix
     */
    const TK_LABEL_UNLABELED = 1;
    const TK_LABEL_BUG = 2;
    const TK_LABEL_DUPLICATE = 3;
    const TK_LABEL_ENHANCEMENT = 4;
    const TK_LABEL_HELP_WANTED = 5;
    const TK_LABEL_REVIEW_NEEDED = 6;
    const TK_LABEL_INVALID = 7;
    const TK_LABEL_QUESTION = 8;
    const TK_LABEL_SKIPPED = 9;
    const TK_LABEL_WONTFIX = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets}}';
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
        $rules = [
            [['subunit_id', 'user_id', 'assigned_id', 'task_id', 'label', 'status'], 'integer'],
            [['message'], 'string'],
            [['subunit', 'created_at', 'updated_at'], 'safe'],
            [['subject', 'access_token'], 'string', 'max' => 255],
        ];

        if(class_exists('\wdmg\tasks\models\Tasks') && isset(Yii::$app->modules['tasks']))
            $rules[] = [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => \wdmg\tasks\models\Tasks::className(), 'targetAttribute' => ['task_id' => 'id']];

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/tickets', 'ID'),
            'subject' => Yii::t('app/modules/tickets', 'Subject'),
            'message' => Yii::t('app/modules/tickets', 'Message'),
            'user_id' => Yii::t('app/modules/tickets', 'User ID'),
            'assigned_id' => Yii::t('app/modules/tickets', 'Assigned ID'),
            'task_id' => Yii::t('app/modules/tickets', 'Task ID'),
            'subunit_id' => Yii::t('app/modules/tickets', 'Subunit'),
            'access_token' => Yii::t('app/modules/tickets', 'Access Token'),
            'created_at' => Yii::t('app/modules/tickets', 'Created At'),
            'updated_at' => Yii::t('app/modules/tickets', 'Updated At'),
            'label' => Yii::t('app/modules/tickets', 'Label'),
            'status' => Yii::t('app/modules/tickets', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        if(class_exists('\wdmg\tasks\models\Tasks') && isset(Yii::$app->modules['tasks']))
            return $this->hasOne(\wdmg\tasks\models\Tasks::className(), ['id' => 'task_id']);
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubunit()
    {
        if(class_exists('\wdmg\tasks\models\TasksSubunits') && isset(Yii::$app->modules['tasks']))
            return $this->hasOne(\wdmg\tasks\models\TasksSubunits::className(), ['id' => 'subunit_id']);
        else
            return null;
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigned()
    {
        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users']))
            return $this->hasOne(\wdmg\users\models\Users::className(), ['id' => 'assigned_id']);
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser($user_id = null)
    {
        if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users']) && !$user_id)
            return $this->hasOne(\wdmg\users\models\Users::className(), ['id' => 'user_id']);
        else if(class_exists('\wdmg\users\models\Users') && isset(Yii::$app->modules['users']) && $user_id)
            return \wdmg\users\models\Users::findOne(['id' => intval($user_id)]);
        else
            return null;
    }

    /**
     * Return all ticket status
     * @return array
     */
    public static function getAllStatus()
    {
        return [
            self::TK_STATUS_OPEN => Yii::t('app/modules/tickets', 'Open'),
            self::TK_STATUS_WATING => Yii::t('app/modules/tickets', 'Wating'),
            self::TK_STATUS_INWORK => Yii::t('app/modules/tickets', 'In work'),
            self::TK_STATUS_CLOSED => Yii::t('app/modules/tickets', 'Closed')
        ];
    }

    /**
     * Return all ticket labels
     * @return array
     */
    public static function getAllLabels()
    {
        return [
            self::TK_LABEL_UNLABELED => Yii::t('app/modules/tickets', 'Unlabeled'),
            self::TK_LABEL_BUG => Yii::t('app/modules/tickets', 'Bug'),
            self::TK_LABEL_DUPLICATE => Yii::t('app/modules/tickets', 'Duplicate'),
            self::TK_LABEL_ENHANCEMENT => Yii::t('app/modules/tickets', 'Enhancement'),
            self::TK_LABEL_HELP_WANTED => Yii::t('app/modules/tickets', 'Help wanted'),
            self::TK_LABEL_REVIEW_NEEDED => Yii::t('app/modules/tickets', 'Review needed'),
            self::TK_LABEL_INVALID => Yii::t('app/modules/tickets', 'Invalid'),
            self::TK_LABEL_QUESTION => Yii::t('app/modules/tickets', 'Question'),
            self::TK_LABEL_SKIPPED => Yii::t('app/modules/tickets', 'Skipped'),
            self::TK_LABEL_WONTFIX => Yii::t('app/modules/tickets', 'Wontfix')
        ];
    }

}
