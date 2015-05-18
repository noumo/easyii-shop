<?php
use yii\helpers\Url;

$this->title = 'EasyiiCMS installation step 3';
?>

<?= $this->render('_steps', ['currentStep' => 3])?>

<div class="alert alert-danger">Highly recommended to delete <code>app/controllers/InstallController</code>, after installation.</div>
<h2>Data insert log</h2>
<div class="well well-sm text-left">
    <?php foreach($result as $item) : ?>
        <p><?= $item ?></p>
    <?php endforeach; ?>
</div>
<br>
<div class="row text-center">
    <a href="<?= Url::home() ?>" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-home"></i> Shop homepage</a>
</div>

