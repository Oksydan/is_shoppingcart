import useAlertToast from '@js/theme/components/useAlertToast';
import { parseToHtml } from '@js/utils/DOM/DOMHelpers';
import { one } from '@js/utils/event/eventHandler';
import selectorsMap from '../selectors/selectorsMap';

/**
 * Handles the display of modal notifications with the provided content.
 *
 * @function
 * @name handleModalNotification
 * @param {string} notificationContent - The content to be displayed in the modal notification.
 */
const handleModalNotification = (notificationContent) => {
  if (!notificationContent) {
    return;
  }

  const { body } = document;
  const {
    notificationModal,
  } = selectorsMap;

  body.append(parseToHtml(notificationContent));

  const modal = document.querySelector(notificationModal);

  if (!modal) {
    return;
  }

  const modalInstance = bootstrap.Modal.getOrCreateInstance(modal);

  modalInstance.show();

  one(modal, 'hidden.bs.modal', () => {
    modal.remove();
  });
};

/**
 * Handles the display of toast notifications with the provided content.
 *
 * @function
 * @name handleToastNotification
 * @param {string} notificationContent - The content to be displayed in the toast notification.
 */
const handleToastNotification = (notificationContent) => {
  if (!notificationContent) {
    return;
  }

  const {
    showToast,
  } = useAlertToast();

  showToast(notificationContent);
};

/**
 * Opens the preview dropdown element.
 *
 * @function
 * @name openPreviewDropdown
 */
const openPreviewDropdown = () => {
  const {
    cartPreviewBtn,
  } = selectorsMap;

  const dropdown = document.querySelector(cartPreviewBtn);

  if (!dropdown) {
    return;
  }

  const dropdownInstance = window.bootstrap.Dropdown.getOrCreateInstance(dropdown);
  dropdownInstance.show();
};

/**
 * Opens the preview offcanvas element.
 *
 * @function
 * @name openPreviewOffcanvas
 */
const openPreviewOffcanvas = () => {
  const {
    cartPreviewOffcanvas,
  } = selectorsMap;

  const offcanvas = document.querySelector(cartPreviewOffcanvas);

  if (!offcanvas) {
    return;
  }

  const offcanvasInstance = window.bootstrap.Offcanvas.getOrCreateInstance(offcanvas);
  offcanvasInstance.show();
};

/**
 * Handles the opening of different types of previews based on the previewType.
 *
 * @function
 * @name handleOpenPreview
 * @param {string} previewType - The type of preview to be opened ('dropdown' or 'offcanvas').
 */
const handleOpenPreview = (previewType) => {
  switch (previewType) {
    case 'dropdown':
      openPreviewDropdown();
      break;
    case 'offcanvas':
      openPreviewOffcanvas();
      break;
    default:
      break;
  }
};

/**
 * Handles the opening of different types of notifications.
 *
 * @function
 * @name openNotificationHandler
 * @param {string} notificationType - The type of notification ('modal', 'toast', or 'open_preview').
 * @param {string} notificationContent - The content to be displayed in the notification.
 * @param {string} previewType - The type of preview to be opened when notificationType is 'open_preview'.
 */
const openNotificationHandler = (notificationType, notificationContent, previewType) => {
  switch (notificationType) {
    case 'modal':
      handleModalNotification(notificationContent);
      break;
    case 'toast':
      handleToastNotification(notificationContent);
      break;
    case 'open_preview':
      handleOpenPreview(previewType);
      break;
    default:
      break;
  }
};

export default openNotificationHandler;
