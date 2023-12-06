/**
 * Handles the event to close the preview dropdown.
 *
 * @function
 * @name closePreviewDropdownHandler
 * @param {Event} e - The event object representing the triggered event.
 */
const closePreviewDropdownHandler = (e) => {
  e.preventDefault();
  e.stopPropagation();

  /**
   * The target selector for the preview dropdown to be closed.
   * @type {string|undefined}
   */
  const target = e.delegateTarget?.dataset?.target;

  if (target) {
    /**
     * The DOM element representing the preview dropdown.
     * @type {HTMLElement|null}
     */
    const dropdown = document.querySelector(target);

    if (dropdown) {
      /**
       * The instance of the Bootstrap Dropdown associated with the preview dropdown.
       * @type {bootstrap.Dropdown}
       */
      const dropdownInstance = bootstrap.Dropdown.getOrCreateInstance(dropdown);
      dropdownInstance.hide();
    }
  }
};

export default closePreviewDropdownHandler;
