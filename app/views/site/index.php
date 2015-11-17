<?php
use yii\easyii\helpers\Image;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;
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

<div class="row text-center">
    <h2>Features</h2>
    <br/>
    <?php foreach($features as $feature) : ?>
        <div class="col-md-4">
            <img src="<?= Image::thumb($feature->image, 120, 120) ?>" class="img-circle">
            <h3><?= $feature->title ?></h3>
            <p><?= $feature->description ?></p>
        </div>
    <?php endforeach;?>
</div>

<br/>
<hr/>

<div class="text-center">
    <h2>Last photos</h2>
    <br/>
    <?php foreach($lastPhotos as $photo) : ?>
        <?= $photo->box(180, 135) ?>
    <?php endforeach;?>
    <?php Gallery::plugin() ?>
</div>

<br/>
<hr/>

<?php if($lastNews) : ?>
    <div class="text-center">
        <h2>Last news</h2>
        <blockquote class="text-left">
            <?= Html::a($lastNews->title, ['news/view', 'slug' => $lastNews->slug]) ?>
            <br/>
            <?= $lastNews->short ?>
        </blockquote>
    </div>
<?php endif; ?>

<br/>
<hr/>

<?php if($lastArticle) : ?>
    <div class="text-center">
        <h2>Last article from category #1</h2>
        <br/>
        <div class="row text-left">
            <?php ?>
            <div class="col-md-2">
                <?= Html::img($lastArticle->thumb(160, 120)) ?>
            </div>
            <div class="col-md-10 text-left">
                <?= Html::a($lastArticle->title, ['articles/view', 'slug' => $lastArticle->slug]) ?>
                <br/>
                <?= $lastArticle->short ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<br/>
<hr/>

<div class="text-center">
    <h2>Last reviews</h2>
    <br/>
    <div class="row text-left">
        <?php foreach($lastPosts as $post) : ?>
            <div class="col-md-6">
                <b><?= $post->name ?></b>
                <p class="text-muted"><?= $post->text ?></p>
            </div>
        <?php endforeach;?>
    </div>
</div>

<br/>
