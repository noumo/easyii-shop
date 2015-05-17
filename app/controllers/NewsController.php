<?php
namespace app\controllers;

use yii\easyii\modules\news\api\News;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($slug)
    {
        $news = News::get($slug);
        if(!$news){
            throw new \yii\web\NotFoundHttpException('News not found.');
        }

        return $this->render('view', [
            'news' => $news
        ]);
    }
}
