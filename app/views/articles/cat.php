<?php
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$plainPageTitle = $cat->getTitle(false);

$this->title = $cat->seo('title', $plainPageTitle);
$this->params['breadcrumbs'][] = ['label' => Page::get('articles')->getTitle(false), 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $cat->seo('h1', $cat->title) ?></h1>
<br/>

<?php if(count($items)) : ?>
    <?php foreach($items as $article) : ?>
        <div class="row">
            <div class="col-md-2">
                <?= Html::img($article->thumb(160, 120)) ?>
            </div>
            <div class="col-md-10">
                <?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?>
                <p><?= $article->short ?></p>
                <p>
                    <?php foreach($article->tags as $tag) : ?>
                        <a href="<?= Url::to(['/articles/cat', 'slug' => $article->cat->slug, 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
<?php else : ?>
    <p>Category is empty</p>
<?php endif; ?>

<?= $cat->pages ?>