/**
 * Object representing selectors for various elements in the application.
 * @typedef {Object} SelectorsMap
 * @property {string} cartPreviewBtn - Selector for the cart preview button.
 * @property {string} cartPreview - Selector for the cart preview container.
 * @property {string} cartPreviewContent - Selector for the content within the cart preview.
 * @property {string} cartDropdownClose - Selector for the close button in the cart dropdown.
 * @property {string} cartPreviewOffcanvas - Selector for the offcanvas element in the cart preview.
 * @property {string} cartPreviewDropdown - Selector for the dropdown within the cart preview.
 * @property {string} notificationModal - Selector for the notification modal related to the cart.
 */

/**
 * Map of selectors used in the application for easy access and consistency.
 * @type {SelectorsMap}
 */
const selectorsMap = {
  cartPreviewBtn: '.js-cart-preview-btn',
  cartPreview: '.js-cart-preview',
  cartPreviewContent: '.js-cart-preview-content',
  cartDropdownClose: '.js-close-cart-dropdown',
  cartPreviewOffcanvas: '.js-preview-cart-offcanvas',
  cartPreviewDropdown: '.js-preview-cart-dropdown',
  notificationModal: '.js-cart-notification-modal',
};

export default selectorsMap;
