<?php

namespace app\controllers;

use yii\easyii\modules\gallery\api\Gallery;

class GalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($slug)
    {
        $album = Gallery::cat($slug);
        if(!$album){
            throw new \yii\web\NotFoundHttpException('Album not found.');
        }

        return $this->render('view', [
            'album' => $album,
            'photos' => $album->photos(['pagination' => ['pageSize' => 4]])
        ]);
    }
}
