<?php

use yii\db\Migration;

class m170624_110933_create_company_revenue extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ( $this->db->driverName === 'mysql' )
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_revenue}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'revenue' => $this->integer(),
            'year' => $this->integer()->notNull(),
            'validate' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'company_revenue_id_company',
            'company_revenue',
            'company_id',
            'company',
            'id'
        );
    }

    public function safeDown()
    {
        echo "m170624_110933_create__company_earnings cannot be reverted.\n";

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
