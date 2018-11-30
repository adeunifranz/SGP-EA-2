<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\LoginForm as Login;
use app\models\Signup;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
   public function notbehaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup', 'about', 'home'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'about'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    public function actionInit()
    {
        $this->actionLanges();
        $this->actionIndex();
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionChangePassword()
    {
        $id = \Yii::$app->user->id;
     
        try {
            $model = new \app\models\ChangePasswordForm($id);
        } catch (InvalidParamException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }
     
        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            
            \Yii::$app->session->setFlash('success', 'Contraseña cambiada correctamente!');
            
             return $this->goHome();
        } else {
                return $this->render('changePassword', [
                    'model' => $model,
                ]);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }
        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $this->layout='main-login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionSignup()
    {
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    private function cambiarnombre($id)
    {
      $model = \app\models\User::findOne($id);
          if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->save();
             // echo '<pre>';
             // print_r($model);
             // echo '</pre>';
             return $this->redirect(['update']);
          }
          else {
             return $this->render('cnombre',['model'=>$model]);
          }
    }

    public function actionUpdate($id = null)
    {
        $searchModel = new \app\models\UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($id!=null) {
          return $this->cambiarnombre($id);
        }
        return $this->render('update', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    // public function init()
    // {
    //   \Yii::$app->language = \Yii::$app->session['lang'];
    //   return $this->render('index');
    // }
    public function actionLangen()
    {
      $session = \Yii::$app->session;
      $session -> set('lang', 'en');
      \Yii::$app->language = \Yii::$app->session['lang'];
      return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionLanges()
    {
      $session = \Yii::$app->session;
      $session -> set('lang', 'es');
      \Yii::$app->language = \Yii::$app->session['lang'];
     return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionReinicializarbdd($conf)
    {
      if($conf='SI')
      {
        $connection=Yii::$app->db;

        $connection->createCommand()->truncateTable('devolucion')->execute();
        $connection->createCommand()->truncateTable('devuelto')->execute();        
        $connection->createCommand()->truncateTable('prestamo')->execute();
        $connection->createCommand()->truncateTable('prestado')->execute();        
        $result = $connection->createCommand()->update('articulo', ['DISP_ART' => 0], '')->execute();

        // echo '<pre>';
        //   print_r($result);
        // echo '</pre>';       
        ?>
          <h2>REINICIADO LOS REGISTROS CON EXITO</h2>
        <?php 
        echo '<a href="'.Url::home().'">Salir</a>';
      }
    }
}
