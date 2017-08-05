<?php

use yii\db\Migration;

class m170708_131555_create_tender extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tender}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'type' => $this->integer(2)->notNull(),
            'value' => $this->integer(),
            'delivery_data' => $this->timestamp(6)->notNull(),
            'delivery_site' => $this->text()->notNull(),
            'comments' => $this->text()->notNull(),
            'status' => $this->integer(2)->notNull(),
            'verified' => $this->integer(2)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'tender_id_company',
            'tender',
            'company_id',
            'company',
            'id'
        );
    }

    public function down()
    {
        echo "m170708_131555_create_tender cannot be reverted.\n";

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
