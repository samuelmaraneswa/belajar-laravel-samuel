document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('[data-page="meals-items"]');
  if (!container) return;

  const modal = document.getElementById('mealModal');
  const modalContent = document.getElementById('mealModalContent');

  document.addEventListener('click', async function (e) {

    const btn = e.target.closest('.meals-view-item');
    if (!btn) return;

    const id = btn.dataset.mealsId;
    if (!id) return;

    try {

      const response = await fetch(`/admin/meals/items/${id}`);
      const html = await response.text();

      modalContent.innerHTML = html;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      // ✅ ambil wrapper scroll setelah modal aktif
      const scrollWrapper = document.getElementById('mealModalScroll');
      if (scrollWrapper) {
        scrollWrapper.scrollTo({ top: 0, behavior: 'instant' });
      }

      requestAnimationFrame(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      });

    } catch (error) {
      notifyError('Gagal memuat data.');
    }

  });

});