{if $product}
  <div class="row align-items-center">
    {if $product.default_image}
      <div class="col-3">
        {images_block}
          <img
            class="img-fluid rounded"
            {generateImagesSources image=$product.default_image size='cart_default'}
            alt="{$product.default_image.legend}"
            title="{$product.default_image.legend}"
            width="{$product.default_image.bySize.cart_default.width}"
            height="{$product.default_image.bySize.cart_default.height}"
          >
        {/images_block}
      </div>
    {/if}

    <div class="col-9">
      <p class="h6 mb-0 font-sm">
          {l
            s='Product %s has been added to your cart.'
            d='Modules.Isshoppingcart.Front'
            sprintf=[
              $product.name
            ]
          }
      </p>
    </div>
  </div>
{/if}
