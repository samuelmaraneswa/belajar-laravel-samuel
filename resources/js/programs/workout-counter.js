document.addEventListener('DOMContentLoaded', () => {

  const audio = new Audio('/audio/beep.mp3');

  document.querySelectorAll('.start-btn').forEach(button => {

    button.addEventListener('click', () => {

      const reps = parseInt(button.dataset.reps);
      if (!reps) return;

      const setItem = button.closest('.set-item');
      const counter = setItem?.querySelector('.counter');

      if (!counter) return;

      let current = 1;

      button.disabled = true;
      button.textContent = 'Running...';

      counter.classList.remove('hidden');
      counter.textContent = '1';

      // 🔊 PLAY AUDIO SEKALI
      audio.currentTime = 1;
      audio.play();

      const interval = setInterval(() => {
        current++;
        counter.textContent = current;

        if (current >= reps) {
          clearInterval(interval);

          button.textContent = 'Finish';
          button.disabled = false;
          button.classList.add('bg-green-600');
        }
      }, 1800);

    });

  });

});
