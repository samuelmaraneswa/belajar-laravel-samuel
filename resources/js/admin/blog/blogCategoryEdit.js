document.addEventListener('click', (e) => {

  const container = document.querySelector('[data-page="blog-category"]');
  if (!container) return;

  const btn = e.target.closest('.blog-btn-edit');
  if (!btn) return;

  const form = document.getElementById('blog-category-form');
  if (!form) return;

  // ambil data dari tombol
  const id = btn.dataset.blogId;
  const name = btn.dataset.name;
  const description = btn.dataset.description || '';
  const isActive = btn.dataset.active === '1';

  // set mode edit
  form.dataset.mode = 'edit';
  form.action = `/admin/blog/categories/${id}`;
  form.setAttribute('data-id', id);

  // isi field
  form.querySelector('input[name="name"]').value = name;
  form.querySelector('textarea[name="description"]').value = description;
  form.querySelector('input[name="is_active"]').checked = isActive;

  // ubah judul modal
  const title = document.getElementById('blog-category-modal-title');
  if (title) title.textContent = 'Edit Blog Category';

  // buka modal
  if (typeof window.openBlogCategoryModal === 'function') {
    window.openBlogCategoryModal();
  }

});