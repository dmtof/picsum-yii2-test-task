<?php

namespace app\controllers;

use app\models\Image;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;

class ImageController extends Controller
{
    public function actionIndex()
    {
        $param = Yii::$app->request->getQueryParam('imageId');
        $imageId = !empty($param) ? $param : $this->getRandomImageId();
        $imageUrl = "https://picsum.photos/{$imageId}/600/500";

        return $this->render('index', ['imageUrl' => $imageUrl, 'imageId' => $imageId]);
    }

    public function actionDecision()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = json_decode(Yii::$app->request->getRawBody());

        $model = new Image();
        $model->image_id = $data->image_id;
        $model->decision = $data->decision;

        if ($model->save()) {
            return ['success' => true, 'nextImageId' => $this->getRandomImageId()];
        }

        return ['success' => false];
    }

    private function getRandomImageId()
    {
        $usedIds = Image::find()->select('image_id')->column();
        $possibleIds = range(1, 1000);
        $availableIds = array_diff($possibleIds, $usedIds);

        if (empty($availableIds)) {
            return null;
        }

        return $availableIds[array_rand($availableIds)];
    }


    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = json_decode(Yii::$app->request->getRawBody());
        $imageId = $data->image_id;
        $image = Image::find()->where(['image_id' => $imageId])->one();
        $image?->delete();
        return ['success' => true];
    }

}