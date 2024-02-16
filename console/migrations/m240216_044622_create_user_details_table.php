<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_details}}`.
 */
class m240216_044622_create_user_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_details}}', [
            'id'           => $this->primaryKey(),
            'user_id'      => $this->integer()->notNull(),
            'firstname'    => $this->string(),
            'lastname'     => $this->string(),
            'phone'        => $this->string(),
            'home_address' => $this->text(),
            'work_address' => $this->text(),
            'full_address' => $this->text(),
            'description'  => $this->text(),
            'status'       => $this->integer()
        ]);

        $this->createIndex(
        'idx-user_details-user_id',
        'user_details',
        'user_id'
    );

        $this->addForeignKey(
            'fk-user_details-user_id',
            'user_details',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_details-user_id',
            'user_details'
        );

        $this->dropIndex(
            'idx-user_details-user_id',
            'user_details'
        );

        $this->dropTable('{{%user_details}}');
    }
}
