import updatePreviewCartRequest from '../request/updatePreviewCartRequest';

const updateCartHandler = (event) => {
  if (!event?.reason || !event?.resp || event?.resp?.hasError) {
    return;
  }

  const payload = {
    id_customization: event.reason.idCustomization,
    id_product_attribute: event.reason.idProductAttribute,
    id_product: event.reason.idProduct,
    'cart-action': event.reason.linkAction,
  };

  // refreshCartPreviewUrl is defined as a global variable in the module
  const { getRequest } = updatePreviewCartRequest(window.refreshCartPreviewUrl, payload);

  getRequest()
    .then((resp) => {
      prestashop.emit('updatedCartPreview', resp);
    })
    .catch((resp) => {
      prestashop.emit('handleError', { eventType: 'updateShoppingCart', resp });
    });
};

export default updateCartHandler;
