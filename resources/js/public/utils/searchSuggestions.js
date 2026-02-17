document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('searchPublic');
  const box = document.getElementById('suggestionsPublic');
  const searchIcon = document.getElementById('searchIconPublic');
  const clearIcon = document.getElementById('clearIconPublic');

  if (!input || !box || !searchIcon || !clearIcon) return;

  const endpoint = input.dataset.suggestUrl;
  let index = -1;
  let timer = null;

  // ===== helpers =====
  const escapeRegex = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

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
    if (el) input.value = el.textContent.trim();
  };

  const highlightActive = () => {
    items().forEach((el, i) => {
      const active = i === index;
      el.classList.toggle('bg-gray-100', active);
      if (active) el.scrollIntoView({ block: 'nearest' });
    });
  };

  // ===== init =====
  toggleIcons();

  // ===== input =====
  input.addEventListener('input', () => {
    toggleIcons();
    const q = input.value.trim();
    index = -1;

    clearTimeout(timer);

    if (!q || !endpoint) {
      closeSuggestions();
      return;
    }

    timer = setTimeout(async () => {
      try {
        const currentParams = new URLSearchParams(window.location.search);
        currentParams.set('q', q);

        const res = await fetch(`${endpoint}?${currentParams.toString()}`);
        const data = await res.json();

        if (!Array.isArray(data) || !data.length) {
          box.innerHTML = `
            <div class="px-4 py-2 text-sm text-gray-500 italic">
              Data tidak ditemukan
            </div>
          `;
          box.classList.remove('hidden');
          return;
        }

        box.innerHTML = data
          .map(
            (text, i) => `
            <div class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                 data-index="${i}">
              ${highlight(text, q)}
            </div>`
          )
          .join('');

        box.classList.remove('hidden');
      } catch {
        closeSuggestions();
      }
    }, 300);
  });

  // ===== keyboard =====
  input.addEventListener('keydown', (e) => {
    if (!items().length) return;

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
      if (index >= 0) {
        e.preventDefault();
        fillFromActive();
      } 
      closeSuggestions();
      input.form.submit();
    }

    if (e.key === 'Escape') {
      box.classList.add('hidden');
      index = -1;
      input.blur(); // opsional, bisa dihapus kalau tidak mau blur
    }

    highlightActive();
  });

  // ===== click suggestion =====
  box.addEventListener('click', (e) => {
    const item = e.target.closest('[data-index]');
    if (!item) return;

    input.value = item.textContent.trim();
    toggleIcons();
    closeSuggestions();
    input.form.submit();
  });

  // ===== icons =====
  clearIcon.addEventListener('click', () => {
    input.value = '';
    toggleIcons();
    closeSuggestions();
    input.focus();
  });

  searchIcon.addEventListener('click', () => {
    input.form.submit();
  });

  // ===== click outside =====
  document.addEventListener('click', (e) => {
    if (!e.target.closest('#searchPublic') &&
        !e.target.closest('#suggestionsPublic') &&
        !e.target.closest('#searchIconPublic') &&
        !e.target.closest('#clearIconPublic')) {
      closeSuggestions();
    }
  });
});
