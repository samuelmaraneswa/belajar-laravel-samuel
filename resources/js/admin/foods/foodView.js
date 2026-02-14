document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('foodModal');
  const modalBox = document.getElementById('modalBox');
  const modalContent = document.getElementById('modalContent');
  const closeBtn = document.getElementById('closeModal');

   if (!modal || !modalBox || !modalContent) return;

  function openModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Lock scroll
    document.body.classList.add('overflow-hidden');

    setTimeout(() => {
      modalBox.classList.remove('scale-95', 'opacity-0');
      modalBox.classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  function closeModal() {
    modalBox.classList.remove('scale-100', 'opacity-100');
    modalBox.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      modalContent.innerHTML = '';
      document.body.classList.remove('overflow-hidden');
    }, 300);
  }

  // OPEN
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.view-food');
    if (!btn) return;

    const id = btn.dataset.id;

    try {
      const res = await fetch(`/admin/foods/${id}`);
      const html = await res.text();

      modalContent.innerHTML = html;
      openModal();
    } catch (err) {
      console.error(err);
    }
  });

  // CLOSE BUTTON
  closeBtn?.addEventListener('click', closeModal);

  // CLOSE OUTSIDE
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  // CLOSE ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });

});
