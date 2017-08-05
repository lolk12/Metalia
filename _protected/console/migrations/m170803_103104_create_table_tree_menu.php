<?php

use yii\db\Migration;

class m170803_103104_create_table_tree_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tree_menu}}', [
            'id' => $this->primaryKey(),
            'parent' => $this->integer()->defaultValue(null),
            'name' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        echo "m170803_103104_create_table_treeMenu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170803_103104_create_table_treeMenu cannot be reverted.\n";

        return false;
    }
    */
}
