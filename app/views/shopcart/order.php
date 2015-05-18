<?php
use yii\helpers\Html;

$this->title = 'Order details';
?>
<h1>Order #<?= $order->id ?></h1>

<div class="well well-sm">Status: <b><?= $order->status ?></b></div>

<table class="table">
    <thead>
    <tr>
        <th>Item</th>
        <th width="100">Quantity</th>
        <th width="120">Unit Price</th>
        <th width="100">Total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($order->goods as $good) : ?>
        <tr>
            <td>
                <?= Html::a($good->item->title, ['/shop/view', 'slug' => $good->item->slug]) ?>
                <?= $good->options ? "($good->options)" : '' ?>
            </td>
            <td><?= $good->count ?></td>
            <td>
                <?php if($good->discount) : ?>
                    <del class="text-muted "><small><?= $good->item->oldPrice ?></small></del>
                <?php endif; ?>
                <?= $good->price ?>
            </td>
            <td><?= $good->price * $good->count ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" class="text-right">
            <h3>Total: <?= $order->cost ?>$</h3>
        </td>
    </tr>
    </tbody>
</table>
