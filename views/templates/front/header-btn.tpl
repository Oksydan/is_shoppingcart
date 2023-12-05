{function renderBtnContent}
  <div class="header-top__icon-container">
    <span class="header-top__icon material-icons">shopping_basket</span>
    <span class="header-top__badge {if $cart.products_count > 9}header-top__badge--smaller{/if}">
      {$cart.products_count}
    </span>
  </div>
{/function}

{if $previewType === 'dropdown'}
  <a
    href="#"
    role="button"
    id="cartDropdown"
    data-bs-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false"
    data-bs-auto-close="outside"
    class="js-cart-preview-btn header-top__link d-lg-block d-none"
  >
    {renderBtnContent}
  </a>
  <a href="{$cart_url}" class="d-flex d-lg-none header-top__link">
    {renderBtnContent}
  </a>
{elseif $previewType === 'offcanvas'}
  <a
    href="#cart_preview_offcanvas"
    role="button"
    id="cartOffcanvasBtn"
    data-bs-toggle="offcanvas"
    aria-controls="cart_preview_offcanvas"
    aria-haspopup="true"
    aria-expanded="false"
    class="js-cart-preview-btn header-top__link"
  >
    {renderBtnContent}
  </a>
{/if}
