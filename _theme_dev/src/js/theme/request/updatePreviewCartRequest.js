import useHttpRequest from '@js/utils/http/useHttpRequest';

const updatePreviewCartRequest = (url, payload = {}) => {
  const { request } = useHttpRequest(url);

  /**
   * Executes the request to get the preview cart.
   * @function
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
