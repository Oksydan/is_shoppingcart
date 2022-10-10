$(document).ready(function () {
  var $body = $('body');

  function bindEvents() {
    $('.blockcart.dropdown').on('show.bs.dropdown', function () {
      $body.addClass('header-dropdown-open block-cart-open');
    });

    $('.blockcart.dropdown').on('hide.bs.dropdown', function (e) {
      var $target;

      if(typeof e.clickEvent !== 'undefined') {
        $target = $(e.clickEvent.target);
      } else {
        $target = $(e.currentTarget);
      }

      if (!$target.hasClass('dropdown-close') && ($target.hasClass('keep-open') || $target.closest('.keep-open').length)) {
        return false; // returning false should stop the dropdown from hiding.
      } else {
        $body.removeClass('header-dropdown-open block-cart-open');
        return true;
      }
    });
  }

  prestashop.blockcart = prestashop.blockcart || {};

  var showModal = prestashop.blockcart.showModal || function (modal) {
    $body.append(modal);
    $body.one('click', '#blockcart-modal', function (event) {
      if (event.target.id === 'blockcart-modal') {
        $(event.target).remove();
      }
    });
  };

  bindEvents();

  prestashop.on(
    'updateCart',
    function (event) {
      var refreshURL = $('.blockcart').data('refresh-url');
      var requestData = {};
      if (event && event.reason && typeof event.resp !== 'undefined' && !event.resp.hasError) {
        requestData = {
          id_customization: event.reason.idCustomization,
          id_product_attribute: event.reason.idProductAttribute,
          id_product: event.reason.idProduct,
          action: event.reason.linkAction
        };
      }
      if (event && event.resp && event.resp.hasError) {
        var $errorModal = $('#blockcart-error');
        var $alertBlock = $('.js-blockcart-alert');

        $alertBlock.html(event.resp.errors.join('<br/>'));
        $errorModal.modal('show');
        // prestashop.emit('showErrorNextToAddtoCartButton', { errorMessage: event.resp.errors.join('<br/>')});
      }
      $.post(refreshURL, requestData).then(function (resp) {
        var html = $('<div />').append($.parseHTML(resp.preview));
        $('.blockcart').replaceWith($(resp.preview).find('.blockcart'));
        prestashop.emit('updatedBlockCart', resp);

        if($body.hasClass('block-cart-open')) {
          $('.blockcart.dropdown').find('[data-toggle="dropdown"]').trigger('click');
        }

        bindEvents();

        if (resp.modal) {
          showModal(resp.modal);
        }
        $('body').removeClass('cart-loading');
      }).fail(function (resp) {
        prestashop.emit('handleError', { eventType: 'updateShoppingCart', resp: resp });
      });
    }
  );
});
