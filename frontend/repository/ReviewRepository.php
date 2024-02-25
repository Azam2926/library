<?php

namespace frontend\repository;

use common\models\Reviews;

class ReviewRepository
{
    /**
     * @param $resource_id
     * @return Reviews[]
     */

    public function getReviewsList($resource_id): array
    {
        return Reviews::find()->findByResourceId($resource_id)->all();
    }

    /**
     * @param int $resourceId
     * @return Reviews[]
     */

    public function reviewsListGroupByUser(int $resourceId): array
    {
        return  Reviews::find()
            ->select(['reviews.user_id', 'COUNT(*) AS count', 'user.username AS username'])
            ->innerJoin('user', 'reviews.user_id = user.id')
            ->andWhere(['resource_id' => $resourceId])
            ->groupBy('reviews.user_id')->all();
    }

    public function getReviewsListByRating($resource_id): array
    {
        return Reviews::find()->findByResourceId($resource_id)->getByRating()->all();
    }

    /**
     * @param $userId
     * @return Reviews[]
     */

    public function getByUserId($userId): array
    {
        return Reviews::find()->andWhere(['user_id' => $userId])->orderBy(['created_at' => SORT_ASC])->all();
    }
}