document.addEventListener('DOMContentLoaded', () => {

  const state = {
    goal: null,
    context: null,
    gender: null,
    age: null,
    height: null,
    weight: null,
    level: null,
  };

  const steps = [
    'goal',
    'context',
    'gender',
    'age',
    'height',
    'weight',
    'level',
  ];

  let currentStepIndex = 0;
  const form = document.getElementById('wizardForm');

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

    // 🔥 AUTO FOCUS INPUT (JIKA ADA)
    setTimeout(() => {
      const input = stepEl.querySelector('.wizard-input');
      if (input) input.focus();
    }, 0);
  }

  // ============================
  // HISTORY API
  // ============================
  function pushHistory(index) {
    history.pushState(
      {
        stepIndex: index,
        state: { ...state }
      },
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
  // OPTION BUTTONS
  // ============================
  document.querySelectorAll('.wizard-option').forEach(btn => {
    btn.addEventListener('click', () => {
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

    // ENTER = NEXT
    input.addEventListener('keydown', (e) => {
      if (e.key !== 'Enter') return;

      e.preventDefault();
      e.stopPropagation();

      const stepSection = input.closest('[data-step]');
      const step = stepSection.dataset.step;

      if (!input.value) return;

      state[step] = input.value;
      goNextStep();
    });

    // CLICK CONTINUE BUTTON
    const btn = input.closest('[data-step]')?.querySelector('.wizard-next');
    if (btn) {
      btn.addEventListener('click', () => {
        if (!input.value) return;
        const step = btn.closest('[data-step]').dataset.step;
        state[step] = input.value;
        goNextStep();
      });
    }
  });

  // ============================
  // SUBMIT FINAL
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
});
