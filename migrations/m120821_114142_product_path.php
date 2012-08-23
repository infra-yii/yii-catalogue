<?php

class m120821_114142_product_path extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{catalogue_product}}", "path", "VARCHAR(200) DEFAULT NULL");
        $this->createIndex("catalogue_product_path", "{{catalogue_product}}", "path", true);
    }

    public function safeDown()
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