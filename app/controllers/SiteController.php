<?php

namespace app\controllers;

use Yii;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;

class SiteController extends Controller
{
    private $_installed;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if(!$this->installed){
            return $this->redirect(['/site/start']);
        }
        return $this->render('index');
    }

    public function actionStart()
    {
        $this->layout = 'base';
        return $this->render('start');
    }

    public function getInstalled()
    {
        if($this->_installed === null) {
            try {
                if(!Yii::$app->getModule('admin')->installed || !Page::find()->count()){
                    $this->_installed = false;
                } else {
                    $this->_installed = true;
                }
            } catch (\Exception $e) {
                $this->_installed = false;
            }
        }
        return $this->_installed;
    }
}