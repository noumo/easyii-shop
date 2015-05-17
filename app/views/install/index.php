<?php
use yii\helpers\Url;

$this->title = 'EasyiiCMS Install result';
?>

<div class="container vertical-align-parent text-center" id="page-install">
    <h1 class="text-center">Shop install result</h1>
    <br/><br/>
    <div class="alert alert-danger">Highly recommended to delete <code>app/controllers/InstallController</code>, after installation.</div>
    <div class="well well-sm text-left">
        <?php foreach($result as $item) : ?>
            <p><?= $item ?></p>
        <?php endforeach; ?>
    </div>
    <br>
    <a href="<?= Url::to(['/site/start']) ?>" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Startpage</a>
    <a href="<?= Url::home() ?>" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-home"></i> Shop homepage</a>
</div>

