<?php
use yii\easyii\modules\article\api\Article;

$this->title = $article->seo('title', $article->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = ['label' => $article->cat->title, 'url' => ['articles/cat', 'slug' => $article->cat->slug]];
$this->params['breadcrumbs'][] = $article->model->title;
?>
<h1><?= $article->seo('h1', $article->title) ?></h1>

<?= $article->text ?>

<?php if(count($article->photos)) : ?>
    <div>
        <h4>Photos</h4>
        <?php foreach($article->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php Article::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<p>
    <?php foreach($article->tags as $tag) : ?>
        <span class="label label-info"><?= $tag ?></span>
    <?php endforeach; ?>
</p>

<small class="text-muted">Views: <?= $article->views?></small>