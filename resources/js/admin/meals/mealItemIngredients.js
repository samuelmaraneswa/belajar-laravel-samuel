document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  document.addEventListener('click', function (e) {

    // =========================
    // ADD INGREDIENT
    // =========================
    if (e.target.id === 'meals-add-ingredient-btn') {

      const list = document.getElementById('meals-ingredients-list');
      const template = document.getElementById('meals-ingredient-template');

      if (!list || !template) return;

      const index = list.children.length;
      let html = template.innerHTML.replaceAll('__INDEX__', index);

      const wrapper = document.createElement('div');
      wrapper.innerHTML = html;

      list.appendChild(wrapper.firstElementChild);
    }

    // =========================
    // REMOVE INGREDIENT
    // =========================
    if (e.target.classList.contains('meals-remove-ingredient')) {

      const item = e.target.closest('.meals-ingredient-item');
      if (item) item.remove();

      reindexIngredients();
    }

  });

  // =========================
  // REINDEX AFTER DELETE
  // =========================
  function reindexIngredients() {

    const list = document.getElementById('meals-ingredients-list');
    if (!list) return;

    const items = list.querySelectorAll('.meals-ingredient-item');

    items.forEach((item, index) => {

      const select = item.querySelector('select');
      const input = item.querySelector('input[type="number"]');

      if (select)
        select.name = `ingredients[${index}][food_id]`;

      if (input)
        input.name = `ingredients[${index}][quantity]`;

    });
  }

});