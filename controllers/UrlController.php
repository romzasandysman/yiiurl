<?php


namespace app\controllers;


use app\models\UrlForm;
use app\models\UrlShortView;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;

class UrlController extends Controller
{
    public function actionIndex()
    {
        $model = new UrlForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dbUrlsTable = new UrlShortView(Html::encode($model->url));
            return $this->render('index', ['model' => $model, 'success' => true,'shortUrl' => Url::base(true).'/'.$dbUrlsTable->getShortUrl()]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }
}