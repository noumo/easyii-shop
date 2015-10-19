<?php
use yii\easyii\modules\faq\api\Faq;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Url;

$page = Page::get('page-faq');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>

<?php foreach($faq as $item) : ?>
    <p><b>Question: </b><?= $item->question ?></p>
    <blockquote><b>Answer: </b><?= $item->answer ?></blockquote>
    <?php if(count($item->tags)) : ?>
        <?php foreach($item->tags as $tag) : ?>
            <a href="<?= Url::to(['/faq', 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
        <?php endforeach; ?>
        <br/>
    <?php endif; ?>
    <br/>

<?php endforeach; ?>