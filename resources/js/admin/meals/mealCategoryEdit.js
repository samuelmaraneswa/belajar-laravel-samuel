document.addEventListener('click', (e) => {

  const container = document.querySelector('[data-page="meals-category"]');
  if (!container) return;

  const btn = e.target.closest('.meals-btn-edit');
  if (!btn) return;

  const form = document.getElementById('meals-category-form');
  if (!form) return;

  // ambil data
  const id = btn.dataset.mealsId;
  const name = btn.dataset.name;
  const description = btn.dataset.description || '';

  // set mode edit
  form.dataset.mode = 'edit';
  form.action = `/admin/meals/categories/${id}`;
  form.setAttribute('data-id', id);

  // isi field
  form.querySelector('input[name="name"]').value = name;
  form.querySelector('textarea[name="description"]').value = description;

  // ubah title
  const title = document.getElementById('meals-category-modal-title');
  if (title) title.textContent = 'Edit Meal Category';

  // buka modal
  if (typeof window.openMealsCategoryModal === 'function') {
    window.openMealsCategoryModal();
  }

});