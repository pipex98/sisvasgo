<?php

namespace app\controllers;

use Yii;
use app\models\Person;
use app\models\User;
use app\models\PersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * {@inheritdoc}
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
        ];
    }

    public function actionSupplierList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $suppliers = Person::getPersonTypeSupplier();

        return ArrayHelper::getColumn($suppliers, function ($el) {
            return [
                'id' => $el->id,
                'text' => $el->name
            ];
        });
    }

    public function actionClientList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $clients = Person::getPersonTypeClient();

        return ArrayHelper::getColumn($clients, function ($el) {
            return [
                'id' => $el->id,
                'text' => $el->name
            ];
        });
    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            
            if ($model->save()) {
                
                if (isset($post['createUser'])) {
                    
                    $file = UploadedFile::getInstance($model, 'picture');
                    $path = '@webroot/uploads/avatars/' . $file->baseName . '.' . $file->extension;
                    
                    if ($file->saveAs($path)) {
                        $model->picture = $file->baseName . '.' . $file->extension;
                        User::createUserForPerson($model);
                    }
                }
                
                Yii::$app->session->setFlash('success',Yii::t('person','Person created successfully'));
            } else {
                Yii::$app->session->setFlash('success',Yii::t('person','Person not saved'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $path = '@web/uploads/avatars/' . $model->picture;

        $current_picture = $model->picture;

        $post = Yii::$app->request->post();

        if ($model->load($post)) {

            if ($_FILES['Person']['name']['picture']) {
                
                $file = UploadedFile::getInstance($model, 'image');
                $path = '@webroot/uploads/items/' . $file->baseName . '.' . $file->extension;

                if ($file->saveAs($path)) {
                    
                    $model->image = $file->baseName . '.' . $file->extension;

                    if ($model->save()) {
                        Yii::$app->session->setFlash('success',Yii::t('person','Person updated successfully'));
                    } else {
                        Yii::$app->session->setFlash('success',Yii::t('person','Person not updated'));
                    }
                    return $this->redirect(['index']);
                }
            } else {
                
                $model->picture = $current_picture;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success',Yii::t('person','Person updated successfully'));
                } else {
                    Yii::$app->session->setFlash('success',Yii::t('person','Person not updated'));
    
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'path' => $path,
        ]);
    }

    /**
     * Deactivate an existing Person model.
     * If deactivate is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeactivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 0;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('person','Person deactivated successfully'));
            User::blockUser($model->id);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('person','Person not deactivated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Activate an existing Person model.
     * If activate is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 1;
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('person','Person activated successfully'));
            User::unlockUser($model->id); 
        } else {
            Yii::$app->session->setFlash('error', Yii::t('person','Person not activated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('person', 'The requested page does not exist.'));
    }
}
