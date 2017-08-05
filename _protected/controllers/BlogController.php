<?php

namespace app\controllers;

use Yii;
use app\models\Blog;
use app\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */

class BlogController extends Controller
{


    public $layout  = 'admin';
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }



    /**
     * Lists all Blog models.
     * @return mixed
     */


    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/uploads/img', // Directory URL address, where files are stored.
                'path' => '@upload' // Or absolute path to directory where files are stored.
            ],

            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/uploads/img', // Directory URL address, where files are stored.
                'path' => '@upload', // Or absolute path to directory where files are stored.
                'type' => '\vova07\imperavi\actions\GetAction::TYPE_IMAGES',
            ],

            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/uploads/file', // Directory URL address, where files are stored.
                'path' => '@upload', // Or absolute path to directory where files are stored.
                'type' => '\vova07\imperavi\actions\GetAction::TYPE_FILES',//GetAction::TYPE_FILES,
            ],

            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/uploads/file', // Directory URL address, where files are stored.
                'path' => '@upload', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false,
                'validatorOptions' => [
                    'maxSize' => 104857600
                ]
            ],
        ];

    }


    public function actionCreate()
    {
        $model = new Blog();
        $model->created_by = "0";
        $model->updated_by = "0";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function beforeAction($action) 
    {
        $this->enableCsrfValidation = false;        /*Рeшение проблемы с удалением постов*/
        return parent::beforeAction($action); 
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
