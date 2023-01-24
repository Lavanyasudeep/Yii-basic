<?php

namespace app\controllers;

use yii;
use yii\web\Controller;

use app\models\Country;
use app\models\CountrySearch;


class CountriesController extends Controller
{
    public function actionIndex()
    {
            $model = new Country();
            
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                $model = new Countries(); //reset model
            }
            
            $searchModel = new CountrySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
    }
}