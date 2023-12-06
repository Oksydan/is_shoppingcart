<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\View;

use Oksydan\IsShoppingcart\Configuration\NotificationsTypes;
use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;

class NotificationRender implements PreviewRenderInterface
{
    private const TEMPLATE_NOTIFICATION_MODAL = 'modal.tpl';
    private const TEMPLATE_NOTIFICATION_TOAST = 'toast.tpl';

    private \Context $context;

    private \Is_shoppingcart $module;

    private ShoppingCartConfiguration $shoppingCartConfiguration;

    public function __construct(
        \Context $context,
        \Is_shoppingcart $module,
        ShoppingCartConfiguration $shoppingCartConfiguration
    ) {
        $this->context = $context;
        $this->module = $module;
        $this->shoppingCartConfiguration = $shoppingCartConfiguration;
    }

    public function render(): string
    {
        if (in_array($this->shoppingCartConfiguration->getCartNotificationType(), [
            NotificationsTypes::NOTIFICATION_TYPE_NONE,
            NotificationsTypes::NOTIFICATION_TYPE_OPEN_PREVIEW,
        ])) {
            return '';
        }

        return $this->context->smarty->fetch(
            "module:{$this->module->name}/views/templates/front/notification/{$this->getTemplate()}"
        );
    }

    private function getTemplate(): string
    {
        switch ($this->shoppingCartConfiguration->getCartNotificationType()) {
            case NotificationsTypes::NOTIFICATION_TYPE_MODAL:
                return self::TEMPLATE_NOTIFICATION_MODAL;
            case NotificationsTypes::NOTIFICATION_TYPE_TOAST:
                return self::TEMPLATE_NOTIFICATION_TOAST;
            default:
                throw new \Exception('Unknown preview type');
        }
    }
}
