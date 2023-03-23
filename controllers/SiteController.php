<?php

namespace app\controllers;

use app\components\ZKLibrary;
use app\library\zkteco\ZKTeco;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


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


    private function device()
    {
        //$zk = new ZKTeco('118.179.202.220', 43705, 5); //Old Version Device
        $zk = new ZKTeco('118.179.202.221', 43707, 5); //New Device
        //$zk = new ZKTeco('123.0.20.194', 50501, 5); //New Device Deshi

        //$zk = new ZKLibrary('118.179.202.220', 43705);  //Old Version Device
        //$zk = new ZKLibrary('118.179.202.221', 43707); //New Device

        $zk->connect();
//        dd($zk->version());
//        dd($zk->osVersion());
//        dd($zk->platform());
//        dd($zk->fmVersion());
//        dd($zk->serialNumber());
//        dd($zk->deviceModel());
//        dd($zk->getTime());
        //dd($zk->getUser());
        //dd($zk->clearAttendance());
        //dd($zk->faceFunctionOn());
        dd($zk->getAttendance($zk->deviceModel()));
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->device();
        //return $this->render('index');
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
}
