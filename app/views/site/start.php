<?php
use yii\helpers\Url;

$this->title = 'EasyiiCMS Shop start page';
?>
<div class="container vertical-align-parent" id="page-install">
    <div class="col-md-12 vertical-align-child text-center">
        <h1>Welcome to <a href="http://easyiicms.com" target="_blank">EasyiiCMS</a> start page</h1>
        <br/><br/><br/>
        <?php if(!Yii::$app->getModule('admin')->installed) : ?>
            <a class="circle" href="<?= Url::base() . '/requirements.php' ?>">
                <i class="glyphicon glyphicon-list-alt"></i>
                <br>
                Requirements
            </a>
            <a class="circle" href="<?= Url::to(['/admin/install']) ?>">
                <i class="glyphicon glyphicon-save"></i>
                <br>
                Install EasyiiCMS
            </a>
        <?php else : ?>
            <a class="circle" href="<?= Url::to(['/install']) ?>">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <br>
                Install Shop
            </a>
            <a class="circle" href="<?= Url::to(['/admin/']) ?>">
                <i class="glyphicon glyphicon-wrench"></i>
                <br>
                Control Panel
            </a>
        <?php endif; ?>
        <a class="circle" href="http://easyiicms.com/docs" target="_blank">
            <i class="glyphicon glyphicon-book"></i>
            <br>
            Documentation
        </a>
        <a class="circle" href="http://demo.easyiicms.com" target="_blank">
            <i class="glyphicon glyphicon-globe"></i>
            <br>
            Demo website
        </a>
    </div>
</div>
