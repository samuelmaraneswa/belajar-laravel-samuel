document.addEventListener('click', (e) => {

  const container = document.querySelector('[data-page="meal-goals"]');
  if (!container) return;

  const btn = e.target.closest('.meal-btn-edit-goal');
  if (!btn) return;

  const form = document.getElementById('meal-goal-form');
  if (!form) return;

  // ambil data
  const id = btn.dataset.goalId;
  const name = btn.dataset.name;
  const description = btn.dataset.description || '';

  // set mode edit
  form.dataset.mode = 'edit';
  form.action = `/admin/meals/goals/${id}`;
  form.setAttribute('data-id', id);

  // isi field
  form.querySelector('input[name="name"]').value = name;
  form.querySelector('textarea[name="description"]').value = description;

  // ubah title modal
  const title = document.getElementById('meal-goal-modal-title');
  if (title) title.textContent = 'Edit Meal Goal';

  // buka modal
  if (typeof window.openMealGoalModal === 'function') {
    window.openMealGoalModal();
  }

});