<?php

namespace app\controllers;

use yii\easyii\modules\faq\api\Faq;

class FaqController extends \yii\web\Controller
{
    public function actionIndex($tag = null)
    {
        $faq = Faq::items(['tags' => $tag]);

        return $this->render('index', ['faq' => $faq]);
    }

}
