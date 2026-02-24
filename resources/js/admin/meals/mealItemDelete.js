document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  document.addEventListener('click', async function (e) {

    const btn = e.target.closest('.meals-delete-item');
    if (!btn) return;

    const id = btn.dataset.mealsId;
    if (!id) return;

    // 🔥 Confirm dulu
    const confirm = await notifyConfirm({
      title: 'Yakin ingin menghapus?',
      text: 'Data meal akan dihapus permanen.',
      confirmText: 'Ya, hapus',
      cancelText: 'Batal'
    });

    if (!confirm.isConfirmed) return;

    try {

      const response = await fetch(`/admin/meals/items/${id}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content'),
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        body: new URLSearchParams({
          _method: 'DELETE'
        })
      });

      const result = await response.json();

      if (!response.ok) {
        notifyError(result.message || 'Gagal menghapus data');
        return;
      }

      // 🔥 replace table
      if (result.html) {
        document.getElementById('tableWrapper').innerHTML = result.html;
      }

      notifySuccess(result.message);

    } catch (error) {
      console.error(error);
      notifyError('Terjadi kesalahan saat menghapus data');
    }

  });

});