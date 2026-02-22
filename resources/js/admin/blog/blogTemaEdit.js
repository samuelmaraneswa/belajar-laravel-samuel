document.addEventListener('click', (e) => {

  const container = document.querySelector('[data-page="blog-tema"]');
  if (!container) return;

  const btn = e.target.closest('.blog-btn-edit-tema');
  if (!btn) return;

  const form = document.getElementById('blog-tema-form');
  if (!form) return;

  // ambil data
  const id = btn.dataset.temaId;
  const categoryId = btn.dataset.category;
  const name = btn.dataset.name;
  const description = btn.dataset.description || '';
  const isActive = btn.dataset.active === '1';

  // set mode edit
  form.dataset.mode = 'edit';
  form.action = `/admin/blog/tema/${id}`;
  form.setAttribute('data-id', id);

  // isi field
  form.querySelector('select[name="category_id"]').value = categoryId;
  form.querySelector('input[name="name"]').value = name;
  form.querySelector('textarea[name="description"]').value = description;
  form.querySelector('input[name="is_active"]').checked = isActive;

  // ubah title
  const title = document.getElementById('blog-tema-modal-title');
  if (title) title.textContent = 'Edit Blog Tema';

  // buka modal
  if (typeof window.openBlogTemaModal === 'function') {
    window.openBlogTemaModal();
  }

});