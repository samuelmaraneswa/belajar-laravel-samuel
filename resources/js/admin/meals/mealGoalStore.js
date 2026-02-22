document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meal-goals"]');
  if (!container) return;

  const form = document.getElementById('meal-goal-form');
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

      const tbody = document.getElementById('meal-goal-table-body');
      document.getElementById('meal-empty-goal')?.remove();

      if (mode === 'create') {
        tbody?.insertAdjacentHTML('afterbegin', result.html);
      } else {
        const id = form.getAttribute('data-id');
        const oldRow = document.querySelector(`tr[data-goal-id="${id}"]`);
        if (oldRow) oldRow.outerHTML = result.html;
      }

      // reset form
      form.reset();
      form.dataset.mode = 'create';
      form.action = '/admin/meals/goals';
      form.removeAttribute('data-id');

      window.closeMealGoalModal?.();
      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }

  });

});