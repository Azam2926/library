<?php

namespace frontend\dto;

class CartItemResponseDTO
{
    private array $items = [];

    public function __construct(array $cartItemInlineDTOList = [])
    {
        foreach ($cartItemInlineDTOList as $cartItemInlineDTO) {
            $this->setCartItemInlineDTO($cartItemInlineDTO);
        }
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CartItemInlineDTO $cartItemInlineDTO
     */
    public function setCartItemInlineDTO(CartItemInlineDTO $cartItemInlineDTO): void
    {
        $this->items[] = $cartItemInlineDTO;
    }


}