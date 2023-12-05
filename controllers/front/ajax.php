<?php

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
        xdebug_break();
        $previewContentRender = $this->get(PreviewRender::class);
        $previewBtnRender = $this->get(PreviewRender::class);

        header('Content-Type: application/json');

        $this->ajaxRender(json_encode([
            'previewContent' => $previewContentRender->render($this->context->cart),
            'previewBtn' => $previewBtnRender->render($this->context->cart),
        ]));
    }

    /**
     * @param Cart $cart
     * @param int $id_product
     * @param int $id_product_attribute
     * @param int $id_customization
     *
     * @return string
     *
     * @throws Exception
     */
    private function renderModal(Cart $cart, $id_product, $id_product_attribute, $id_customization)
    {
        $data = (new CartPresenter())->present($cart);
        $product = null;

        foreach ($data['products'] as $p) {
            if ((int) $p['id_product'] == $id_product &&
                (int) $p['id_product_attribute'] == $id_product_attribute &&
                (int) $p['id_customization'] == $id_customization) {
                $product = $p;
                break;
            }
        }

        $this->context->smarty->assign([
            'product' => $product,
            'cart' => $data,
            'cart_url' => $this->context->link->getPageLink(
                'cart',
                null,
                $this->context->language->id,
                [
                    'action' => 'show',
                ],
                false,
                null,
                true
            ),
        ]);

        return $this->module->fetch("module:{$this->module->name}/views/templates/front/modal.tpl");
    }
}
