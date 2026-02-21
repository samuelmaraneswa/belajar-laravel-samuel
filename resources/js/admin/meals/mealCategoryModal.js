document.addEventListener("DOMContentLoaded", () => {

  // ✅ Guard: hanya jalan di halaman meal category
  if (!document.querySelector('[data-page="meal-category"]')) return;

  const modal = document.getElementById('category-modal');
  const modalContent = document.getElementById('category-modal-content');
  const openBtn = document.getElementById('btn-create-category');
  const closeBtn = document.getElementById('btn-close-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // ===== OPEN MODAL =====
  window.openMealCategoryModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  // ===== CLOSE MODAL =====
  window.closeMealCategoryModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  // ===== EVENT LISTENERS =====
  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openMealCategoryModal();
  });

  closeBtn.addEventListener('click', window.closeMealCategoryModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeMealCategoryModal();
  });

});