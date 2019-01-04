<?php

use yii\db\Migration;

/**
 * Class m180103_175247_tickets_attachments
 */
class m180103_175247_tickets_attachments extends Migration
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

        $this->createTable('{{%tickets_attachments%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'ticket_id' => $this->integer()->notNull(), // Ticket ID (int) `tickets`.`id`
            'sender_id' => $this->integer()->null(), // Attachment uploaded by (int) `users`.`id`
            'filename' => $this->string(64), // Attachment filename (string)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Attachment created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Attachment updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Ticket status (int): 10 - Available, 20 - Removed
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%tickets_attachments%}}');
        $this->dropTable('{{%tickets_attachments%}}');
    }
}
