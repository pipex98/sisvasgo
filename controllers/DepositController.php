<?php

namespace app\controllers;

use Yii;
use app\models\Deposit;
use app\models\DepositDetail;
use app\models\DepositSearch;
use app\models\VoucherType;
use app\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * DepositController implements the CRUD actions for Deposit model.
 */
class DepositController extends Controller
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

    private function getMappedDetails($model)
    {
        $itemDetails = DepositDetail::getDetailsList($model);

        return ArrayHelper::getColumn($itemDetails, function ($el) {
            return [
                'name' => $el->item->name,
                'quantity' => $el->quantity,
                'purchase_price' => $el->purchase_price,
                'sale_price' => $el->sale_price,
            ];
        });
    }

    public function actionDetailsList($id) {
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        $itemDetails = $this->getMappedDetails($id);

        return [
            'itemDetails' => $itemDetails,
            'deposit' => $model->attributes,
            'supplier_name' => $model->supplier->name,
            'voucher_name' => $model->voucherType->name
        ];
    }

    public function actionVoucherTypes()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $types = VoucherType::getVouchersType();

        return ArrayHelper::getColumn($types, function ($el) {
            return [
                'id' => $el->id,
                'text' => $el->name
            ];
        });
    }

    /**
     * Lists all Deposit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepositSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deposit model.
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
     * Creates a new Deposit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deposit();

        $post = Yii::$app->request->post();

        if ($post) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $model->load($post, 'deposit');
            $model->total_purchase = $post['totalPurchase'];
            $model->user_id = Yii::$app->user->identity->id;
            
            if ($model->save()) {
                if (count($post['itemsDetails'])) {
                    $items = $post['itemsDetails'];

                    foreach ($items as $item) {
                        
                        $newItemDetail = new DepositDetail();
                        $newItemDetail->deposit_id = $model->id;
                        $newItemDetail->item_id = $item['id'];
                        $newItemDetail->quantity = $item['quantity'];
                        $newItemDetail->purchase_price = $item['purchase_price'];
                        $newItemDetail->sale_price = $item['sale_price'];

                        $newItemDetail->save(false);

                        $item = Item::find()->where(['id' => $newItemDetail->item_id])->one();
                        $item->stock = $item->stock + $newItemDetail->quantity;
                        $item->save();
                    }
                }
                Yii::$app->session->setFlash('success',Yii::t('deposit','Deposit created successfully'));
                return [
                    'code' => 201
                ];
            } else {
                Yii::$app->session->setFlash('error',Yii::t('deposit','Deposit not saved'));
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
     * Deactivate an existing Deposit model.
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
            Yii::$app->session->setFlash('success', Yii::t('deposit','Deposit deactivated successfully'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('deposit','Deposit not deactivated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Activate an existing Deposit model.
     * If activation is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        $model->state = 1;

        $model->save();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('deposit','Deposit activated successfully'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('deposit','Deposit not activated'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Deposit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deposit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deposit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('deposit', 'The requested page does not exist.'));
    }
}
