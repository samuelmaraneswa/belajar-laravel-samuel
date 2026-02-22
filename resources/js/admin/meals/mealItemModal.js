document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  const modal = document.getElementById('mealModal');
  const modalContent = document.getElementById('mealModalContent');
  const openBtn = document.getElementById('addMealBtn');
  const closeBtn = document.getElementById('closeMealModal');

  if (!modal || !modalContent || !openBtn || !closeBtn) return;

  // OPEN (load form first, then show modal)
  openBtn.addEventListener('click', async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('/admin/meals/items/create');
      const html = await response.text();

      modalContent.innerHTML = html;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      requestAnimationFrame(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      });

    } catch (error) {
      console.error('Gagal load form:', error);
    }
  });

  // CLOSE
  function closeModal() {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      modalContent.innerHTML = '';
    }, 200);
  }

  closeBtn.addEventListener('click', closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

});