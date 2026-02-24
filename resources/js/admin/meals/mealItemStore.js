document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  document.addEventListener('submit', async function (e) {

    if (e.target.id !== 'meals-item-form') return;

    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    // =========================
    // VALIDASI FRONTEND
    // =========================
    const invalidIngredient = form.querySelectorAll('.meal-food-id-hidden');

    for (let input of invalidIngredient) {
      const wrapper = input.closest('.meals-ingredient-item');
      const qty = wrapper.querySelector('input[type="number"]');

      if (!input.value || !qty.value) {
        notifyError('Silakan pilih ingredient dan isi quantity.');
        return;
      }
    }

    try {

      // =========================
      // DETECT CREATE / UPDATE
      // =========================
      const isEdit = /\/\d+$/.test(form.action);

      const response = await fetch(form.action, {
        method: isEdit ? 'PUT' : 'POST',
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

      // =========================
      // UPDATE TABLE
      // =========================
      if (result.html) {
        document.getElementById('tableWrapper').innerHTML = result.html;
      }

      window.closeMealItemModal?.();
      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menyimpan data');
    }

  });

});