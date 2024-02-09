<?php

namespace frontend\dto;

class CartItemInlineDTO
{
    private mixed $url;
    private mixed $name;
    private mixed $price;
    private mixed $quantity;


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUrl(): mixed
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getPrice(): mixed
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getQuantity(): mixed
    {
        return $this->quantity;
    }

    /**
     * @param mixed $name
     */
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity(mixed $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(mixed $price): void
    {
        $this->price = $price;
    }

    /**
     * @param mixed $url
     */
    public function setUrl(mixed $url): void
    {
        $this->url = $url;
    }

}