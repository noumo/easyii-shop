<?php
use yii\easyii\modules\gallery\api\Gallery;

$this->title = $album->seo('title', $album->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['gallery/index']];
$this->params['breadcrumbs'][] = $album->model->title;
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
<?= $album->pages() ?>
