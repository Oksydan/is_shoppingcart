<div
  class="dropdown-menu cart-preview-dropdown cart-dropdown p-0 dropdown-menu-end"
  id="blockcart-dropdown"
  aria-labelledby="cartDropdown"
>
  <div class="p-2 border-bottom">
    <div class="row flex-nowrap align-items-center">
      <div class="col">
        <p class="h5 mb-0">
            {l s='Shopping cart' d='Modules.Isshoppingcart.Front'}
        </p>
      </div>

      <div class="col-auto">
        <a
          href="#"
          role="button"
          data-target="#cartDropdown"
          class="js-close-cart-dropdown text-decoration-none text-muted"
        >
        <span class="material-icons d-block">
          close
        </span>
        </a>
      </div>
    </div>
  </div>

  {include 'module:is_shoppingcart/views/templates/front/preview-content-dropdown.tpl'}
</div>
