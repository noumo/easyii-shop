<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;

$page = Page::get('shopcart-success');
$plainPageTitle = $page->getTitle(false);

$this->title = $page->seo('title', $plainPageTitle);
$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>

<br/>

<?= $page->text ?>