document.addEventListener("DOMContentLoaded", () => {

  // ✅ Guard
  if (!document.querySelector('[data-page="meal-category"]')) return;

  const form = document.getElementById('category-form');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const mode = form.dataset.mode || 'create';
    const formData = new FormData(form);

    const httpMethod = mode === 'edit' ? 'PUT' : 'POST';

    try {
      const response = await fetch(form.action, {
        method: httpMethod,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        body: formData,
      });

      const result = await response.json();

      if (!response.ok) {
        notifyError(result.message || 'Validasi gagal');
        return;
      }

      // reset & close modal
      form.reset();
      form.dataset.mode = 'create';
      form.action = '/admin/meals/categories'; // ✅ kembali ke create
      window.closeMealCategoryModal?.();
      notifySuccess(result.message);

      // hapus empty state
      document.getElementById('empty-category')?.remove();

      const tbody = document.getElementById('category-table-body');

      if (mode === 'create') {
        // INSERT ROW
        tbody?.insertAdjacentHTML('afterbegin', result.html);
      } else {
        // REPLACE ROW
        const id = form.getAttribute('data-id');
        const oldRow = document.querySelector(`tr[data-id="${id}"]`);
        if (oldRow) {
          oldRow.outerHTML = result.html;
        }
      }

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }
  });

});