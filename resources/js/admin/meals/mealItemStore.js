document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  document.addEventListener('submit', async function (e) {

    if (e.target.id !== 'meals-item-form') return;

    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    if (form.action.match(/\/\d+$/)) {
      formData.append('_method', 'PUT');
    }

    try {

      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        body: formData
      });

      const result = await response.json();

      if (!response.ok) {
        notifyError(result.message || 'Validasi gagal');
        return;
      }

      // 🔥 replace full table dari response
      if (result.html) {
        document.getElementById('tableWrapper').innerHTML = result.html;
      }

      form.reset();

      window.closeMealItemModal?.();
      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }

  });

});