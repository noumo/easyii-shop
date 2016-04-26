<?php
use yii\easyii\modules\catalog\api\Catalog;
use yii\easyii\modules\page\api\Page;

$page = Page::get('shop-search');
$plainPageTitle = $page->getTitle(false);

$this->title = $page->seo('title', $plainPageTitle);
$this->params['breadcrumbs'][] = ['label' => Page::get('shop')->getTitle(false), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $plainPageTitle;

?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>
<?= $this->render('_search_form', ['text' => $text]) ?>
<br/>
<div class="row">
    <div class="col-md-8">
        <?php if(count($items)) : ?>
            <?php foreach($items as $item) : ?>
                <?= $this->render('_item', ['item' => $item]) ?>
            <?php endforeach; ?>
            <?= Catalog::pages() ?>
        <?php else : ?>
            <p>No items found</p>
        <?php endif; ?>
    </div>
    <div class="col-md-4"></div>
</div>



