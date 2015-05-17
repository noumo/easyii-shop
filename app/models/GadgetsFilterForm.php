<?php
namespace app\models;

use Yii;
use yii\base\Model;

class GadgetsFilterForm extends Model
{
    public $brand;
    public $priceFrom;
    public $priceTo;
    public $storageFrom;
    public $storageTo;
    public $touchscreen = false;

    public function rules()
    {
        return [
            [['priceFrom', 'priceTo', 'storageFrom', 'storageTo'], 'number', 'min' => 0],
            ['touchscreen', 'boolean'],
            ['brand', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'brand' => 'Brand',
            'priceFrom' => 'Price from',
            'priceTo' => 'Price to',
            'storageFrom' => 'Storage from',
            'storageTo' => 'Storage to',
            'touchscreen' => 'Touchscreen',
        ];
    }

    public function parse()
    {
        $filters = [];

        if ($this->brand) {
            $filters['brand'] = $this->brand;
        }

        if ($this->priceFrom > 0 || $this->priceTo > 0) {
            $filters['price'] = [$this->priceFrom, $this->priceTo];
        }

        if ($this->storageFrom > 0 || $this->storageTo > 0) {
            $filters['storage'] = [$this->storageFrom, $this->storageTo];
        }

        if ($this->touchscreen) {
            $filters['touchscreen'] = $this->touchscreen;
        }

        return $filters;
    }
}