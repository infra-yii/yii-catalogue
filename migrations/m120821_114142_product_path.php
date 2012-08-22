<?php

class m120821_114142_product_path extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{product}}", "path", "VARCHAR(64) DEFAULT NULL");
	}

	public function down()
	{
		echo "m120821_114142_product_path does not support migration down.\n";
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