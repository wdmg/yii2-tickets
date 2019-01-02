<?php

use yii\db\Migration;

/**
 * Class m180102_211516_geo_init
 */
class m180102_211516_geo_init extends Migration
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

        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%tickets%}}');
        $this->dropTable('{{%tickets%}}');
    }
}
