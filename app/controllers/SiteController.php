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
                $db = Yii::$app->db;

                $easyiiInstalled = $db->createCommand("SHOW TABLES LIKE 'easyii_%'")->query()->count() > 0 ? true : false;
                $siteInstalled = $db->createCommand()->select('COUNT(*)')->from(Page::tableName())->queryScalar() > 0 ? true : false;

                $this->_installed = $easyiiInstalled && $siteInstalled  ? true : false;
            } catch (\Exception $e) {
                $this->_installed = false;
            }
        }
        return $this->_installed;
    }
}