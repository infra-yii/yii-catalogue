<?php

class m120821_125825_product_category extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn("{{catalogue_product}}", "base_category_id", "int");
        $this->addForeignKey("catalogue_base_category_id", "{{catalogue_product}}", "base_category_id", "{{catalogue_category}}", "id", null, "CASCADE");
    }

    public function safeDown()
    {
        echo "m120821_125825_product_category does not support migration down.\n";
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