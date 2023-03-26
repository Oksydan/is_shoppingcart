<?php

use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class Is_ShoppingcartAjaxModuleFrontController extends ModuleFrontController
{
    /**
     * @var bool
     */
    public $ssl = true;

    /**
     * @see FrontController::displayAjax()
     *
     * @return void
     */
    public function displayAjax(): void
    {
        $modal = null;

        if ($this->module instanceof Is_Shoppingcart && Tools::getValue('action') === 'add-to-cart') {
            $modal = $this->renderModal(
                $this->context->cart,
                (int) Tools::getValue('id_product'),
                (int) Tools::getValue('id_product_attribute'),
                (int) Tools::getValue('id_customization')
            );
        }

        $this->ajaxRender(json_encode([
            'preview' => $this->module instanceof Is_Shoppingcart ? $this->module->hookDisplayTop(['cart' => $this->context->cart]) : '',
            'modal' => $modal,
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
