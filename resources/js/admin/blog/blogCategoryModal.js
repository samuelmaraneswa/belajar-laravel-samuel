document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="blog-category"]');
  if (!container) return;

  const modal = document.getElementById('blog-category-modal');
  const modalContent = document.getElementById('blog-category-modal-content');
  const openBtn = document.getElementById('btn-create-blog-category');
  const closeBtn = document.getElementById('blog-btn-close-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  window.openBlogCategoryModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  window.closeBlogCategoryModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openBlogCategoryModal();
  });

  closeBtn.addEventListener('click', window.closeBlogCategoryModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeBlogCategoryModal();
  });

});