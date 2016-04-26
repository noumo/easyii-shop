<?php
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$plainPageTitle = $cat->getTitle(false);

$this->title = $cat->seo('title', $plainPageTitle);

$this->params['keywords'] = $cat->seo('keywords');
$this->params['description'] = $cat->seo('description');

$this->params['breadcrumbs'][] = ['label' => Page::get('shop')->getTitle(false), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $plainPageTitle;

?>
<h1><?= $cat->seo('h1', $cat->title) ?></h1>
<br/>

<div class="row">
    <div class="col-md-8">
        <?php if(count($items)) : ?>
            <br/>
            <?php foreach($items as $item) : ?>
                <?= $this->render('_item', ['item' => $item]) ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Category is empty</p>
        <?php endif; ?>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <h4>Filters</h4>
        <div class="well well-sm">
            <?php $form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/shop/cat', 'slug' => $cat->slug])]); ?>
                <?= $form->field($filterForm, 'brand')->dropDownList($cat->fieldOptions('brand', 'Select brand')) ?>
                <?= $form->field($filterForm, 'priceFrom') ?>
                <?= $form->field($filterForm, 'priceTo') ?>
                <?= $form->field($filterForm, 'touchscreen')->checkbox() ?>
                <?= $form->field($filterForm, 'storageFrom') ?>
                <?= $form->field($filterForm, 'storageTo') ?>
                <?= $form->field($filterForm, 'cpuCores', ['options' => ['class' => 'checkbox-list-margin']])->checkboxList(['1' => '1', '2' => '2', '4' => '4', '8' => '8']) ?>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



<?= $cat->pages ?>