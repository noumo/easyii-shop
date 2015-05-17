<?php
namespace app\models;

use yii\base\Model;

class AddToCartForm extends Model
{
    const SUCCESS_VAR = 'success';

    public $color;
    public $count = 1;

    public function rules()
    {
        return [
            [['count'], 'required'],
            ['count', 'integer', 'min' => 1],
            ['color', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'count' => 'Quantity',
            'color' => 'Color',
        ];
    }
}