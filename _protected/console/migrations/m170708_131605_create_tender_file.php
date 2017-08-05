<?php

use yii\db\Migration;

class m170708_131605_create_tender_file extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tender_file}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'tender_id' => $this->integer()->notNull(),
            'file' => 'LONGBLOB',
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey(
            'tender_file_id_company',
            'tender_file',
            'company_id',
            'company',
            'id'
        );
        $this->addForeignKey(
            'tender_file_id_tender',
            'tender_file',
            'tender_id',
            'tender',
            'id'
        );
    }

    public function down()
    {
        echo "m170708_131605_create_tender_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
