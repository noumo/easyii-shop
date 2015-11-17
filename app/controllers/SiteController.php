<?php

namespace app\controllers;

use Yii;
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\entity\api\Entity;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\news\api\News;
use yii\web\Controller;

class SiteController extends Controller
{
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
        if(!Yii::$app->getModule('admin')->installed){
            return $this->redirect(['/install/step1']);
        }

        $lastNews = News::last();
        $lastArticle = Article::last(1, ['category_id' => 1]);

        return $this->render('index', [
            'features' => Entity::cat('features')->items(),
            'lastPhotos' => Gallery::last(6),
            'lastNews' => count($lastNews) ? $lastNews[0] : null,
            'lastArticle' => count($lastArticle) ? $lastArticle[0] : null,
            'lastPosts' => Guestbook::last(2),
        ]);
    }
}