<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dishes}}`.
 */
class m190513_162638_create_dishes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dishes}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->unique(),
            'status' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dishes}}');
    }
}
