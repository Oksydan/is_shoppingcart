{extends file='components/offcanvas.tpl'}

{block name='offcanvas_title'}{l s='Shopping cart' d='Modules.Isshoppingcart.Front'}{/block}
{block name='offcanvas_header_extra_class'}border-bottom{/block}
{block name='offcanvas_body_extra_class'}d-flex flex-column h-100{/block}
{block name='offcanvas_extra_attribues'}id="cart_preview_offcanvas"{/block}
{block name='offcanvas_extra_class'}cart-offcanvas offcanvas-end cart-preview-offcanvas{/block}
{block name='offcanvas_content' append}
  {include 'module:is_shoppingcart/views/templates/front/preview-content-offcanvas.tpl'}
{/block}
