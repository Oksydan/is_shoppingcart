function initShoppingCart() {
  const body = document.querySelector('body');

  function bindEvents() {
    const blockCart = document.querySelector('.js-blockcart');

    // blockCart.addEventListener('show.bs.dropdown', () => { Change to vanilla js when bootstrap 5 is adopted
    $(blockCart).on('show.bs.dropdown', () => {
      body.classList.add('header-dropdown-open', 'block-cart-open');
    });

    // blockCart.addEventListener('hide.bs.dropdown', (e) => { Change to vanilla js when bootstrap 5 is adopted
    $(blockCart).on('hide.bs.dropdown', (e) => {
      const { target } = e;
      if (!target.classList.contains('dropdown-close')
          && (target.classList.contains('keep-open') || target.closest('.keep-open')
          || (e.clickEvent && e.clickEvent.target.closest('.keep-open')))) {
        return false; // returning false should stop the dropdown from hiding.
      }
      body.classList.remove('header-dropdown-open', 'block-cart-open');
      return true;
    });
  }

  prestashop.blockcart = prestashop.blockcart || {};

  const { showModal } = prestashop.blockcart;

  bindEvents();

  prestashop.on(
    'updateCart',
    (event) => {
      const refreshURL = document.querySelector('.js-blockcart').dataset.refreshUrl;
      let requestData = {};

      if (event && event.reason && typeof event.resp !== 'undefined' && !event.resp.hasError) {
        requestData = {
          id_customization: event.reason.idCustomization,
          id_product_attribute: event.reason.idProductAttribute,
          id_product: event.reason.idProduct,
          action: event.reason.linkAction,
          ajax: 1,
        };
      }

      requestData = Object.keys(requestData).map((key) => `${encodeURIComponent(key)}=${encodeURIComponent(requestData[key])}`).join('&');

      if (event && event.resp && event.resp.hasError) {
        const errorModal = document.querySelector('#blockcart-error');
        const alertBlock = document.querySelector('.js-blockcart-alert');

        alertBlock.innerHTML = event.resp.errors.join('<br/>');
        // errorModal.modal('show'); Change to vanilla js when bootstrap 5 is adopted
        $(errorModal).modal('show');
      }

      fetch(refreshURL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: requestData,
      })
        .then((resp) => resp.json())
        .then((resp) => {
          const previewHtml = new DOMParser().parseFromString(resp.preview, 'text/html').querySelector('.js-blockcart');

          if (previewHtml) {
            document.querySelector('.js-blockcart').replaceWith(previewHtml);
          }

          if (resp.modal) {
            showModal(resp.modal);
          }

          prestashop.emit('updatedBlockCart', resp);

          if (body.classList.contains('block-cart-open')) {
            const dropdown = body.querySelector('.js-blockcart [data-toggle="dropdown"]');

            if (dropdown) {
              dropdown.click();
            }
          }

          bindEvents();

          body.classList.remove('cart-loading');
        })
        .catch((resp) => {
          prestashop.emit('handleError', { eventType: 'updateShoppingCart', resp });
        });
    },
  );
}

document.addEventListener('DOMContentLoaded', () => {
  initShoppingCart();
});
