<?php
use yii\helpers\Url;

$this->title = 'EasyiiCMS installation step 1';
?>

<?= $this->render('_steps', ['currentStep' => 1])?>

<?php if(!$this->context->dbConnected) : ?>
    <h2 class="text-danger">Warning</h2>
    <div class="alert alert-danger">Cannot connect to database. Please configure <code>app/config/db.php</code></div>
<?php else : ?>
    <div class="row text-center">
        <h2 class="text-muted">If all the requirements are satisfied</h2>
        <a href="<?= Url::to(['/install/step2']) ?>" class="btn btn-primary btn-lg">Continue <i class="glyphicon glyphicon-forward"></i></a>
    </div>
    <hr/>
    <?= $this->renderFile(Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR .'requirements.php') ?>
<?php endif; ?>
