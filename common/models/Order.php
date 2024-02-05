<?php

namespace common\models;

use common\querys\OrderListQuery;
use common\querys\OrderQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    #[ArrayShape(['id' => "string", 'user_id' => "string", 'created_at' => "string"])] public function attributeLabels(): array
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
     * @return ActiveQuery|OrderListQuery
     */
    public function getOrderLists(): ActiveQuery|OrderListQuery
    {
        return $this->hasMany(OrderList::class, ['order_id' => 'id'])->inverseOf('order');
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery|\common\querys\UserQuery
     */
    public function getUser(): ActiveQuery|\common\querys\UserQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('orders');
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find(): OrderQuery
    {
        return new OrderQuery(get_called_class());
    }
}
