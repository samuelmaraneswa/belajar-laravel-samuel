import { initFoodServingCalculator } from "../../utils/foodServingCalculator";

document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('foodSearch');
  const box = document.getElementById('foodSuggestions');
  const searchIcon = document.getElementById('searchFoodIcon');
  const clearIcon = document.getElementById('clearFoodIcon');
  const message = document.getElementById('foodNotFound');

  if (!input || !box || !searchIcon || !clearIcon) return;

  const endpoint = input.dataset.suggestUrl;
  let index = -1;
  let timer = null;

  // ================= HELPERS =================
  const escapeRegex = (s) =>
    s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  const highlight = (text, q) => {
    if (!q) return text;
    return text.replace(
      new RegExp(`(${escapeRegex(q)})`, 'ig'),
      '<strong>$1</strong>'
    );
  };

  const items = () => box.querySelectorAll('[data-index]');

  const toggleIcons = () => {
    const hasValue = input.value.trim().length > 0;
    clearIcon.style.display = hasValue ? 'block' : 'none';
  };

  const closeSuggestions = () => {
    box.classList.add('hidden');
    index = -1;
  };

  const fillFromActive = () => {
    const el = items()[index];
    if (el) {
      input.value = el.textContent.trim();
      input.dataset.slug = el.dataset.slug; // simpan slug
    }
  };

  const highlightActive = () => {
    items().forEach((el, i) => {
      const active = i === index;
      el.classList.toggle('bg-gray-100', active);
      if (active) el.scrollIntoView({ block: 'nearest' });
    });
  };

  // ================= FETCH DATA (SLUG MODE) =================
  async function fetchFood() {
    const slug = input.dataset.slug;

    // 🔥 Jika tidak ada slug (user tidak pilih suggestion)
    if (!slug) {
      if (message) {
        message.textContent =
          `Tidak ada data dengan nama makanan: "${input.value}"`;
        message.classList.remove('hidden');
      }
      resetTable();
      closeSuggestions();
      return;
    }

    try {
      const res = await fetch(`/foods/${slug}/data`);
      if (!res.ok) throw new Error();

      const food = await res.json();

      if (!food || !food.nutrition) {
        if (message) {
          message.textContent =
            `Tidak ada data dengan nama makanan: "${input.value}"`;
          message.classList.remove('hidden');
        }
        return;
      }

      if (message) message.classList.add('hidden');

      updateTable(food.nutrition);

      // 🔥 Set title
      document.getElementById('foodTitleSummary').textContent = food.name;
      document.getElementById('foodTitleDetail').textContent = food.name;

      // 🔥 Set default serving 100
      const servingInput = document.getElementById('servingInput');
      if (servingInput) {
        servingInput.value = 100;
      }

      initFoodServingCalculator(document);

    } catch {
      if (message) {
        message.textContent =
          `Tidak ada data dengan nama makanan: "${input.value}"`;
        message.classList.remove('hidden');
      }
    }
  }

  // ================= UPDATE TABLE =================
  function updateTable(n) {
    const set = (id, value, unit = '') => {
      const el = document.getElementById(id);
      if (!el) return;

      if (value != null) {
        el.dataset.base = value; // 🔥 simpan base 100g
        el.textContent = value + (unit ? ` ${unit}` : '');
      } else {
        el.textContent = '-';
      }
    };

    // SUMMARY
    set('summary_kal', n.calories_kcal);
    set('summary_fat', n.fat_g, 'g');
    set('summary_carb', n.carbs_g, 'g');
    set('summary_protein', n.protein_g, 'g');

    // DETAIL
    set('energy', n.calories_kcal, 'kcal');
    set('fat', n.fat_g, 'g');
    set('sat_fat', n.saturated_fat_g, 'g');
    set('poly_fat', n.polyunsaturated_fat_g, 'g');
    set('mono_fat', n.monounsaturated_fat_g, 'g');
    set('trans_fat', n.trans_fat_g, 'g');
    set('cholesterol', n.cholesterol_mg, 'mg');
    set('protein', n.protein_g, 'g');
    set('carbs', n.carbs_g, 'g');
    set('fiber', n.fiber_g, 'g');
    set('sugar', n.sugar_g, 'g');
    set('water', n.water_g, 'g');
    set('alcohol', n.alcohol_g, 'g');
    set('sodium', n.sodium_mg, 'mg');
    set('potassium', n.potassium_mg, 'mg');
    set('calcium', n.calcium_mg, 'mg');
    set('iron', n.iron_mg, 'mg');
    set('magnesium', n.magnesium_mg, 'mg');
    set('zinc', n.zinc_mg, 'mg');
    set('vit_a', n.vitamin_a_mcg, 'mcg');
    set('vit_b1', n.vitamin_b1_mg, 'mg');
    set('vit_b2', n.vitamin_b2_mg, 'mg');
    set('vit_b3', n.vitamin_b3_mg, 'mg');
    set('vit_b6', n.vitamin_b6_mg, 'mg');
    set('vit_b12', n.vitamin_b12_mcg, 'mcg');
    set('vit_c', n.vitamin_c_mg, 'mg');
    set('vit_d', n.vitamin_d_mcg, 'mcg');
    set('vit_e', n.vitamin_e_mg, 'mg');
    set('vit_k', n.vitamin_k_mcg, 'mcg');
    set('folate', n.folate_mcg, 'mcg');
  }

  function resetTable() {
    document.getElementById('foodTitleSummary').textContent = '-';
    document.getElementById('foodTitleDetail').textContent = '-';

    const servingInput = document.getElementById('servingInput');
    if (servingInput) servingInput.value = '';

    const defaults = {
      summary_kal: '-',
      summary_fat: '- g',
      summary_carb: '- g',
      summary_protein: '- g',

      energy: '- kcal',
      fat: '- g',
      sat_fat: '- g',
      poly_fat: '- g',
      mono_fat: '- g',
      trans_fat: '- g',
      cholesterol: '- mg',
      protein: '- g',
      carbs: '- g',
      fiber: '- g',
      sugar: '- g',
      water: '- g',
      alcohol: '- g',
      sodium: '- mg',
      potassium: '- mg',
      calcium: '- mg',
      iron: '- mg',
      magnesium: '- mg',
      zinc: '- mg',
      vit_a: '- mcg',
      vit_b1: '- mg',
      vit_b2: '- mg',
      vit_b3: '- mg',
      vit_b6: '- mg',
      vit_b12: '- mcg',
      vit_c: '- mg',
      vit_d: '- mcg',
      vit_e: '- mg',
      vit_k: '- mcg',
      folate: '- mcg'
    };

    Object.entries(defaults).forEach(([id, value]) => {
      const el = document.getElementById(id);
      if (el) el.textContent = value;
    });
  }

  // ================= INIT =================
  toggleIcons();

  // ================= INPUT =================
  input.addEventListener('input', () => {
    if (message) message.classList.add('hidden');
    
    toggleIcons();
    const q = input.value.trim();
    index = -1;
    input.dataset.slug = ''; // reset slug jika user ketik ulang

    clearTimeout(timer);

    if (!q || !endpoint) {
      closeSuggestions();
      return;
    }

    timer = setTimeout(async () => {
      try {
        const res = await fetch(`${endpoint}?q=${encodeURIComponent(q)}`);
        const data = await res.json();

        if (!Array.isArray(data) || !data.length) {
          box.innerHTML = `
            <div class="px-4 py-2 text-sm text-gray-500 italic">
              Data tidak ditemukan
            </div>`;
          box.classList.remove('hidden');
          return;
        }

        box.innerHTML = data
          .map(
            (item, i) => `
              <div class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                   data-index="${i}"
                   data-slug="${item.slug}">
                ${highlight(item.name, q)}
              </div>`
          )
          .join('');

        box.classList.remove('hidden');
      } catch {
        closeSuggestions();
      }
    }, 300);
  });

  // ================= KEYBOARD =================
  input.addEventListener('keydown', (e) => {
    if (!items().length && e.key !== 'Enter') return;

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      index = (index + 1) % items().length;
      fillFromActive();
    }

    if (e.key === 'ArrowUp') {
      e.preventDefault();
      index = (index - 1 + items().length) % items().length;
      fillFromActive();
    }

    if (e.key === 'Enter') {
      e.preventDefault();
      if (index >= 0) fillFromActive();
      closeSuggestions();
      fetchFood();
    }

    if (e.key === 'Escape') {
      box.classList.add('hidden');
      index = -1;
      input.blur();
    }

    highlightActive();
  });

  // ================= CLICK SUGGESTION =================
  box.addEventListener('click', (e) => {
    const item = e.target.closest('[data-index]');
    if (!item) return;

    input.value = item.textContent.trim();
    input.dataset.slug = item.dataset.slug;
    toggleIcons();
    closeSuggestions();
    fetchFood();
  });

  // ================= ICONS =================
  clearIcon.addEventListener('click', () => {
    if (message) message.classList.add('hidden');

    input.value = '';
    input.dataset.slug = '';
    toggleIcons();
    closeSuggestions();
    resetTable();
    input.focus();
  });

  searchIcon.addEventListener('click', () => {
    closeSuggestions();
    fetchFood();
  });

  // ================= CLICK OUTSIDE =================
  document.addEventListener('click', (e) => {
    if (!e.target.closest('#foodSearch') &&
        !e.target.closest('#foodSuggestions') &&
        !e.target.closest('#searchFoodIcon') &&
        !e.target.closest('#clearFoodIcon')) {
      closeSuggestions();
    }
  });

  // ================= CLICK OTHER FOODS =================
  document.querySelectorAll('.other-food-item').forEach(btn => {
    btn.addEventListener('click', async () => {

      const slug = btn.dataset.slug;
      if (!slug) return;

      try {
        const res = await fetch(`/foods/${slug}/data`);
        if (!res.ok) throw new Error();

        const food = await res.json();

        // 🔥 update input search juga
        const input = document.getElementById('foodSearch');
        input.value = food.name;
        input.dataset.slug = food.slug;
        toggleIcons();

        // 🔥 update tabel
        updateTable(food.nutrition);

        // 🔥 update title
        document.getElementById('foodTitleSummary').textContent = food.name;
        document.getElementById('foodTitleDetail').textContent = food.name;

        // 🔥 set default serving 100
        const servingInput = document.getElementById('servingInput');
        if (servingInput) servingInput.value = 100;

        // 🔥 Smooth scroll ke atas (mobile friendly)
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });

      } catch (err) {
        console.error(err);
      }

    });
  });
});
