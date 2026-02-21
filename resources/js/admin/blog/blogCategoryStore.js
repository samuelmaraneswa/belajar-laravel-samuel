document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="blog-category"]');
  if (!container) return;

  const form = document.getElementById('blog-category-form');
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

      const tbody = document.getElementById('blog-category-table-body');
      document.getElementById('blog-empty-category')?.remove();

      if (mode === 'create') {
        tbody?.insertAdjacentHTML('afterbegin', result.html);
      } else {
        const id = form.getAttribute('data-id'); // ✅ ambil dulu sebelum reset
        const oldRow = document.querySelector(`tr[data-blog-id="${id}"]`);
        if (oldRow) {
          oldRow.outerHTML = result.html;
        }
      }

      // ✅ reset & close modal setelah replace/insert
      form.reset();
      form.dataset.mode = 'create';
      form.action = '/admin/blog/categories';
      form.removeAttribute('data-id');

      window.closeBlogCategoryModal?.();
      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }

  });

});