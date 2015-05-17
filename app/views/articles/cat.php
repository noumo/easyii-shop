<?php
use yii\helpers\Html;

$this->title = $cat->seo('title', $cat->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = $cat->model->title;
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
            </div>
        </div>
        <br>
    <?php endforeach; ?>
<?php else : ?>
    <p>Category is empty</p>
<?php endif; ?>

<?= $cat->pages() ?>