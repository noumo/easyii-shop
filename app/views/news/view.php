<?php
use yii\easyii\modules\news\api\News;

$this->title = $news->seo('title', $news->model->title);
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['news/index']];
$this->params['breadcrumbs'][] = $news->model->title;
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

<div class="small-muted">Views: <?= $news->views?></div>