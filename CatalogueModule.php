<?php
class CatalogueModule extends CWebModule{

    public $infoFormView = "_infoForm";
    public $viewProduct = '//showcase/viewProduct';
    public $actionProductView = "/catalogue/product/view";

    public $categoryModelClass = "CatalogueCategory";
    public $productModelClass = "CatalogueProduct";
    public $productInfoModelClass = "CatalogueProductInfo";
    /**
     * Returns model class object
     * @return StaticPage
     */
    public function model()
    {
        return Category::model($this->categoryModelClass);
    }

    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        return array('url' => array("/catalogue/product/admin"), 'label' => Yii::t("app", "Manage Product"), 'visible' => !Yii::app()->user->isGuest);
    }
}