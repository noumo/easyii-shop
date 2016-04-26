<?php
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Url;

$plainPageTitle = $news->getTitle(false);

$this->title = $news->seo('title', $plainPageTitle);

$this->params['keywords'] = $news->seo('keywords');
$this->params['description'] = $news->seo('description');

$this->params['breadcrumbs'][] = ['label' => Page::get('news')->getTitle(false), 'url' => ['news/index']];
$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $news->seo('h1', $news->title) ?></h1>

<?= $news->text ?>

<?php if(count($news->photos)) : ?>
    <div>
        <h4>Photos</h4>
        <?php foreach($news->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php News::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<p>
    <?php foreach($news->tags as $tag) : ?>
        <a href="<?= Url::to(['/news', 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
    <?php endforeach; ?>
</p>

<div class="small-muted">Views: <?= $news->views?></div>