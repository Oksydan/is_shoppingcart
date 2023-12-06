import { DOMReady, each } from '@js/utils/DOM/DOMHelpers';
import { on } from '@js/utils/event/eventHandler';
import selectorsMap from './selectors/selectorsMap';
import closePreviewDropdownHandler from './handler/closePreviewDropdownHandler';
import updateCartHandler from './handler/updateCartHandler';
import updateCartPreviewHandler from './handler/updateCartPreviewHandler';
import openNotificationHandler from './handler/openNotificationHandler';

const cartPreviewController = () => {
  const {
    cartDropdownClose,
  } = selectorsMap;

  const init = () => {
    prestashop.on('updateCart', updateCartHandler);
    prestashop.on('updatedCartPreview', (res) => {
      updateCartPreviewHandler(res.previewBtn, res.previewContent);
      openNotificationHandler(res.notificationType, res.notificationContent, res.previewType);
    });

    each(cartDropdownClose, (el) => {
      on(el, 'click', closePreviewDropdownHandler);
    });
  };

  return {
    init,
  };
};

DOMReady(() => {
  const { init } = cartPreviewController();
  init();
});
