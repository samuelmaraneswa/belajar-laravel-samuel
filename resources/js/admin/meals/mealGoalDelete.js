document.addEventListener('click', async (e) => {

  const container = document.querySelector('[data-page="meal-goals"]');
  if (!container) return;

  const btn = e.target.closest('.meal-btn-delete-goal');
  if (!btn) return;

  const id = btn.dataset.goalId;
  if (!id) return;

  const confirm = await notifyConfirm({
    title: 'Hapus goal?',
    text: 'Goal ini akan dihapus permanen',
    confirmText: 'Hapus',
    cancelText: 'Batal',
  });

  if (!confirm.isConfirmed) return;

  try {
    const token = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute('content');

    const response = await fetch(`/admin/meals/goals/${id}`, {
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

    // hapus row
    document.querySelector(`tr[data-goal-id="${id}"]`)?.remove();
    notifySuccess(result.message);

    // empty state
    const tbody = document.getElementById('meal-goal-table-body');
    if (tbody && tbody.children.length === 0) {
      tbody.innerHTML = `
        <tr id="meal-empty-goal">
          <td colspan="3" class="px-4 py-4 text-center text-gray-500">
            Belum ada meal goal.
          </td>
        </tr>
      `;
    }

  } catch (error) {
    console.error(error);
    notifyError('Terjadi kesalahan saat menghapus data');
  }

});