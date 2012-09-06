<?php

class Search extends CWidget
{
    public function run()
    {
        $form = new CatalogueSearch();

        $this->render(Yii::app()->getModule("catalogue")->searchWidgetView, array('form'=>$form));
    }
}