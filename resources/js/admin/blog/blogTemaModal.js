document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="blog-tema"]');
  if (!container) return;

  const modal = document.getElementById('blog-tema-modal');
  const modalContent = document.getElementById('blog-tema-modal-content');
  const openBtn = document.getElementById('btn-create-blog-tema');
  const closeBtn = document.getElementById('blog-btn-close-tema-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // OPEN
  window.openBlogTemaModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  // CLOSE
  window.closeBlogTemaModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openBlogTemaModal();
  });

  closeBtn.addEventListener('click', window.closeBlogTemaModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeBlogTemaModal();
  });

});