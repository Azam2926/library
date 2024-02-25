<?php

namespace frontend\dto;


class ReviewResponseDTO
{

    /**
     * @var ReviewListDTO[]
     */
    private array $data = [];


    /**
     * @param ReviewListDTO[] $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $item) {
            $this->setData($item);
        }
    }

    /**
     * @return ReviewDTO[]
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param ReviewListDTO $reviewListDTO
     */
    public function setData(ReviewListDTO $reviewListDTO): void
    {
        $this->data[] = $reviewListDTO;
    }

}