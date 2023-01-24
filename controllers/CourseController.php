<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Course;


class CourseController extends Controller
{
    /**
     * @inheritDoc
     */

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' =>  [
                    'class' =>  VerbFilter::className(),
                    'actions'   =>  [
                        'delete'   =>   ['POST'],
                    ],
                ],

            ]
            );
    }

     /**
     * Lists all Course models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $searchModel = new Course();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index',[
            'searchModel'   =>  $searchModel,
            'dataProvider'  =>  $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Course();

        if($this->request->isPost)
        {
            if($model->load(Yii::$app->request->post()) && $model->save(false))
            {
                return $this->render('index',[
                    'model' =>  $model,
                ]);
            } else {
                $model->loadDefaultValues();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $query = Yii::$app->db->createCommand("
                            SELECT cr.id, cr.title, ct.name as category, cr.level, cr.status
                            FROM course cr
                            LEFT JOIN category ct ON ct.id = cr.category_id
                            WHERE cr.id=".$id)->queryAll();
        // $query = Course::find()
        //     ->select('cr.id', 'cr.title', 'ct.title as category', 'sc.title as sub_category', 'cr.level', 'cr.status')
        //     ->from('course cr')
        //     ->leftjoin('category ct','ct.id = cr.category_id')
        //     ->leftjoin('sub_category sc','sc.id = cr.sub_category_id')
        //     ->where('cr.id ='.$id);
        // echo '<pre>'; print_r($query);
        // exit;

        return $this->render('view',['model' => $query[0]]);
    }

    public function actionUpdate($id)
    {
        $model = Course::findOne($id);

        if($this->request->isPost && $model->load($this->request->post()) && $model->save())
        {
            return $this->redirect(['view','id'=>$model->id]);
        }
        return $this->render('update',[
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findOne($id)
    {
        if(($model = Course::findOne(['id'=>$id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist. ');
    }
}