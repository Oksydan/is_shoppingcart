import updatePreviewCartRequest from '../request/updatePreviewCartRequest';

/**
 * Handles the update of the shopping cart based on an event.
 *
 * @function
 * @name updateCartHandler
 * @param {Object} event - The event triggering the shopping cart update.
 * @param {Object} event.reason - The reason for the shopping cart update.
 * @param {Number} event.reason.idCustomization - The ID of the customization related to the update.
 * @param {Number} event.reason.idProductAttribute - The ID of the product attribute related to the update.
 * @param {Number} event.reason.idProduct - The ID of the product related to the update.
 * @param {string} event.reason.linkAction - The action associated with the shopping cart update.
 * @param {Object} event.resp - The response object related to the update.
 */
const updateCartHandler = (event) => {
  if (!event?.reason || !event?.resp || event?.resp?.hasError) {
    return;
  }

  /**
   * Payload for the shopping cart update request.
   * @typedef {Object} CartUpdatePayload
   * @property {Number} id_customization - The ID of the customization.
   * @property {Number} id_product_attribute - The ID of the product attribute.
   * @property {Number} id_product - The ID of the product.
   * @property {string} cart-action - The action to be performed on the shopping cart.
   */
  const payload = {
    id_customization: event.reason.idCustomization,
    id_product_attribute: event.reason.idProductAttribute,
    id_product: event.reason.idProduct,
    'cart-action': event.reason.linkAction,
  };

  // refreshCartPreviewUrl is defined as a global variable in the module
  const { getRequest } = updatePreviewCartRequest(window.refreshCartPreviewUrl, payload);

  /**
   * Executes the shopping cart update request and emits events based on the response.
   *
   * @function
   * @name getRequest
   * @memberof updateCartHandler
   * @return {Promise<Object>} A Promise that resolves with the response data.
   */
  getRequest()
    .then((resp) => {
      prestashop.emit('updatedCartPreview', resp);
    })
    .catch((resp) => {
      prestashop.emit('handleError', { eventType: 'updateShoppingCart', resp });
    });
};

export default updateCartHandler;
