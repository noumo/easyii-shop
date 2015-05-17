<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-shopcart');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>

<br/>

<?php if(count($goods)) : ?>
    <div class="row">
        <div class="col-md-6">
            <?= Html::beginForm(['/shopcart/update'])?>
            <table class="table">
                <thead>
                <tr>
                    <th>Item</th>
                    <th width="100">Quantity</th>
                    <th width="120">Unit Price</th>
                    <th width="100">Total</th>
                    <th width="30"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($goods as $good) : ?>
                    <tr>
                        <td>
                            <?= Html::a($good->item->title, ['/shop/view', 'slug' => $good->item->slug]) ?>
                            <?= $good->options ? "($good->options)" : '' ?>
                        </td>
                        <td><?= Html::textInput("Good[$good->id]", $good->count, ['class' => 'form-control input-sm']) ?></td>
                        <td>
                            <?php if($good->discount) : ?>
                                <del class="text-muted "><small><?= $good->item->oldPrice ?></small></del>
                            <?php endif; ?>
                            <?= $good->price ?>
                        </td>
                        <td><?= $good->price * $good->count ?></td>
                        <th><?= Html::a('<i class="glyphicon glyphicon-trash text-danger"></i>', ['/shopcart/remove', 'id' => $good->id], ['title' => 'Remove item']) ?></th>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="text-right">
                        <h3>Total: <?= Shopcart::cost() ?>$</h3>
                    </td>
                </tr>
                </tbody>
            </table>
            <?= Html::submitButton('<i class="glyphicon glyphicon-refresh"></i> Update', ['class' => 'btn btn-default pull-right']) ?>
            <?= Html::endForm()?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <h4>Checkout</h4>
            <div class="well well">
                <?= Shopcart::form(['successUrl' => Url::to('/shopcart/success')])?>
            </div>
        </div>
    </div>
<?php else : ?>
    <p>Shopping cart is empty</p>
<?php endif; ?>
