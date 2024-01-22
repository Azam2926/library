<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $user_id
 * @property int $resource_id
 * @property int|null $rating
 * @property string|null $comment
 * @property int|null $status
 * @property string|null $created_at
 *
 * @property Resource $resource
 * @property User $user
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'resource_id'], 'required'],
            [['user_id', 'resource_id', 'rating', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at'], 'safe'],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::class, 'targetAttribute' => ['resource_id' => 'id']],
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
            'resource_id' => 'Resource ID',
            'rating' => 'Rating',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery|\common\querys\ResourceQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('reviews');
    }

//    /**
//     * Gets query for [[User]].
//     *
//     * @return \yii\db\ActiveQuery|\common\querys\UserQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('reviews');
//    }

    /**
     * {@inheritdoc}
     * @return \common\models\querys\ReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\querys\ReviewsQuery(get_called_class());
    }
}
