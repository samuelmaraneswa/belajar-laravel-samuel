document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  const modal = document.getElementById('mealModal');
  const modalContent = document.getElementById('mealModalContent');
  const openBtn = document.getElementById('addMealBtn');
  const closeBtn = document.getElementById('closeMealModal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // =========================
  // OPEN
  // =========================
  window.openMealItemModal = async function () {

    try {
      const response = await fetch('/admin/meals/items/create');
      if (!response.ok) throw new Error('Failed load form');

      const html = await response.text();
      modalContent.innerHTML = html;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      // ✅ reset scroll setelah modal tampil
      requestAnimationFrame(() => {
        const scrollWrapper = document.getElementById('mealModalScroll');
        if (scrollWrapper) scrollWrapper.scrollTop = 0;
      });

    } catch (error) {
      console.error('Load form error:', error);
    }
  };

  // =========================
  // CLOSE
  // =========================
  window.closeMealItemModal = function () {

    modal.classList.add('hidden');
    modal.classList.remove('flex');
    modalContent.innerHTML = '';

    const scrollWrapper = document.getElementById('mealModalScroll');
    if (scrollWrapper) scrollWrapper.scrollTop = 0;
  };

  // =========================
  // EVENTS
  // =========================
  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openMealItemModal();
  });

  closeBtn.addEventListener('click', window.closeMealItemModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      window.closeMealItemModal();
    }
  });

  document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'meals-btn-cancel') {
      e.preventDefault();
      window.closeMealItemModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      window.closeMealItemModal();
    }
  });

});