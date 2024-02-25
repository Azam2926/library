<?php

namespace frontend\dto;


class ReviewListDTO
{
    private string $username;

    /**
     * @var ReviewDTO[]
     */
    private array $reviewList = [];


    /**
     * @param ReviewDTO[] $reviewDTOList
     */
    public function __construct(array $reviewDTOList = [])
    {
        foreach ($reviewDTOList as $reviewDTO) {
            $this->setReviewList($reviewDTO);
        }
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return ReviewDTO[]
     */
    public function getReviewList(): array
    {
        return $this->reviewList;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param ReviewDTO $reviewDTO
     */
    public function setReviewList(ReviewDTO $reviewDTO): void
    {
        $this->reviewList[] = $reviewDTO;
    }

}