<?php
use yii\helpers\Url;

$this->title = 'EasyiiCMS installation step 3';
?>

<?= $this->render('_steps', ['currentStep' => 3])?>

<div class="alert alert-danger">
    After installation highly recommended to delete:
    <ul>
        <li>a file <code>app/controllers/InstallController</code></li>
        <li>a file <code>app/views/layouts/install.php</code></li>
        <li>a folder <code>app/views/install</code></li>
    </ul>
</div>
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

