<?php

use yii\db\Migration;

/**
 * Class m180103_175247_tickets_attachments
 */
class m180103_174855_tickets_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tickets_messages%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'ticket_id' => $this->integer()->notNull(), // Ticket ID (int) `tickets`.`id`
            'sender_id' => $this->integer()->null(), // Ticket created by (int) `users`.`id`
            'message' => $this->text(), // Ticket message (string)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Message created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Message updated date (timestamp)
            'attachment_id' => $this->integer()->null(), // Attachment ID (int) `tickets_attachment`.`id`
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%tickets_messages%}}');
        $this->dropTable('{{%tickets_messages%}}');
    }
}
