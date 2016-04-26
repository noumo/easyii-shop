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
    public $cpuCores;
    public $touchscreen = false;

    public function rules()
    {
        return [
            [['priceFrom', 'priceTo', 'storageFrom', 'storageTo'], 'number', 'min' => 0],
            ['touchscreen', 'boolean'],
            ['brand', 'string'],
            ['cpuCores', 'each', 'rule' => ['integer']]
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
            'cpuCores' => 'Cpu cores'
        ];
    }

    public function parse()
    {
        $filters = [];

        if ($this->brand) {
            $filters['brand'] = $this->brand;
        }

        if ($this->priceFrom > 0 && $this->priceTo > 0) {
            $filters['price'] = ['between', $this->priceFrom, $this->priceTo];
        } elseif ($this->priceFrom > 0) {
            $filters['price'] = ['>', $this->priceFrom];
        } elseif ($this->priceTo > 0) {
            $filters['price'] = ['<', $this->priceTo];
        }

        if ($this->storageFrom > 0 && $this->storageTo > 0) {
            $filters['storage'] = ['between', $this->storageFrom, $this->storageTo];
        } elseif ($this->storageFrom > 0) {
            $filters['storage'] = ['>', $this->storageFrom];
        } elseif ($this->storageTo > 0) {
            $filters['storage'] = ['<', $this->storageTo];
        }

        if ($this->touchscreen) {
            $filters['touchscreen'] = $this->touchscreen;
        }
        if (!empty($this->cpuCores) && is_array($this->cpuCores)) {
            $filters['cpu'] = ['in', $this->cpuCores];
        }

        return $filters;
    }
}