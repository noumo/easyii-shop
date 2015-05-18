<?php
$steps = [
    '1' => 'Check requirements',
    '2' => 'Install Control Panel',
    '3' => 'Fill website with<br/> demo content',
];
?>

<div class="row bs-wizard" style="border-bottom:0;">
    <?php foreach($steps as $step => $description) : ?>
        <?php
            if($step == $currentStep){
                $state = 'active';
            } elseif($currentStep > $step) {
                $state = 'complete';
            } else {
                $state = 'disabled';
            }
        ?>
        <div class="col-xs-4 bs-wizard-step <?= $state ?>">
            <div class="text-center bs-wizard-stepnum">Step <?= $step ?></div>
            <div class="progress"><div class="progress-bar"></div></div>
            <span class="bs-wizard-dot"></span>
            <div class="bs-wizard-info text-center"><?= $description ?></div>
        </div>
    <?php endforeach; ?>
</div>
<br/>