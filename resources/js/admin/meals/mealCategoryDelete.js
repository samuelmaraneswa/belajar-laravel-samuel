document.addEventListener('click', async (e) => {

  // ✅ Guard
  if (!document.querySelector('[data-page="meal-category"]')) return;

  const btn = e.target.closest('.btn-delete');
  if (!btn) return;

  const id = btn.dataset.id;
  if (!id) return;

  const confirm = await notifyConfirm({
    title: 'Hapus meal category?',
    text: 'Category ini akan dihapus permanen',
    confirmText: 'Hapus',
    cancelText: 'Batal',
  });

  if (!confirm.isConfirmed) return;

  try {
    const token = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute('content');

    const response = await fetch(`/admin/meals/categories/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
      },
    });

    const result = await response.json();

    if (!response.ok) {
      notifyError(result.message || 'Gagal menghapus');
      return;
    }

    document.querySelector(`tr[data-id="${id}"]`)?.remove();
    notifySuccess(result.message);

    const tbody = document.getElementById('category-table-body');

    if (tbody && tbody.children.length === 0) {
      tbody.innerHTML = `
        <tr id="empty-category">
          <td colspan="4" class="px-4 py-4 text-center text-gray-500">
            Belum ada meal category.
          </td>
        </tr>
      `;
    }

  } catch (error) {
    console.error(error);
    notifyError('Terjadi kesalahan saat menghapus data');
  }

});