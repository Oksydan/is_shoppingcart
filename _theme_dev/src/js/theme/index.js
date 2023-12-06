import { DOMReady, each } from '@js/utils/DOM/DOMHelpers';
import { on } from '@js/utils/event/eventHandler';
import selectorsMap from './selectors/selectorsMap';
import closePreviewDropdownHandler from './handler/closePreviewDropdownHandler';
import updateCartHandler from './handler/updateCartHandler';
import updateCartPreviewHandler from './handler/updateCartPreviewHandler';
import openNotificationHandler from './handler/openNotificationHandler';

/**
 * Controller for managing the cart preview functionality.
 *
 * @function
 * @name cartPreviewController
 * @returns {Object} An object with an initialization function.
 */
const cartPreviewController = () => {
  const {
    cartDropdownClose,
  } = selectorsMap;

  /**
   * Initializes the cart preview controller by setting up event listeners and handlers.
   *
   * @function
   * @name init
   */
  const init = () => {
    prestashop.on('updateCart', updateCartHandler);

    /**
     * Handles the updated cart preview and triggers relevant actions.
     *
     * @function
     * @param {Object} res - The response object containing updated cart preview data.
     * @param {string} res.previewBtn - The HTML string for updating the cart preview button.
     * @param {string} res.previewContent - The HTML string for updating the cart preview content.
     * @param {string} res.notificationType - The type of notification to be displayed.
     * @param {string} res.notificationContent - The content of the notification.
     * @param {string} res.previewType - The type of preview to be opened.
     */
    prestashop.on('updatedCartPreview', (res) => {
      updateCartPreviewHandler(res.previewBtn, res.previewContent);
      openNotificationHandler(res.notificationType, res.notificationContent, res.previewType);
    });

    /**
     * Attaches click event handlers to close buttons in the cart preview dropdown.
     *
     * @function
     * @name attachCloseHandlers
     */
    const attachCloseHandlers = () => {
      each(cartDropdownClose, (el) => {
        on(el, 'click', closePreviewDropdownHandler);
      });
    };

    // Attach close handlers on initialization
    attachCloseHandlers();
  };

  return {
    init,
  };
};

DOMReady(() => {
  const { init } = cartPreviewController();
  init();
});
