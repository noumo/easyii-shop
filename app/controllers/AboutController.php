<?php

namespace app\controllers;

use Yii;
use yii\easyii\modules\page\api\Page;
use yii\web\Controller;

class AboutController extends Controller
{
    public function actionIndex($subpage = null)
    {
        $page = Page::get($subpage ? $subpage : 'about');
        return $this->render('index', [
            'page' => $page,
            'subpageSlug' => $subpage
        ]);
    }
}