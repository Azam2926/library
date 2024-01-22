<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $created_at
 *
 * @property OrderList[] $orderLists
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[OrderLists]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\OrderListQuery
     */
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::class, ['order_id' => 'id'])->inverseOf('order');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('orders');
    }

    /**
     * {@inheritdoc}
     * @return \common\querys\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\querys\OrderQuery(get_called_class());
    }
}
