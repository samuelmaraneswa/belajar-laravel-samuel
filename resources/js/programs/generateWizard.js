document.addEventListener('DOMContentLoaded', () => {

  const form = document.getElementById('wizardForm');
  if (!form) return;

  const rules = {
    age:    { min: 13, max: 70 },
    height: { min: 120, max: 220 },
    weight: { min: 30,  max: 200 },
    target_weight: { min: 30, max: 200 },
  };

  function isValid(step, value) {
    if (!rules[step]) return true;
    const { min, max } = rules[step];
    const num = Number(value);
    return num >= min && num <= max;
  }

  const state = {
    goal: null,
    context: null,
    gender: null,
    age: null,
    height: null,
    weight: null,
    target_weight: null,
    level: null,
  };

  const steps = [
    'goal',
    'context',
    'gender',
    'age',
    'height',
    'weight',
    'target_weight',
    'level',
  ];

  let currentStepIndex = 0;

  // ============================
  // RENDER STEP
  // ============================
  function showStep(index) {
    document.querySelectorAll('[data-step]').forEach(el => {
      el.classList.add('hidden');
    });

    const stepName = steps[index];
    const stepEl = document.querySelector(`[data-step="${stepName}"]`);
    if (!stepEl) return;

    stepEl.classList.remove('hidden');
    currentStepIndex = index;

    setTimeout(() => {
      const input = stepEl.querySelector('.wizard-input');
      if (input) input.focus();
    }, 0);
  }

  // ============================
  // HISTORY
  // ============================
  function pushHistory(index) {
    history.pushState(
      { stepIndex: index, state: { ...state } },
      '',
      location.pathname
    );
  }

  window.addEventListener('popstate', (e) => {
    if (!e.state) return;
    Object.assign(state, e.state.state);
    showStep(e.state.stepIndex);
  });

  function goNextStep() {
    const next = currentStepIndex + 1;
    if (next >= steps.length) return;
    pushHistory(next);
    showStep(next);
  }

  // ============================
  // OPTION BUTTONS (FIX DISABLED)
  // ============================
  document.querySelectorAll('.wizard-option').forEach(btn => {
    btn.addEventListener('click', (e) => {

      // ⛔ BLOCK TOTAL JIKA DISABLED
      if (btn.dataset.disabled === '1') {
        e.preventDefault();
        e.stopPropagation();
        return;
      }

      const step = btn.closest('[data-step]').dataset.step;
      state[step] = btn.dataset.value;

      if (step === 'level') {
        submitForm();
        return;
      }

      goNextStep();
    });
  });

  // ============================
  // INPUT (AGE / HEIGHT / WEIGHT)
  // ============================
  document.querySelectorAll('.wizard-input').forEach(input => {

    input.addEventListener('keydown', (e) => {
      if (e.key !== 'Enter') return;

      e.preventDefault();
      e.stopPropagation();

      const step = input.closest('[data-step]').dataset.step;
      if (!input.value) return;

      if (!isValid(step, input.value)) {
        alert(`Invalid ${step}.`);
        return;
      }

      state[step] = input.value;
      goNextStep();
    });

    const nextBtn = input.closest('[data-step]')?.querySelector('.wizard-next');
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        if (!input.value) return;

        const step = nextBtn.closest('[data-step]').dataset.step;
        if (!isValid(step, input.value)) {
          alert(`Invalid ${step}.`);
          return;
        }

        state[step] = input.value;
        goNextStep();
      });
    }
  });

  // ============================
  // SUBMIT
  // ============================
  function submitForm() {
    Object.keys(state).forEach(key => {
      const hidden = form.querySelector(`input[name="${key}"]`);
      if (hidden) hidden.value = state[key];
    });
    form.submit();
  }

  // ============================
  // INIT
  // ============================
  history.replaceState(
    { stepIndex: 0, state: { ...state } },
    '',
    location.pathname
  );

  showStep(0);

  const errorBox = document.getElementById('programError');
  if (errorBox) {
    setTimeout(() => {
      errorBox.style.transition = 'opacity 0.5s';
      errorBox.style.opacity = '0';
      setTimeout(() => errorBox.remove(), 500);
    }, 3000);
  }
});
