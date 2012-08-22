<?php
class CatalogueModule extends CWebModule{

    public $categoryModelClass = "CatalogueCategory";
    public $productModelClass = "Product";

    public $infoformView = "_infoform";

    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        return array('url' => array("/catalogue/category/admin"), 'label' => Yii::t("app", "Manage Categories"), 'visible' => !Yii::app()->user->isGuest);
    }
}