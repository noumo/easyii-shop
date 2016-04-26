<?php
use yii\easyii\helpers\Image;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('gallery');
$plainPageTitle = $page->getTitle(false);

$this->title = $page->seo('title', $plainPageTitle);
$this->params['breadcrumbs'][] = $plainPageTitle;

?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>

<?php foreach($albums as $album) : ?>
    <a class="center-block" href="<?= Url::to(['gallery/view', 'slug' => $album->slug]) ?>">
        <?= Html::img($album->thumb(160, 120)) ?><br/><?= $album->title ?>
    </a>
    <p>
        <?php foreach($album->tags as $tag) : ?>
            <a href="<?= Url::to(['/gallery', 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
        <?php endforeach; ?>
    </p>
    <br/>
<?php endforeach; ?>
