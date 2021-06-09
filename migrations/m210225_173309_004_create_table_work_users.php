<?php

use yii\db\Migration;

class m210225_173309_004_create_table_work_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%work_users}}',
            [
                'id' => $this->primaryKey(),
                'id_work' => $this->integer()->notNull(),
                'id_user' => $this->integer()->notNull(),
                'status' => $this->string()->notNull(),
                'created_at' => $this->dateTime(6),
                'updated_at' => $this->dateTime(6),
            ],
            $tableOptions
        );

        $this->createIndex('id_work', '{{%work_users}}', ['id_work']);
        $this->createIndex('id_user', '{{%work_users}}', ['id_user']);

        $this->addForeignKey(
            'work_users_ibfk_1',
            '{{%work_users}}',
            ['id_user'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'work_users_ibfk_2',
            '{{%work_users}}',
            ['id_work'],
            '{{%work}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%work_users}}');
    }
}
