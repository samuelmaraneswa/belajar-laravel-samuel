document.addEventListener('DOMContentLoaded', () => {

  // ==============================
  // DATA SOURCE (PRIORITY)
  // oldFormData  → validation error
  // editFormData → edit dari DB
  // ==============================
  const oldData  = window.oldFormData  || null;
  const editData = window.editFormData || null;

  // ==============================
  // CATEGORY → TEMA (DEPENDENT)
  // ==============================
  const categorySelect = document.querySelector('select[name="category_id"]');
  const temaSelect     = document.querySelector('select[name="tema_id"]');

  const loadTema = async (categoryId, selectedTemaId = null) => {
    temaSelect.innerHTML = '<option value="">-- Pilih Tema --</option>';
    if (!categoryId) return;

    try {
      const res  = await fetch(`/admin/blog/categories/${categoryId}/temas`);
      const data = await res.json();

      data.forEach(tema => {
        const option = document.createElement('option');
        option.value = tema.id;
        option.textContent = tema.name;
        if (selectedTemaId && tema.id == selectedTemaId) {
          option.selected = true;
        }
        temaSelect.appendChild(option);
      });
    } catch (e) {
      console.error('Failed to load tema', e);
    }
  };

  if (categorySelect && temaSelect) {

    // priority: old → edit
    if (oldData?.category_id) {
      categorySelect.value = oldData.category_id;
      loadTema(oldData.category_id, oldData.tema_id);

    } else if (editData?.category_id) {
      categorySelect.value = editData.category_id;
      loadTema(editData.category_id, editData.tema_id);
    }

    categorySelect.addEventListener('change', () => {
      loadTema(categorySelect.value);
    });
  }

  // ==============================
  // CALISTHENICS WORKOUT PROGRESSION
  // ==============================
  const addBtn   = document.getElementById('add-progression');
  const list     = document.getElementById('progression-list');
  const template = document.getElementById('progression-template');

  if (!addBtn || !list || !template) return;

  let index = 0;

  const addProgression = (data = {}) => {
    const html = template.innerHTML.replace(/__INDEX__/g, index);
    list.insertAdjacentHTML('beforeend', html);

    const item = list.lastElementChild;

    item.querySelector(
      `[name="progressions[${index}][id]"]`
    ).value = data.id ?? '';

    item.querySelector(`[name="progressions[${index}][name]"]`).value =
      data.progression ?? '';

    item.querySelector(`[name="progressions[${index}][sets]"]`).value =
      data.sets ?? '';

    item.querySelector(`[name="progressions[${index}][reps]"]`).value =
      data.reps ?? '';

    item.querySelector(`[name="progressions[${index}][hold_seconds]"]`).value =
      data.hold_seconds ?? '';

    item.querySelector(`[name="progressions[${index}][weight]"]`).value =
      data.weight ?? '';

    index++;
  };

  // priority: old → edit
  if (Array.isArray(oldData?.progressions) && oldData.progressions.length) {
    oldData.progressions.forEach(p => addProgression(p));

  } else if (Array.isArray(editData?.progressions)) {
    editData.progressions.forEach(p => addProgression(p));
  }

  addBtn.addEventListener('click', () => addProgression());

  list.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-progression')) {
      e.target.closest('.progression-item')?.remove();
    }
  });

});
