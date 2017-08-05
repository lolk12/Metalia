<?php

use yii\db\Migration;

class m170623_152249_create_company_unit extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_unit}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'address' => $this->string(),
            'telephone' => $this->string(),
            'validate' => $this->integer()->defaultValue(1),
            'is_main' => $this->boolean()->defaultValue(null),
            'description' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'company_unit_id_company',
            'company_unit',
            'company_id',
            'company',
            'id'
        );

    }

    public function down()
    {
        echo "m170623_152249__company_unit cannot be reverted.\n";

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
