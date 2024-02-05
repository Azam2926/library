<?php

namespace common\models;

use common\models\querys\ReviewsQuery;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

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
        return $this->hasOne(Resource::class, ['id' => 'resource_id'])->inverseOf('reviews');
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
