<?php
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;

$plainPageTitle = $album->getTitle(false);

$this->title = $album->seo('title', $plainPageTitle);

$this->params['keywords'] = $album->seo('keywords');
$this->params['description'] = $album->seo('description');

$this->params['breadcrumbs'][] = ['label' => Page::get('gallery')->getTitle(false), 'url' => ['gallery/index']];
$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $album->seo('h1', $album->title) ?></h1>

<?php if(count($photos)) : ?>
    <div>
        <h4>Photos</h4>
        <?php foreach($photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php Gallery::plugin() ?>
    </div>
    <br/>
<?php else : ?>
    <p>Album is empty.</p>
<?php endif; ?>
<?= $album->pages ?>
