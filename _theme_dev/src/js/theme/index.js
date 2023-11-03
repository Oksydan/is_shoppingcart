function initShoppingCart() {
  const bindEvents = () => {
    const blockCart = document.querySelector('.js-blockcart');

    // blockCart.addEventListener('show.bs.dropdown', () => { Change to vanilla js when bootstrap 5 is adopted
    eventHandlerOn(blockCart, 'show.bs.dropdown', () => {
      document.body.classList.add('header-dropdown-open', 'block-cart-open');
    });

    // blockCart.addEventListener('hide.bs.dropdown', (e) => { Change to vanilla js when bootstrap 5 is adopted
    eventHandlerOn(blockCart, 'hide.bs.dropdown', (e) => {
      const { target } = e;
      if (!target.classList.contains('dropdown-close')
        && (target.classList.contains('keep-open') || target.closest('.keep-open')
          || (e.clickEvent && e.clickEvent.target.closest('.keep-open')))) {
        return false; // returning false should stop the dropdown from hiding.
      }
      document.body.classList.remove('header-dropdown-open', 'block-cart-open');
      return true;
    });
  };

  const showModal = (modalHtml) => {
    const getBlockCartModalElement = () => document.querySelector('#blockcart-modal');

    const currentModal = getBlockCartModalElement();

    if (currentModal) {
      bootstrap.Modal.getOrCreateInstance(currentModal).hide();
    }

    document.body.append(parseToHtml(modalHtml));

    const newModal = getBlockCartModalElement();

    eventHandlerOn(newModal, 'hidden.bs.modal', (e) => {
      e.target.remove();
    });

    bootstrap.Modal.getOrCreateInstance(newModal).show();
  };

  bindEvents();

  const handleModalErrorToggle = (resp) => {
    const errorModal = document.querySelector('#blockcart-error');
    const alertBlock = document.querySelector('.js-blockcart-alert');

    alertBlock.innerHTML = resp.errors.join('<br/>');
    bootstrap.Modal.getOrCreateInstance(errorModal).show();
  };

  const handleUpdateCartBlock = (resp) => {
    const previewHtml = parseToHtml(resp.preview).querySelector('.js-blockcart');

    if (previewHtml) {
      document.querySelector('.js-blockcart').replaceWith(previewHtml);
    }

    if (resp.modal) {
      showModal(resp.modal);
    }

    prestashop.emit('updatedBlockCart', resp);

    if (document.body.classList.contains('block-cart-open')) {
      const dropdown = document.body.querySelector('.js-blockcart [data-toggle="dropdown"]');

      if (dropdown) {
        bootstrap.Dropdown.getOrCreateInstance(dropdown).show();
      }
    }

    bindEvents();

    document.body.classList.remove('cart-loading');
  };

  const handleUpdateCart = (event) => {
    const refreshURL = document.querySelector('.js-blockcart')?.dataset?.refreshUrl;

    if (!refreshURL) {
      return;
    }

    if (event && event.resp && event.resp.hasError) {
      handleModalErrorToggle(event.resp);
      return;
    }

    const requestData = {
      id_customization: event.reason.idCustomization,
      id_product_attribute: event.reason.idProductAttribute,
      id_product: event.reason.idProduct,
      action: event.reason.linkAction,
      ajax: 1,
    };

    const { request } = useHttpRequest(refreshURL);

    request
      .query(requestData)
      .post()
      .json(handleUpdateCartBlock)
      .error((resp) => {
        prestashop.emit('handleError', { eventType: 'updateShoppingCart', resp });
      });
  };

  prestashop.on('updateCart', handleUpdateCart);
}

DOMReady(() => {
  initShoppingCart();
});
