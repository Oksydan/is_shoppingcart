import selectorsMap from './selectors/selectorsMap';
import closePreviewDropdownHandler from './handler/closePreviewDropdownHandler';
import updateCartHandler from "./handler/updateCartHandler";

const cartPreviewController = () => {
  const {
    cartPreviewBtn,
    cartPreview,
    cartPreviewContent,
    cartDropdownClose
  } = selectorsMap;

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

  const handleUpdateCartBlock = (resp) => {
    const previewHtml = parseToHtml(resp.preview).querySelector('.js-cart-preview');

    if (previewHtml) {
      document.querySelector('.js-cart-preview').replaceWith(previewHtml);
    }

    if (resp.modal) {
      showModal(resp.modal);
    }

    prestashop.emit('updatedBlockCart', resp);

    if (document.body.classList.contains('block-cart-open')) {
      const dropdown = document.body.querySelector('.js-cart-preview [data-toggle="dropdown"]');

      if (dropdown) {
        bootstrap.Dropdown.getOrCreateInstance(dropdown).show();
      }
    }
  };

  const handleUpdateCart = (event) => {
    const refreshURL = document.querySelector('.js-cart-preview')?.dataset?.refreshUrl;

    if (!refreshURL) {
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

  const init = () => {
    prestashop.on('updateCart', updateCartHandler);

    each(cartDropdownClose, (el) => {
      eventHandlerOn(el, 'click', closePreviewDropdownHandler);
    });
  }

  return {
    init
  }
}

DOMReady(() => {
  const { init } = cartPreviewController();
  init();
});
