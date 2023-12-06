import useHttpRequest from '@js/utils/http/useHttpRequest';

/**
 * Factory function for creating an object to handle preview cart update requests.
 *
 * @function
 * @name updatePreviewCartRequest
 * @param {string} url - The URL for the preview cart update request.
 * @param {Object} payload - Optional payload data to be sent with the request.
 * @param {Number} payload.id_product - The ID of the product to update.
 * @param {Number} payload.id_product_attribute - The ID of the product attribute to update.
 * @param {Number} payload.id_customization - The ID of the customization to update.
 * @param {String} payload.cart-action - The action to perform on the cart.
 */
const updatePreviewCartRequest = (url, payload = {}) => {
  const { request } = useHttpRequest(url);

  /**
   * Executes the request to update the preview cart.
   *
   * @function
   * @name getRequest
   * @memberof updatePreviewCartRequest
   * @return {Promise<Object>} A Promise that resolves with the response data.
   */
  const getRequest = () => new Promise((resolve) => {
    request
      .query(payload)
      .post()
      .json((resp) => {
        resolve(resp);
      });
  });

  return {
    getRequest,
  };
};

export default updatePreviewCartRequest;
