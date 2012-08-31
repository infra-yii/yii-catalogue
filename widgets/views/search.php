<div id="search">
    <div id="search_div">
        <?php $url = $this->getController()->createUrl('/catalogue/category/search'); ?>
        <?php echo CHtml::beginForm($url); ?>
        <div class="row">
            <?php echo CHtml::activeTextField($form,'string') ?>
            <?php echo CHtml::error($form,'string'); ?>
            <?php echo CHtml::SubmitButton('Поиск'); ?>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div>
    <div id="SearchFooter"></div>
</div>