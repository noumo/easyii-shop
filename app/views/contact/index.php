<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;

$page = Page::get('contact');
$plainPageTitle = $page->getTitle(false);

$this->title = $page->seo('title', $plainPageTitle);
$this->params['breadcrumbs'][] = $plainPageTitle;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>


<div class="row">
    <div class="col-md-8">
        <?= $page->text ?>
    </div>
    <div class="col-md-4">
        <?php if(Yii::$app->request->get(Feedback::SENT_VAR)) : ?>
            <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Message successfully sent</h4>
        <?php else : ?>
            <div class="well well-sm">
                <?= Feedback::form() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

