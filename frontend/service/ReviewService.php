<?php

namespace frontend\service;


use backend\service\ResourceService;
use common\models\Resource;
use common\models\Reviews;
use common\models\User;
use frontend\dto\ReviewDTO;
use frontend\dto\ReviewListDTO;
use frontend\dto\ReviewResponseDTO;
use frontend\dto\ReviewRequestDTO;
use frontend\repository\ReviewRepository;
use Yii;
use yii\base\Component;
use yii\db\Exception;
use yii\helpers\ArrayHelper;


class ReviewService extends Component
{
    public ResourceService $resourceService;
    public ReviewRepository $reviewRepository;


    public function __construct(
                                ResourceService $resourceService,
                                ReviewRepository $reviewRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->resourceService = $resourceService;
        $this->reviewRepository = $reviewRepository;
    }


    /**
     * @throws Exception
     */
    public function createReview(ReviewRequestDTO $reviewRequestDTO): bool
    {
        $resourceModel =  $this->getResource($reviewRequestDTO->getUuid());

        $reviewModel = new Reviews();

        $reviewModel->user_id = Yii::$app->user->id;
        $reviewModel->resource_id = $resourceModel->id;

        $reviewModel = $this->checkStatus($reviewRequestDTO, $reviewModel);

        return $reviewModel->save();

    }

    /**
     * @throws Exception
     */
    public function getReviewsList(string $uuid): ReviewResponseDTO
    {
        $resultDTO = new ReviewResponseDTO();

        $resourceModel =  $this->getResource($uuid);
        $reviewList = $this->reviewRepository->reviewsListGroupByUser($resourceModel->id);

        foreach ($reviewList as $item)
        {
            $reviewListDTO = new ReviewListDTO();

            $inlineReviews = $this->reviewRepository->getByUserId($item->user_id);

//            dd($inlineReviews);

            foreach ($inlineReviews as $review)
            {
                $dto = new ReviewDTO();

                $dto->setRating($review->rating);
                $dto->setComment($review->comment);
                $dto->setCreatedAt($review->created_at);

                $reviewListDTO->setReviewList($dto);
            }

            $reviewListDTO->setUsername($review->user->username);

            $resultDTO->setData($reviewListDTO);
        }

        return $resultDTO;
    }


    /**
     * @throws Exception
     */
    public function getResourceRating(string $uuid): float|int
    {
        $resourceModel = $this->getResource($uuid);
        $reviewsList = $this->reviewRepository->getReviewsListByRating($resourceModel->id);

        return array_sum(ArrayHelper::getColumn($reviewsList, 'rating'))/count($reviewsList);
    }


    /**
     *
     * @param ReviewRequestDTO $dto
     * @param Reviews $model
     * @return Reviews
     */

    private function checkStatus(ReviewRequestDTO $dto, Reviews $model): Reviews
    {
        if($dto->getRating() && $dto->getComment())
        {
            $model->status = Reviews::RATING_COMMENT;
            $model->rating = $dto->getRating();
            $model->comment = $dto->getComment();
        }
        else if($dto->getRating())
        {
            $model->status = Reviews::ONLY_RATING;
            $model->rating = $dto->getRating();
            $model->comment = null;
        }
        else
        {
            $model->status = Reviews::ONLY_COMMENT;
            $model->comment = $dto->getComment();
            $model->rating = 0;
        }

        return $model;
    }

    /**
     * @param string $uuid
     * @return Resource
     * @throws Exception
     */
    private function getResource(string $uuid): Resource
    {
       return $this->resourceService->getResource($uuid);
    }

    private function getUser(int $userId): array|User|null
    {
        return User::find()->andWhere(['user_id' => $userId])->one();
    }




}