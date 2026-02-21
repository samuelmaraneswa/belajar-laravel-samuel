document.addEventListener('click', (e) => {

  // ✅ Guard: hanya untuk meal category page
  if (!document.querySelector('[data-page="meal-category"]')) return;

  const btn = e.target.closest('.btn-edit');
  if (!btn) return;

  const form = document.getElementById('category-form');
  if (!form) return;

  // ambil data dari tombol
  const id = btn.dataset.id;
  const name = btn.dataset.name;
  const description = btn.dataset.description || '';

  // set mode edit
  form.dataset.mode = 'edit';
  form.action = `/admin/meals/categories/${id}`;
  form.setAttribute('data-id', id);

  // isi field
  form.querySelector('input[name="name"]').value = name;
  form.querySelector('textarea[name="description"]').value = description;

  // ubah judul modal
  const title = document.getElementById('category-modal-title');
  if (title) title.textContent = 'Edit Meal Category';

  // buka modal
  if (typeof window.openMealCategoryModal === 'function') {
    window.openMealCategoryModal();
  } else {
    const modal = document.getElementById('category-modal');
    modal?.classList.remove('hidden');
    modal?.classList.add('flex');
  }

});