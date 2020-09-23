<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\components\Cart;
use \yii\helpers\ArrayHelper;
use \yii\base\ErrorException;
use \yii\base\UserException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxController
 *
 * @author Ashish
 */
class AjaxController extends Controller {

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
    }
    
    public function beforeAction($action) {
        if (!Yii::$app->request->isAjax) {
            throw new UserException('Something went wrong while accessing the URL.');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionAddCart() {
        try {
            if ($data = Yii::$app->request->post()) {
                if (Cart::addToCart(ArrayHelper::getValue($data,'product_id'),ArrayHelper::getValue($data,'quantity',1))) {
                    return ['status' =>  true, 'message' => 'Product added to cart successfully.'];
                }
            } else {
                throw new UserException("Missing required details of product.");
            }
        } catch(UserException $ex) {
                return $ex->getMessage();
    	} catch(yii\base\ErrorException | \Exception $ex) {
                Yii::error("Something went wrong adding product to cart".$ex->getMessage(),'AddToCart');
                return "Something went wrong. Please try again.";
    	}
    }

    public function actionRemoveCart() {
        try {
            if ($data = Yii::$app->request->post()) {
                if (Cart::removeFromCart(ArrayHelper::getValue($data,'product_id'))) {
                    return ['status' =>  true, 'message' => 'Product removed from cart successfully.'];
                }
            } else {
                throw new UserException("Missing required details of product.");
            }
        } catch(UserException $ex) {
                return $ex->getMessage();
    	} catch(yii\base\ErrorException | \Exception $ex) {
                Yii::error("Something went wrong adding product to cart".$ex->getMessage(),'AddToCart');
                return "Something went wrong. Please try again.";
    	}
    }
    
}
