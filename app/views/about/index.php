<?php
use yii\easyii\modules\page\api\Page;
use yii\helpers\Url;

$plainPageTitle = $page->getTitle(false);

$this->title = $page->seo('title', $plainPageTitle);

if($page->parent) {
    $this->params['breadcrumbs'][] = ['label' => $page->parent->getTitle(false), 'url' => ['/about']];
}

$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>

<div class="row">
    <div class="col-md-8">
        <?= $page->text ?>
    </div>
    <div class="col-md-4">
        <h4>Subpages</h4>
        <div class="list-group">
        <?php foreach(Page::get('about')->children as $childPage) : ?>
            <a class="list-group-item <?php if($childPage->slug == $subpageSlug) echo 'active'; ?>" href="<?= Url::to(['/about', 'subpage' => $childPage->slug])?>"><?= $childPage->title ?></a>
        <?php endforeach; ?>
        </div>
    </div>
</div>

