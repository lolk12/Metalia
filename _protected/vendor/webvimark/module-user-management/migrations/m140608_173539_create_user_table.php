<?php

use yii\db\Schema;
use yii\db\Migration;

class m140608_173539_create_user_table extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' )
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

	        // Check if user Table exist
	        // $tablename = \Yii::$app->db->tablePrefix.'user';
	        $tablename = \Yii::$app->getModule('user-management')->user_table;

		// Create user table
		$this->createTable($tablename, array(
			'id'                 => 'pk',
			'username'           => 'string not null',
			'auth_key'           => 'varchar(32) not null',
			'password_hash'      => 'string not null',
            'full_name' => $this->string()->notNull(),
            'vatin' => $this->string()->unique(),
            'company_name' => $this->string(),
            'email_confirm_token' => $this->string(),
            'position' => $this->string(),
            'phone_number' => $this->string()->notNull()->unique(),
			'confirmation_token' => 'string',
			'status'             => 'int not null default 1',
			'superadmin'         => 'smallint default 0',
			'created_at'         => 'int not null',
			'updated_at'         => 'int not null',
		), $tableOptions);
	}

	public function safeDown()
	{
		$this->dropTable(Yii::$app->getModule('user-management')->user_table);
	}
}
