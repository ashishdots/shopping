<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\components;

use Yii;
use yii\base\Component;
use \yii\base\ErrorException;
use \yii\base\UserException;
use \yii\helpers\ArrayHelper;

/**
 * Description of Pager
 *
 * @author Ashish
 */
class Cart extends Component {

    public function  __construct(){
        parent::__construct();
    }

    public static function addToCart($productId, $quantity = 1) {
        try {
            if($productId && $quantity) {
                $session = Yii::$app->session;
                if($cart = $session->get('cart')) {
                    $cart[$productId] = ArrayHelper::getValue($cart,$productId) + $quantity;
                     $session->set('cart',$cart);
                } else {
                    $session->set('cart',[$productId => $quantity]);
                }
                return true;
            } else {
                throw new UserException("Product Id/Quantity is missing.");
            }

        } catch(UserException $ex) {
                throw new UserException($ex->getMessage());
    	} catch(yii\base\ErrorException | \Exception $ex) {
                Yii::error("Something went wrong adding product to cart".$ex->getMessage(),'AddToCart');
                throw new UserException("Something went wrong. Please try again.");
    	}
    }

    public static function removeFromCart($productId) {
        try {
            if($productId) {
                $session = Yii::$app->session;
                if($cart = $session->get('cart')) {
                    if(ArrayHelper::getValue($cart,$productId)) {
                        unset($cart[$productId]);
                        $session->set('cart',$cart);
                    } 
                } else {
                    $session->set('cart',[$productId => $quantity]);
                }
                return true;
            } else {
                throw new UserException("Product Id is missing.");
            }

        } catch(UserException $ex) {
                throw new UserException($ex->getMessage());
    	} catch(yii\base\ErrorException | \Exception $ex) {
                Yii::error("Something went wrong adding product to cart".$ex->getMessage(),'AddToCart');
                throw new UserException("Something went wrong. Please try again.");
    	}
    }
    
    public static function getCart() {
        $session = Yii::$app->session;
        if($cart = $session->get('cart')) {
            return $cart;
        }       
    }

}