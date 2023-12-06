import { parseToHtml, each } from '@js/utils/DOM/DOMHelpers';
import selectorsMap from '../selectors/selectorsMap';

/**
 * Updates the cart preview elements with new HTML content.
 *
 * @function
 * @name updateCartPreviewHandler
 * @param {string} previewBtnHtmlString - The HTML string to replace the cart preview button with.
 * @param {string} previewContentHtmlString - The HTML string to replace the content within the cart preview with.
 */
const updateCartPreviewHandler = (previewBtnHtmlString, previewContentHtmlString) => {
  const {
    cartPreviewBtn,
    cartPreviewContent,
  } = selectorsMap;

  /**
   * Replaces the specified cart preview elements with the provided HTML string.
   *
   * @function
   * @name replaceCartPreviewElement
   * @memberof updateCartPreviewHandler
   * @param {string} selector - The selector for the cart preview element to be replaced.
   * @param {string} htmlString - The HTML string to replace the corresponding cart preview element with.
   */
  const replaceCartPreviewElement = (selector, htmlString) => {
    each(selector, (element) => {
      element.replaceWith(parseToHtml(htmlString));
    });
  };

  if (previewBtnHtmlString) {
    replaceCartPreviewElement(cartPreviewBtn, previewBtnHtmlString);
  }

  if (previewContentHtmlString) {
    replaceCartPreviewElement(cartPreviewContent, previewContentHtmlString);
  }
};

export default updateCartPreviewHandler;
