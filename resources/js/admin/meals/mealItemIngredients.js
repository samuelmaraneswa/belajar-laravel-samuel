document.addEventListener("DOMContentLoaded", () => {

  let timer = null;

  const escapeRegex = (s) =>
    s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  const highlight = (text, q) => {
    if (!q) return text;
    return text.replace(
      new RegExp(`(${escapeRegex(q)})`, 'ig'),
      '<strong>$1</strong>'
    );
  };

  const closeSuggestions = (box, wrapper = null) => {
    box.classList.add('hidden');
    box.innerHTML = '';
    if (wrapper) wrapper.dataset.activeIndex = -1;
  };

  const toggleClearIcon = (input) => {
    let clear = input.parentElement.querySelector('.meal-clear-icon');

    if (!clear) {
      clear = document.createElement('span');
      clear.className =
        'meal-clear-icon absolute right-3 top-1/2 -translate-y-1/2 text-red-500 cursor-pointer text-sm hidden';
      clear.textContent = '✕';
      input.parentElement.appendChild(clear);
    }

    clear.classList.toggle('hidden', !input.value.trim());
  };

  // ================= CLICK =================
  document.addEventListener('click', function (e) {

    if (e.target.id === 'meals-add-ingredient-btn') {
      const list = document.getElementById('meals-ingredients-list');
      const template = document.getElementById('meals-ingredient-template');
      if (!list || !template) return;

      const index = list.querySelectorAll('.meals-ingredient-item').length;
      let html = template.innerHTML.replaceAll('__INDEX__', index);

      const wrapper = document.createElement('div');
      wrapper.innerHTML = html;
      list.appendChild(wrapper.firstElementChild);
    }

    if (e.target.classList.contains('meals-remove-ingredient')) {
      const item = e.target.closest('.meals-ingredient-item');
      if (item) item.remove();
      reindexIngredients();
    }

    // CLICK SUGGESTION (ONLY HERE hidden is set)
    if (e.target.classList.contains('meal-food-suggestion-item')) {

      const item = e.target;
      const wrapper = item.closest('.relative');

      const input = wrapper.querySelector('.meal-food-search-input');
      const hidden = wrapper.querySelector('.meal-food-id-hidden');
      const box = wrapper.querySelector('.meal-food-suggestions');

      input.value = item.dataset.name;
      hidden.value = item.dataset.id;

      toggleClearIcon(input);
      closeSuggestions(box, wrapper);
    }

    if (e.target.classList.contains('meal-clear-icon')) {

      const wrapper = e.target.closest('.relative');
      const input = wrapper.querySelector('.meal-food-search-input');
      const hidden = wrapper.querySelector('.meal-food-id-hidden');
      const box = wrapper.querySelector('.meal-food-suggestions');

      input.value = '';
      hidden.value = '';
      toggleClearIcon(input);
      closeSuggestions(box, wrapper);
      input.focus();
    }

    if (!e.target.closest('.relative')) {
      document
        .querySelectorAll('.meal-food-suggestions')
        .forEach(box => closeSuggestions(box));
    }
  });

  // ================= INPUT =================
  document.addEventListener('input', function (e) {

    if (!e.target.classList.contains('meal-food-search-input')) return;

    const input = e.target;
    const keyword = input.value.trim();
    const wrapper = input.closest('.relative');
    const box = wrapper.querySelector('.meal-food-suggestions');
    const hidden = wrapper.querySelector('.meal-food-id-hidden');

    hidden.value = ''; // reset id when typing
    toggleClearIcon(input);

    clearTimeout(timer);

    if (keyword.length < 1) {
      closeSuggestions(box, wrapper);
      return;
    }

    timer = setTimeout(async () => {

      try {

        const res = await fetch(
          `/admin/meals/foods/suggest?q=${encodeURIComponent(keyword)}`
        );

        const data = await res.json();
        wrapper.dataset.activeIndex = -1;

        if (!Array.isArray(data) || !data.length) {
          box.innerHTML = `
            <div class="px-3 py-2 text-sm text-gray-400 italic">
              Data tidak ditemukan
            </div>`;
          box.classList.remove('hidden');
          return;
        }

        box.innerHTML = data.map((item, i) => `
          <div
            class="meal-food-suggestion-item px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm"
            data-index="${i}"
            data-id="${item.id}"
            data-name="${item.name}">
            ${highlight(item.name, keyword)}
          </div>
        `).join('');

        box.style.maxHeight = '180px';
        box.style.overflowY = 'auto';
        box.classList.remove('hidden');

      } catch {
        closeSuggestions(box, wrapper);
      }

    }, 300);
  });

  // ================= ARROW NAVIGATION =================
  document.addEventListener('keydown', function (e) {

    if (!e.target.classList.contains('meal-food-search-input')) return;

    const input = e.target;
    const wrapper = input.closest('.relative');
    const box = wrapper.querySelector('.meal-food-suggestions');
    const items = box.querySelectorAll('.meal-food-suggestion-item');

    if (!items.length || box.classList.contains('hidden')) return;

    let currentIndex = parseInt(wrapper.dataset.activeIndex ?? -1);

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      currentIndex = (currentIndex + 1) % items.length;
    }

    if (e.key === 'ArrowUp') {
      e.preventDefault();
      currentIndex = (currentIndex - 1 + items.length) % items.length;
    }

    if (e.key !== 'ArrowDown' && e.key !== 'ArrowUp') return;

    wrapper.dataset.activeIndex = currentIndex;

    items.forEach((item, index) => {
      const isActive = index === currentIndex;
      item.classList.toggle('bg-gray-100', isActive);
      if (isActive) {
        item.scrollIntoView({ block: 'nearest' });
      }
    });
  });

  // ================= REINDEX =================
  function reindexIngredients() {

    const list = document.getElementById('meals-ingredients-list');
    if (!list) return;

    const items = list.querySelectorAll('.meals-ingredient-item');

    items.forEach((item, index) => {

      const hidden = item.querySelector('.meal-food-id-hidden');
      const quantity = item.querySelector('input[type="number"]');

      if (hidden)
        hidden.name = `ingredients[${index}][food_id]`;

      if (quantity)
        quantity.name = `ingredients[${index}][quantity]`;
    });
  }

});