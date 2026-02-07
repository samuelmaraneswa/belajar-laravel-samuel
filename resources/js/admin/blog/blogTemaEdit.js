document.addEventListener('click', (e) => {
  const btn = e.target.closest('.btn-edit-tema');
  if (!btn) return;

  const form = document.getElementById('tema-form');
  if (!form) return;

  // ambil data dari tombol
  const id = btn.dataset.id;
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

  // ubah judul modal
  const title = document.getElementById('tema-modal-title');
  if (title) title.textContent = 'Edit Blog Tema';

  // buka modal
  if (typeof window.openTemaModal === 'function') {
    window.openTemaModal();
  } else {
    document.getElementById('tema-modal')?.classList.remove('hidden');
    document.getElementById('tema-modal')?.classList.add('flex');
  }
});
