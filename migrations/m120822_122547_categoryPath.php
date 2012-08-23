<?php

class m120822_122547_categoryPath extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{category}}', 'path', 'varchar(200)');
	}

	public function down()
	{
		echo "m120822_122547_categoryPath does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}