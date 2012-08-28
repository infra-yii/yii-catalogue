<?php
/**
 * @author alari
 * @since 8/28/12 11:58 AM
 *
 * @var $model CatalogueCategory
 */

$products = $model->products;
$props = $model->collectProperties();

$values = array();
foreach ($products as $p) {
    if (!isset($values[$p->base_category_id])) {
        $values[$p->base_category_id] = array();
    }
    $arr = array("product" => $p);
    foreach ($p->propertiesValues as $v) {
        $arr[$v->property_id] = $v->value;
    }
    $values[$p->base_category_id][] = $arr;
}
?>

<h1><?=$model->title?> (<?=count($products)?>)</h1>

<table>

    <tr>
        <th>Name</th>
    <?foreach($props as $pr){?>
        <th><?=$pr->title?></th>
    <?}?>
    </tr>

    <?foreach ($values as $baseId => $products) { ?>

    <tr><th colspan="<?=(count($props)+1)?>"><h2><?=$products[0]["product"]->baseCategory->title?></h2></th></tr>


    <? foreach ($products as $p) { ?>
        <tr>
            <th><?=CHtml::link($p["product"]->title, $p["product"]->url())?></th>
            <?foreach($props as $pr) {?>
                <td><?=(isset($p[$pr->id]) ? $p[$pr->id] : "-")?></td>
            <?}?>
        </tr>
        <? } ?>

    <? }?>

</table>