document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("calculateForm")
  const isBodyWeight = window.workoutMeta?.type === 'bodyweight';

  if(!form) return;

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const fields = ['gender', 'age', 'weight', 'height'];
    let valid = true;

    fields.forEach(name => {
      const input = form.querySelector(`[name="${name}"]`);
      const error = document.querySelector(`[data-error="${name}"]`);

      error.classList.add('hidden');

      if(!input || input.value === ''){
        error.classList.remove('hidden');
        valid = false;
      }
    });

    if(!valid) return;

    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        const resultBox = document.getElementById('calculateResult');

        let html = `<div class="space-y-4 text-gray-700">`;

        Object.entries(data.levels).forEach(([level, data]) => {
          html += `
            <div class="border rounded p-3">
              <h4 class="font-semibold capitalize mb-1">${level}</h4>
              <ul class="text-sm space-y-1">
                <li>Sets: <b>${data.sets}</b></li>
                <li>Reps: <b>${data.reps}</b></li>
                ${data.weight !== undefined ? `<li>Weight: <b>${data.weight} kg</b></li>` : ``}
              </ul>
            </div>
          `;
        });

        html += `</div>`;

        resultBox.innerHTML = html;
      });
  });
})