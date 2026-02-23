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

      requestAnimationFrame(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      });

    } catch (error) {
      console.error('Load form error:', error);
    }
  };

  // =========================
  // CLOSE
  // =========================
  window.closeMealItemModal = function () {

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      modalContent.innerHTML = '';
    }, 200);
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

});