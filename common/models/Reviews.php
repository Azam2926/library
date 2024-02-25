<?php

namespace common\models;

use common\querys\ReviewsQuery;
use JetBrains\PhpStorm\ArrayShape;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

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
class Reviews extends ActiveRecord
{
    const ONLY_RATING = 1;
    const ONLY_COMMENT = 2;
    const RATING_COMMENT = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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

    #[ArrayShape(['timestamp' => "array"])] public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    #[ArrayShape(['id' => "string", 'user_id' => "string", 'resource_id' => "string",
        'rating' => "string", 'comment' => "string",
        'status' => "string", 'created_at' => "string"])] public function attributeLabels(): array
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
     * @return ActiveQuery
     */
    public function getResource(): ActiveQuery
    {
        return $this->hasOne(Resource::class, ['id' => 'resource_id']);
    }
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ReviewsQuery the active query used by this AR class.
     */
    public static function find(): ReviewsQuery
    {
        return new ReviewsQuery(get_called_class());
    }
}
