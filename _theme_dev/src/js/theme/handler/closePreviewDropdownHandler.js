const closePreviewDropdownHandler = (e) => {
  e.preventDefault();
  e.stopPropagation();

  const target = e.delegateTarget?.dataset?.target;

  if (target) {
    const dropdown = document.querySelector(target);

    if (dropdown) {
      bootstrap.Dropdown.getOrCreateInstance(dropdown).hide();
    }
  }
};

export default closePreviewDropdownHandler;
