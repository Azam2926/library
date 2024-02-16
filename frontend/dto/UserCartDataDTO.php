<?php

namespace frontend\dto;

class UserCartDataDTO
{
    /**
     * @var CartItemResponseDTO
     */
    private mixed $cartItemResponseDTO;
    private mixed $cartId;


    public function __construct()
    {

    }

    /**
     * @param CartItemResponseDTO $cartItemResponseDTO
     */
    public function setCartItemResponseDTO(CartItemResponseDTO $cartItemResponseDTO): void
    {
        $this->cartItemResponseDTO = $cartItemResponseDTO;
    }

    /**
     * @return CartItemResponseDTO
     */
    public function getCartItemResponseDTO(): mixed
    {
        return $this->cartItemResponseDTO;
    }


    /**
     * @return mixed
     */
    public function getCartId(): mixed
    {
        return $this->cartId;
    }

    /**
     * @param mixed $cartId
     */
    public function setCartId(mixed $cartId): void
    {
        $this->cartId = $cartId;
    }




}