<?php
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;

$page = Page::get('page-news');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>

<?php foreach(News::items(['pagination' => ['pageSize' => 2]]) as $news) : ?>
    <div class="row">
        <div class="col-md-2">
            <?= Html::img($news->thumb(160, 120)) ?>
        </div>
        <div class="col-md-10">
            <?= Html::a($news->title, ['news/view', 'slug' => $news->slug]) ?>
            <div class="small-muted"><?= $news->date ?></div>
            <p><?= $news->short ?></p>
        </div>
    </div>
    <br>
<?php endforeach; ?>

<?= News::pages() ?>
