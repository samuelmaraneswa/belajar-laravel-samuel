document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meal-goals"]');
  if (!container) return;

  const modal = document.getElementById('meal-goal-modal');
  const modalContent = document.getElementById('meal-goal-modal-content');
  const openBtn = document.getElementById('btn-create-meal-goal');
  const closeBtn = document.getElementById('meal-btn-close-goal-modal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // OPEN
  window.openMealGoalModal = function () {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    requestAnimationFrame(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    });
  };

  // CLOSE
  window.closeMealGoalModal = function () {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }, 200);
  };

  openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.openMealGoalModal();
  });

  closeBtn.addEventListener('click', window.closeMealGoalModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) window.closeMealGoalModal();
  });

});