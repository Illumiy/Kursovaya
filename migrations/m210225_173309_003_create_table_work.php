<?php

use yii\db\Migration;

class m210225_173309_003_create_table_work extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%work}}',
            [
                'id' => $this->primaryKey(),
                'id_teacher' => $this->integer()->notNull(),
                'title' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('id_teacher', '{{%work}}', ['id_teacher']);

        $this->addForeignKey(
            'work_ibfk_1',
            '{{%work}}',
            ['id_teacher'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%work}}');
    }
}
