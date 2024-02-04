<?php

namespace frontend\dto;

class CartDTO
{
    private mixed $resource_id;
    private mixed $quantity;

    public function __construct($data)
    {
        $this->resource_id = $data['resource_id'] ?? null;
        $this->quantity = $data['qty'] ?? null;
    }

    // You can also add getter methods if needed
    public function getResourceId()
    {
        return $this->resource_id;
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