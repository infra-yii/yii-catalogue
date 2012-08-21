<?php
class CatalogueModule extends CWebModule{

    public $categoryModelClass = "CatalogueCategory";

    /**
     * Returns model class object
     * @return StaticPage
     */
    public function model()
    {
        return Category::model($this->categoryModelClass);
    }


}