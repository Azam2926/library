<?php

namespace frontend\dto;

class CartItemResponseDTO
{
    /**
     * @var CartItemInlineDTO[]
     */
    private array $items = [];

    /**
     * @param CartItemInlineDTO[] $cartItemInlineDTOList
     */
    public function __construct(array $cartItemInlineDTOList = [])
    {
        foreach ($cartItemInlineDTOList as $cartItemInlineDTO) {
            $this->setCartItemInlineDTO($cartItemInlineDTO);
        }
    }

    /**
     * @param CartItemInlineDTO $cartItemInlineDTO
     */
    public function setCartItemInlineDTO(CartItemInlineDTO $cartItemInlineDTO): void
    {
        $this->items[] = $cartItemInlineDTO;
    }

    /**
     * @return CartItemInlineDTO[]
     */
    public function getItems(): array
    {
        return $this->items;
    }


}