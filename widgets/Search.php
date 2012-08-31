<?php

class Search extends CWidget
{
    public function run()
    {
        $form = new CatalogueSearch();
        $this->render('search', array('form'=>$form));
    }
}