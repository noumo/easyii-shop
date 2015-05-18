<?php
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>
<div class="container" id="page-install">
    <div class="row text-center">
        <h1>Welcome to <a href="http://easyiicms.com" target="_blank">EasyiiCMS</a> installation</h1>
    </div>
    <br/>
    <?= $content ?>
</div>
<?php $this->endContent(); ?>