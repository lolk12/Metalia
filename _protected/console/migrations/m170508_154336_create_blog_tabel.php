<?php

use yii\db\Migration;

class m170508_154336_create_blog_tabel extends Migration
{
    public function up()
    {
        $this->createTable('blog', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'short_text' => $this->string(255)->notNull(),
            'full_text' => $this->text(),
            'active' => $this->integer(1)->notNull(),
            'created_by' => $this->string(),
            'updated_by' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    public function down()
    {
        echo "m170508_154336_create_blog_tabel cannot be reverted.\n";

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
