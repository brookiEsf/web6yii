<?php

namespace app\controllers;

use app\models\resetPassword;
use Yii;
use yii\debug\models\search\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Userdb;
use app\models\SignUp;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        $model = Userdb::findone(1);
//        echo '<pre>';
//        print_r($model);
//        echo '</pre>';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) { //встановити властивості моделі $_POST==Yii->
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

    public function actionSignUp()
    {
        $data = new SignUp();
        if ($data->load(Yii::$app->request->post()) && $data->SignUp()) {
            Yii::$app->session->setFlash('success', 'ty 4 registration');
        }
        $data->password = '';
        $data->confirmPassword = '';

        return $this->render('signup', ['model' => $data]);
    }

    public function actionResetPassword()
    {

        $model = new resetPassword();
        //$modelTest->resetPassword();


        //  $model = new \app\models\Userdb();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->resetPassword()) {
                // print_r($model);
                Yii::$app->session->setFlash('success', 'email has been send, check your email');
            } else {
                Yii::$app->session->setFlash('error', 'can`t find this email');
            }
        }

        return $this->render('userResetPassword', [
            'model' => $model,
        ]);
    }


    public function actionNewPasswordEnter()
    {
        $model = new \app\models\Userdb();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('newPasswordEnter', [
            'model' => $model,
        ]);
    }


}
