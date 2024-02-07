<?php

namespace frontend\dto;

class CartDTO
{
    private mixed $uuid;
    private mixed $quantity;

    public function __construct($data)
    {
        $this->uuid = $data['uuid'] ?? null;
        $this->quantity = $data['qty'] ?? null;
    }

    // You can also add getter methods if needed

    /**
     * @return mixed
     */
    public function getUuid(): mixed
    {
        return $this->uuid;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity(mixed $quantity): void
    {
        $this->quantity = $quantity;
    }

}