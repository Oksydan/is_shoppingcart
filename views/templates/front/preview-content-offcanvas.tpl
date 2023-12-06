<div class="js-cart-preview-content cart-preview-content d-flex flex-column h-100 overflow-hidden">
  <div class="offcanvas-body {block name='offcanvas_body_extra_class'}{/block}">
    <div class="cart-preview-content">
      <div class="cart-loader">
        <div class="spinner-border text-primary" role="status">
          <span
            class="visually-hidden">{l s='Loading...' d='Shop.Theme.Global'}
          </span>
        </div>
      </div>

        {if $cart.products_count > 0}
          <div class="cart-preview-content__products flex-grow-1 flex-shrink-0">
              {foreach from=$cart.products item=product}
                  {include 'module:is_shoppingcart/views/templates/front/_partials/product-line.tpl' product=$product}
              {/foreach}
          </div>
        {else}
          <div class="alert alert-warning">
              {l s='Unfortunately your basket is empty' d='Modules.Isshoppingcart.Isshoppingcart'}
          </div>
        {/if}
    </div>
  </div>

  {if $cart.products_count > 0}
    <div class="offcanvas-footer border-top {block name='offcanvas_footer_extra_class'}{/block}">
        {include 'module:is_shoppingcart/views/templates/front/_partials/preview-summary.tpl' product=$product}
    </div>
  {/if}
</div>

