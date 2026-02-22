document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-category"]');
  if (!container) return;

  const form = document.getElementById('meals-category-form');
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

      const tbody = document.getElementById('meals-category-table-body');
      document.getElementById('meals-empty-category')?.remove();

      if (mode === 'create') {
        tbody?.insertAdjacentHTML('afterbegin', result.html);
      } else {
        const id = form.getAttribute('data-id'); // ambil dulu sebelum reset
        const oldRow = document.querySelector(`tr[data-meals-id="${id}"]`);
        if (oldRow) {
          oldRow.outerHTML = result.html;
        }
      }

      // reset setelah replace
      form.reset();
      form.dataset.mode = 'create';
      form.action = '/admin/meals/categories';
      form.removeAttribute('data-id');

      window.closeMealsCategoryModal?.();
      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }
  });

});