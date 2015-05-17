<?php
namespace app\models;

use yii\base\Model;

class SearchForm extends Model
{
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