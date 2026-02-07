document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('tema-modal');
  const modalContent = document.getElementById('tema-modal-content');
  const openBtn = document.getElementById('btn-create-tema');
  const closeBtn = document.getElementById('btn-close-tema-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // OPEN (GLOBAL)
  window.openTemaModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  // CLOSE (GLOBAL)
  window.closeTemaModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openTemaModal();
  });

  closeBtn.addEventListener('click', window.closeTemaModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeTemaModal();
  });
});
