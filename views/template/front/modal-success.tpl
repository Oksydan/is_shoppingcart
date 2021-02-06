{extends file='module:is_shoppingcart/views/template/front/modal-base.tpl'}

{block name='blockcart_modal_id'}id="blockcart-modal"{/block}
{block name='blockcart_modal_title'}{l s='Product Successfully Added to Your Shopping Cart' d='Shop.Theme.Checkout'}{/block}


{block name='blockcart_modal_body'}
  <div class="row">
    <div class="col-md-5 divide-right">
      <div class="row">
        <div class="col-md-6">
          <img class="product-image" src="{$product.cover.medium.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
        </div>
        <div class="col-md-6">
          <h6 class="h6 product-name">{$product.name}</h6>
          <p class="product-price">{$product.price}</p>
          {hook h='displayProductPriceBlock' product=$product type="unit_price"}
          {foreach from=$product.attributes item="property_value" key="property"}
          <span>{l s='%label%:' sprintf=['%label%' => $property] d='Shop.Theme.Global'}<strong> {$property_value}</strong></span><br>
          {/foreach}
          <span>{l s='Quantity:' d='Shop.Theme.Checkout'}&nbsp;<strong>{$product.cart_quantity}</strong></span>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="cart-content">
        {if $cart.products_count > 1}
          <p class="cart-products-count">{l s='There are %products_count% items in your cart.' sprintf=['%products_count%' => $cart.products_count] d='Shop.Theme.Checkout'}</p>
        {else}
          <p class="cart-products-count">{l s='There is %product_count% item in your cart.' sprintf=['%product_count%' =>$cart.products_count] d='Shop.Theme.Checkout'}</p>
        {/if}
        <p><span class="label">{l s='Subtotal:' d='Shop.Theme.Checkout'}</span>&nbsp;<span class="value">{$cart.subtotals.products.value}</span></p>
        <p><span>{l s='Shipping:' d='Shop.Theme.Checkout'}</span>&nbsp;<span class="value">{$cart.subtotals.shipping.value} {hook h='displayCheckoutSubtotalDetails' subtotal=$cart.subtotals.shipping}</span></p>

        {if !$configuration.display_prices_tax_incl && $configuration.taxes_enabled}
          <p><span>{$cart.totals.total.label}&nbsp;{$cart.labels.tax_short}</span>&nbsp;<span>{$cart.totals.total.value}</span></p>
          <p class="product-total"><span class="label">{$cart.totals.total_including_tax.label}</span>&nbsp;<span class="value">{$cart.totals.total_including_tax.value}</span></p>
        {else}
          <p class="product-total"><span class="label">{$cart.totals.total.label}&nbsp;{if $configuration.taxes_enabled}{$cart.labels.tax_short}{/if}</span>&nbsp;<span class="value">{$cart.totals.total.value}</span></p>
        {/if}

        {if $cart.subtotals.tax}
          <p class="product-tax">{l s='%label%:' sprintf=['%label%' => $cart.subtotals.tax.label] d='Shop.Theme.Global'}&nbsp;<span class="value">{$cart.subtotals.tax.value}</span></p>
        {/if}

      </div>
    </div>
  </div>
{/block}

{block name='blockcart_modal_footer'}
  <button type="button" class="btn btn-secondary" data-dismiss="modal">{l s='Continue shopping' d='Shop.Theme.Actions'}</button>
  <a href="{$cart_url}" class="btn btn-primary"><i class="material-icons rtl-no-flip">&#xE876;</i>{l s='Proceed to checkout' d='Shop.Theme.Actions'}</a>
{/block}
