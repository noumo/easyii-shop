<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Url;

$plainPageTitle = $article->getTitle(false);

$this->title = $article->seo('title', $plainPageTitle);

$this->params['keywords'] = $article->seo('keywords');
$this->params['description'] = $article->seo('description');

$this->params['breadcrumbs'][] = ['label' => Page::get('articles')->getTitle(false), 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = ['label' => $article->cat->title, 'url' => ['articles/cat', 'slug' => $article->cat->slug]];
$this->params['breadcrumbs'][] = $plainPageTitle;
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
        <a href="<?= Url::to(['/articles/cat', 'slug' => $article->cat->slug, 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
    <?php endforeach; ?>
</p>

<small class="text-muted">Views: <?= $article->views?></small>