<?php

namespace frontend\dto;

class ReviewRequestDTO
{
    private mixed $uuid;
    private mixed $comment;
    private mixed $rating;

    public function __construct($data)
    {
        $this->uuid = $data['uuid'] ?? null;
        $this->comment = $data['comment'] ?? null;
        $this->rating = $data['rating'] ?? 0;
    }

    // You can also add getter methods if needed

    /**
     * @return mixed
     */
    public function getUuid(): mixed
    {
        return $this->uuid;
    }

    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param int|mixed $rating
     */
    public function setRating(mixed $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getRating(): mixed
    {
        return $this->rating;
    }

    /**
     * @param mixed $comment
     */
    public function setComment(mixed $comment): void
    {
        $this->comment = $comment;
    }

}