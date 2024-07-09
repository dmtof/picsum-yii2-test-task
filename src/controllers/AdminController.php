<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Image;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $param = Yii::$app->request->getQueryParam('token');
        if (!$param || $param !== 'xyz123') return $this->goHome();

        $images = Image::find()->all();

        return $this->render('index', [
            'images' => $images,
        ]);
    }

}