<?php

class m120823_092127_categoryImageHolder extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{catalogue_category}}", "pic_holder_id", "int");
        $this->addForeignKey("cat_pic", "{{catalogue_category}}", "pic_holder_id", "{{images_holder}}", "id");
	}

	public function down()
	{
		echo "m120823_092127_categoryImageHolder does not support migration down.\n";
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