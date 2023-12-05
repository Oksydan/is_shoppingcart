<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Configuration;

class PreviewTypes
{
    public const PREVIEW_TYPE_OFFCANVAS = 'offcanvas';
    public const PREVIEW_TYPE_DROPDOWN = 'dropdown';

    public static function getTypes(): array
    {
        return [
            self::PREVIEW_TYPE_OFFCANVAS,
            self::PREVIEW_TYPE_DROPDOWN,
        ];
    }
}
