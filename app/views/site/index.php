<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\helpers\Html;

$page = Page::get('page-index');

$this->title = $page->seo('title', $page->model->title);
?>

<?= Carousel::widget(1140, 520) ?>

<div class="text-center">
    <h1><?= Text::get('index-welcome-title') ?></h1>
    <p><?= $page->text ?></p>
</div>

<br/>
<hr/>

<div class="text-center">
    <h2>Last photos</h2>
    <br/>
    <?php foreach(Gallery::last(6) as $photo) : ?>
        <?= $photo->box(180, 135) ?>
    <?php endforeach;?>
    <?php Gallery::plugin() ?>
</div>

<br/>
<hr/>

<div class="text-center">
    <h2>Last news</h2>
    <blockquote class="text-left">
        <?= Html::a(News::last()->title, ['news/view', 'slug' => News::last()->slug]) ?>
        <br/>
        <?= News::last()->short ?>
    </blockquote>
</div>

<br/>
<hr/>


<div class="text-center">
    <h2>Last article from category #1</h2>
    <br/>
    <div class="row text-left">
        <?php $article = Article::last(1, ['category_id' => 1]); ?>
        <div class="col-md-2">
            <?= Html::img($article->thumb(160, 120)) ?>
        </div>
        <div class="col-md-10 text-left">
            <?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?>
            <br/>
            <?= $article->short ?>
        </div>
    </div>
</div>

<br/>
<hr/>

<div class="text-center">
    <h2>Last reviews</h2>
    <br/>
    <div class="row text-left">
        <?php foreach(Guestbook::last(2) as $post) : ?>
            <div class="col-md-6">
                <b><?= $post->name ?></b>
                <p class="text-muted"><?= $post->text ?></p>
            </div>
        <?php endforeach;?>
    </div>
</div>

<br/>
