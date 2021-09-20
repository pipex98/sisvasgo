<?php

namespace app\controllers;

use Yii;
use app\models\Sale;
use app\models\SaleDetail;
use app\models\DepositDetail;
use app\models\Item;
use app\models\SaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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

    public function actionItemsSaleActive() {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $itemsActiveSale = DepositDetail::getItemsActiveSale();

        return ArrayHelper::getColumn($itemsActiveSale, function ($el) {
            return [
                'item_id' => $el->item->id,
                'item_name' => $el->item->name,
                'item_category' => $el->item->category->name,
                'item_code' => $el->item->code,
                'item_stock' => $el->item->stock,
                'item_description' => $el->item->description,
                'sale_price' => $el->sale_price,
                'item_image' => $el->item->image
            ];
        });
    }

    private function getMappedDetails($model)
    {
        $itemDetails = SaleDetail::getDetailsList($model);

        return ArrayHelper::getColumn($itemDetails, function ($el) {
            return [
                'name' => $el->item->name,
                'quantity' => $el->quantity,
                'sale_price' => $el->sale_price,
                'discount' => $el->discount,
            ];
        });
    }

    public function actionDetailsList($id) {
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        $itemDetails = $this->getMappedDetails($id);

        return [
            'itemDetails' => $itemDetails,
            'sale' => $model->attributes,
            'client_name' => $model->client->name,
            'voucher_name' => $model->voucherType->name,
        ];
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('update', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();

        $post = Yii::$app->request->post();

        if ($post) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $model->load($post, 'sale');
            $model->total_sale = $post['totalSale'];
            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                if (count($post['itemsDetails'])) {
                    $items = $post['itemsDetails'];

                    foreach ($items as $item) {

                        $newItemDetail = new SaleDetail();
                        $newItemDetail->sale_id = $model->id;
                        $newItemDetail->item_id = $item['item_id'];
                        $newItemDetail->quantity = $item['quantity'];
                        $newItemDetail->sale_price = $item['sale_price'];

                        if (isset($item['discount'])) {
                            $newItemDetail->discount = $item['discount'];
                        }

                        $newItemDetail->save(false);

                        $item = Item::find()->where(['id' => $newItemDetail->item_id])->one();
                        $item->stock = $item->stock - $newItemDetail->quantity;
                        $item->save();
                    }
                }
                Yii::$app->session->setFlash('success',Yii::t('sale','Sale created succesfully'));
                return [
                    'code' => 201
                ];
            } else {
                Yii::$app->session->setFlash('error',Yii::t('sale','Sale not saved'));
                return [
                    'code' => 400
                ];
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Deactivate an existing Sale model.
     * If deactivation is successful, the browser will be redirected to the 'index' page.
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
            Yii::$app->session->setFlash('success', Yii::t('sale','Sale deactivated successfully'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('sale','Sale not deactivated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Activate an existing Sale model.
     * If activation is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 1;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('sale','Sale activated successfully'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('sale','Sale not activated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('sale', 'The requested page does not exist.'));
    }
}
