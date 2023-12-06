import useAlertToast from '@js/theme/components/useAlertToast';
import { parseToHtml } from '@js/utils/DOM/DOMHelpers';
import { one } from '@js/utils/event/eventHandler';
import selectorsMap from '../selectors/selectorsMap';

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

const handleToastNotification = (notificationContent) => {
  if (!notificationContent) {
    return;
  }

  const {
    showToast,
  } = useAlertToast();

  showToast(notificationContent);
};

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
