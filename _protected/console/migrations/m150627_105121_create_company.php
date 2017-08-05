<?php

use yii\db\Migration;

class m150627_105121_create_company extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ( $this->db->driverName === 'mysql' )
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company}}', array(
            'id' => 'pk',
            'vatin' => $this->string()->unique()->notNull(),
            'email' => $this->string()->unique()->notNull(),
            'company_name' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull()->unique(),
            'target' => $this->string(),
            'web_site' => $this->string(),
            'staff' => $this->integer(),
            'initial_capital' => $this->bigInteger(13),
            'assets' => $this->bigInteger(13),
            'property' => $this->string(),
            'validate' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ), $tableOptions);
    }

    public function down()
    {
        echo "m150627_105121_create_company cannot be reverted.\n";

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
