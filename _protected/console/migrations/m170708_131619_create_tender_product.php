<?php

use yii\db\Migration;

class m170708_131619_create_tender_product extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tender_product}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'tender_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'budget' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'tender_product_id_company',
            'tender_product',
            'company_id',
            'company',
            'id'
        );
        $this->addForeignKey(
            'tender_product_id_tender',
            'tender_product',
            'tender_id',
            'tender',
            'id'
        );

    }

    public function down()
    {
        echo "m170708_131619_create_tender_product cannot be reverted.\n";

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
