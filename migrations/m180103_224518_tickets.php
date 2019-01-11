<?php

use yii\db\Migration;

/**
 * Class m180103_224518_tickets
 */
class m180103_224518_tickets extends Migration
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

        $this->createTable('{{%tickets%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'subject' => $this->string(255), // Ticket subject (string)
            'message' => $this->text(), // Ticket message (string)
            'user_id' => $this->integer()->null(), // Ticket created by (int) `users`.`id`
            'assigned_id' => $this->integer()->null(), // Designated performer (int) `users`.`id`
            'task_id' => $this->integer()->null(), // ID created task if exist (int) `tasks`.`id`
            'subunit' => $this->integer()->null(), // Subdivision ID (int) `tasks_subunits`.`id`
            'access_token' => $this->string(255), // Ticket access token (string)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Ticket created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Ticket updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Ticket status (int): 10 - Open, 20 - Waiting, 30 - In Work, 40 - Closed
        ], $tableOptions);

        if (!(Yii::$app->db->getTableSchema('{{%users%}}', true) === null)) {
            $this->addForeignKey(
                'fk_tickets_to_users',
                '{{%tickets%}}',
                'user_id',
                '{{%users%}}',
                'id',
                'NO ACTION',
                'CASCADE'
            );
            $this->addForeignKey(
                'fk_tickets_to_users_assigned',
                '{{%tickets%}}',
                'assigned_id',
                '{{%users%}}',
                'id',
                'RESTRICT',
                'CASCADE'
            );
        }

        if (!(Yii::$app->db->getTableSchema('{{%tasks%}}', true) === null)) {
            $this->addForeignKey(
                'fk_tickets_to_tasks',
                '{{%tickets%}}',
                'task_id',
                '{{%tasks%}}',
                'id',
                'SET NULL',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if (!(Yii::$app->db->getTableSchema('{{%users%}}', true) === null)) {
            $this->dropForeignKey(
                'fk_tickets_to_users',
                '{{%tickets%}}'
            );
            $this->dropForeignKey(
                'fk_tickets_to_users_assigned',
                '{{%tickets%}}'
            );
        }

        if (!(Yii::$app->db->getTableSchema('{{%users%}}', true) === null)) {
            $this->dropForeignKey(
                'fk_tickets_to_tasks',
                '{{%tickets%}}'
            );
        }

        $this->truncateTable('{{%tickets%}}');
        $this->dropTable('{{%tickets%}}');
    }
}
