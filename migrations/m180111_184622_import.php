<?php

use yii\db\Migration;
use yii\base\Security;

/**
 * Class m180111_182318_import
 */
class m180111_184622_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        for ($i = 1; $i <= 10; $i++) {
            $this->insert('{{%tickets}}', [
                'subject' => 'Some test ticket #'.$i,
                'message' => 'The description or message of some '.$i.' ticket...',
                'user_id' => null,
                'assigned_id' => rand(102, 105),
                'task_id' => rand(2, 6),
                'subunit_id' => rand(1, 3),
                'access_token' => Yii::$app->security->generateRandomString(16),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'status' => intval(rand(1, 4).'0')
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {

            $ticked_id = rand(2, 8);

            $this->insert('{{%tickets_attachments}}', [
                'ticket_id' => $ticked_id,
                'sender_id' => rand(101, 102),
                'filename' => 'UploadFile-'.rand(1, 2).'.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'status' => intval(rand(1, 2).'0')
            ]);

            $this->insert('{{%tickets_messages}}', [
                'ticket_id' => $ticked_id,
                'sender_id' => rand(101, 102),
                'message' => 'Some text message to ticket...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'attachment_id' => $i
            ]);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
