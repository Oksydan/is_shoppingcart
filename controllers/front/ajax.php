<?php

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use Oksydan\IsShoppingcart\DTO\CartProductDTO;
use Oksydan\IsShoppingcart\Persister\TemplateVarsPersister;
use Oksydan\IsShoppingcart\View\NotificationRender;
use Oksydan\IsShoppingcart\View\PreviewBtnRender;
use Oksydan\IsShoppingcart\View\PreviewRender;
use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class Is_shoppingcartAjaxModuleFrontController extends ModuleFrontController
{
    /**
     * @see FrontController::displayAjaxGetCartPreview()
     *
     * @return void
     */
    public function displayAjaxGetCartPreview(): void
    {
        $previewContentRender = $this->get(PreviewRender::class);
        $previewBtnRender = $this->get(PreviewBtnRender::class);
        $notificationRender = $this->get(NotificationRender::class);
        $moduleConfiguration = $this->get(ShoppingCartConfiguration::class);
        $templateVarsPersister = $this->get(TemplateVarsPersister::class);

        if (Tools::getValue('cart-action') === 'add-to-cart') {
            $cartProductDTO = new CartProductDTO(
                (int) Tools::getValue('id_product'),
                (int) Tools::getValue('id_product_attribute'),
                (int) Tools::getValue('id_customization')
            );
        } else {
            $cartProductDTO = new CartProductDTO(
                0,
                0,
                0
            );
        }

        $templateVarsPersister->persist($cartProductDTO);

        ob_end_clean();
        header('Content-Type: application/json');

        $this->ajaxRender(json_encode([
            'previewContent' => $previewContentRender->render(),
            'previewBtn' => $previewBtnRender->render(),
            'previewType' => $moduleConfiguration->getCartPreviewType(),
            'notificationType' => $moduleConfiguration->getCartNotificationType(),
            'notificationContent' => $notificationRender->render(),
        ]));
    }
}
