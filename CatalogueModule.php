<?php
class CatalogueModule extends CWebModule{


    public $categoryModelClass = "CatalogueCategory";

    public $infoFormView = "_infoForm";

    public $viewProduct = 'view';
    public $actionProductView = "/catalogue/product/view";

    public $productModelClass = "CatalogueProduct";
    public $productInfoModelClass = "CatalogueProductInfo";
    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        return array('url' => array("/catalogue/category/admin"), 'label' => Yii::t("app", "Manage Categories"), 'visible' => !Yii::app()->user->isGuest);
    }
}