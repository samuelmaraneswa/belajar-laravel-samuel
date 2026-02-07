document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('category-modal');
  const modalContent = document.getElementById('category-modal-content');
  const openBtn = document.getElementById('btn-create-category');
  const closeBtn = document.getElementById('btn-close-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  window.openModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  // ⬇️ JADIKAN GLOBAL
  window.closeModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    openModal();
  });

  closeBtn.addEventListener('click', window.closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeModal();
  });
});
