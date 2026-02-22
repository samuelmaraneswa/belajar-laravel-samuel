document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  document.addEventListener('click', function (e) {

    // =========================
    // ADD STEP
    // =========================
    if (e.target.id === 'meals-add-step-btn') {

      const list = document.getElementById('meals-steps-list');
      const template = document.getElementById('meals-step-template');

      if (!list || !template) return;

      const index = list.children.length;
      let html = template.innerHTML
        .replaceAll('__INDEX__', index)
        .replaceAll('__STEP_NUMBER__', index + 1);

      const wrapper = document.createElement('div');
      wrapper.innerHTML = html;

      list.appendChild(wrapper.firstElementChild);
    }

    // =========================
    // REMOVE STEP
    // =========================
    if (e.target.classList.contains('meals-remove-step')) {

      const item = e.target.closest('.meals-step-item');
      if (item) item.remove();

      reindexSteps();
    }

  });

  // =========================
  // REINDEX AFTER DELETE
  // =========================
  function reindexSteps() {

    const list = document.getElementById('meals-steps-list');
    if (!list) return;

    const items = list.querySelectorAll('.meals-step-item');

    items.forEach((item, index) => {

      const hiddenInput = item.querySelector('input[type="hidden"]');
      const textarea = item.querySelector('textarea');

      if (hiddenInput) {
        hiddenInput.name = `steps[${index}][step_number]`;
        hiddenInput.value = index + 1;
      }

      if (textarea) {
        textarea.name = `steps[${index}][instruction]`;
      }

    });
  }

});