<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Configuration;

class NotificationsTypes
{
    public const NOTIFICATION_TYPE_TOAST = 'toast';

    public const NOTIFICATION_TYPE_MODAL = 'modal';

    public const NOTIFICATION_TYPE_NONE = 'none';

    public const NOTIFICATION_TYPE_OPEN_PREVIEW = 'open_preview';

    public static function getTypes(): array
    {
        return [
            self::NOTIFICATION_TYPE_TOAST,
            self::NOTIFICATION_TYPE_MODAL,
            self::NOTIFICATION_TYPE_NONE,
            self::NOTIFICATION_TYPE_OPEN_PREVIEW,
        ];
    }
}
