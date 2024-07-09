<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m240708_180044_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull(),
            'decision' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
