<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $status
 * @property float $subTotal
 * @property float $itemDiscount
 * @property float $tax
 * @property float $shipping
 * @property float $total
 * @property string|null $promo
 * @property float $discount
 * @property float $grandTotal
 * @property string|null $firstName
 * @property string|null $middleName
 * @property string|null $lastName
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $line1
 * @property string|null $line2
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property OrderItems[] $orderItems
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['subTotal', 'itemDiscount', 'tax', 'shipping', 'total', 'discount', 'grandTotal'], 'number'],
            [['created_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['promo', 'firstName', 'middleName', 'lastName', 'email', 'line1', 'line2', 'city', 'province', 'country'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'subTotal' => 'Sub Total',
            'itemDiscount' => 'Item Discount',
            'tax' => 'Tax',
            'shipping' => 'Shipping',
            'total' => 'Total',
            'promo' => 'Promo',
            'discount' => 'Discount',
            'grandTotal' => 'Grand Total',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'line1' => 'Line1',
            'line2' => 'Line2',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
