<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;

$page = Page::get('page-shopcart-success');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>

<br/>

<?= $page->text ?>