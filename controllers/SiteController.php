<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\RegisterForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message="Hello")
    {
        return $this->render('say',['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            return $this->render('entry-confirm',['model' => $model]);
        }
        else
        {
            return $this->render('entry',['model' => $model]);
        }
    }

    public function actionRegister()
    {
        // $model = new MSE_Gapps_Pending();
        $model = new RegisterForm();

        if($model->load(Yii::$app->request->post()))
        {
            // $model->attributes = Yii::$app->request->post(); 

            $valid = $model->validate();
            $model->photos = UploadedFile::getInstances($model, 'photos');

            if($model->upload()) {
                $model->subscriptions = implode(",",$model->subscriptions);
                $model->photos = implode(",",$model->photos);
                // foreach($model->photos as $file) {
                //     $file->saveAs('../uploads/'.$file->baseName.'.'.$file->extension);
                // }
                // echo '<pre>'; print_r($model->photos);
                // exit;

                if($model->save(false))
                    return $this->render('register-success', ['model'=>$model]);
            }
        }
        else{
            return $this->render('register-form',['model'=>$model]);
        }
    }
    
}
