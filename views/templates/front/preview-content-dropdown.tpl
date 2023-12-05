<div class="js-cart-preview-content cart-preview-content cart-preview-content--dropdown d-flex flex-column flex-grow-1 flex-shrink-0">
  <div class="js-cart-loader cart-loader">
    <div class="spinner-border text-primary" role="status">
      <span
        class="visually-hidden">
          {l s='Loading...' d='Shop.Theme.Global'}
      </span>
    </div>
  </div>

  {if $cart.products_count > 0}
    <div class="cart-preview-content__products px-2 flex-grow-1 flex-shrink-0 p-0">
        {foreach from=$cart.products item=product}
            {include 'module:is_shoppingcart/views/templates/front/_partials/product-line.tpl' product=$product}
        {/foreach}
    </div>
    <div class="border-top p-2">
        {include 'module:is_shoppingcart/views/templates/front/_partials/preview-summary.tpl' product=$product}
    </div>
  {else}
    <div class="alert alert-warning">
        {l s='Unfortunately your basket is empty' d='Modules.Isshoppingcart.Isshoppingcart'}
    </div>
  {/if}
</div>


