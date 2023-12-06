import { parseToHtml, each } from '@js/utils/DOM/DOMHelpers';
import selectorsMap from '../selectors/selectorsMap';

const {
  cartPreviewBtn,
  cartPreviewContent,
} = selectorsMap;

const updateCartPreviewHandler = (previewBtnHtmlString, previewContentHtmlString) => {
  if (previewBtnHtmlString) {
    each(cartPreviewBtn, (previewBtn) => {
      previewBtn.replaceWith(parseToHtml(previewBtnHtmlString));
    });
  }

  if (previewContentHtmlString) {
    each(cartPreviewContent, (previewContent) => {
      previewContent.replaceWith(parseToHtml(previewContentHtmlString));
    });
  }
};

export default updateCartPreviewHandler;
