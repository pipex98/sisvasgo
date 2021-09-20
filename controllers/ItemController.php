<?php

namespace app\controllers;

use Yii;
use app\models\Item;
use app\models\SaleDetail;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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

    public function actionItemsList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $items = Item::getItemsList();

        return ArrayHelper::getColumn($items, function ($el) {
            return [
                'id' => $el->id,
                'name' => $el->name,
                'category' => $el->category->name,
                'code' => $el->code,
                'stock' => $el->stock,
                'image' => $el->image
            ];
        });
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        $post = Yii::$app->request->post();

        if ($model->load($post)) {

            $file = UploadedFile::getInstance($model, 'image');
            $path = '@webroot/uploads/items/' . $file->baseName . '.' . $file->extension;

            if ($file->saveAs($path)) {
                $model->image = $file->baseName . '.' . $file->extension;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('item','Item created successfully.'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('item','Item not saved.'));
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $path = '@web/uploads/items/'. $model->image;

        $current_image = $model->image;

        $post = Yii::$app->request->post();

        if ($model->load($post)) {

            if ($_FILES['Item']['name']['image']) {
                
                $file = UploadedFile::getInstance($model, 'image');
                $path = '@webroot/uploads/items/' . $file->baseName . '.' . $file->extension;

                if ($file->saveAs($path)) {
                    $model->image = $file->baseName . '.' . $file->extension;

                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', Yii::t('item','Item updated successfully.'));
                    } else {
                        Yii::$app->session->setFlash('error', Yii::t('item','Item not updated.'));
                    }
                    return $this->redirect(['index']);
                } 
            } else {

                $model->image = $current_image;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('item','Item updated successfully.'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('item','Item not updated.'));
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
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeactivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 0;

        $model->save();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('item','Item deactivated successfully.'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('item','Item not deactivated.'));
        }

        return $this->redirect(['index']);
    }

    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 1;

        $model->save();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('item','Item activated successfully.'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('item','Item not activated.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
