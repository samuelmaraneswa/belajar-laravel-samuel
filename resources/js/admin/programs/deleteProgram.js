document.addEventListener('click', async (e) => {

    const btn = e.target.closest('.deleteProgramBtn');
    if (!btn) return;

    const programId = btn.dataset.programId;
    if (!programId) return;

    const result = await window.notifyConfirm({
        title: 'Hapus Program?',
        text: 'Program ini akan dihapus permanen.',
        confirmText: 'Ya, Hapus',
        cancelText: 'Batal',
    });

    if (!result.isConfirmed) return;

    try {
        const response = await fetch(`/admin/programs/${programId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json',
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            btn.closest('tr').remove();
            window.notifySuccess('Program berhasil dihapus');
        } else {
            window.notifyError('Gagal menghapus program');
        }

    } catch (error) {
        console.error(error);
        window.notifyError('Terjadi kesalahan sistem');
    }

});