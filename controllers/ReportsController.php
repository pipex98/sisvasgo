<?php

namespace app\controllers;

use Yii;
use app\models\Deposit;
use app\models\Sale;
use app\models\Person;
use yii\helpers\ArrayHelper;

class ReportsController extends \yii\web\Controller
{

    public function actionPurchasesDate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $post = Yii::$app->request->post();

        if ($post) {

            $purchases = Deposit::getPurchasesDate($post['startDate'], $post['endDate']);
    
            return [
                'purchases' => $purchases,
            ];
        }
        
    }

    public function actionSalesDateClient()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $post = Yii::$app->request->post();

        if ($post) {

            $sales = Sale::getSalesDateClient($post['startDate'], $post['endDate'], $post['clientId']);
            
            return [
                'sales' => $sales
            ];
        }
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

    public function actionPurchasesQuery()
    {
        return $this->render('purchases-query');
    }

    public function actionSalesQuery()
    {
        return $this->render('sales-query');
    }

}
