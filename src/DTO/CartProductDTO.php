<?php

namespace Oksydan\IsShoppingcart\DTO;

class CartProductDTO
{
    private int $id_product = 0;

    private int $id_product_attribute = 0;

    private int $id_customization = 0;

    public function __construct(
        int $id_product,
        int $id_product_attribute,
        int $id_customization
    ) {
        $this->id_product = $id_product;
        $this->id_product_attribute = $id_product_attribute;
        $this->id_customization = $id_customization;
    }

    /**
     * @return int
     */
    public function getIdProduct(): int
    {
        return $this->id_product;
    }

    /**
     * @return int
     */
    public function getIdProductAttribute(): int
    {
        return $this->id_product_attribute;
    }

    /**
     * @return int
     */
    public function getIdCustomization(): int
    {
        return $this->id_customization;
    }
}
