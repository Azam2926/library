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

    public function getReviewsListByRating($resource_id): array
    {
        return Reviews::find()->findByResourceId($resource_id)->getByRating()->all();
    }
}