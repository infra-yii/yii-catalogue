<?php

class m120823_092104_productImageHolder extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{catalogue_product}}", "list_holder_id", "int");
        $this->addForeignKey("prod_list", "{{catalogue_product}}", "list_holder_id", "{{images_holder}}", "id");
	}

	public function down()
	{
		echo "m120823_092104_paroductImageHolder does not support migration down.\n";
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