document.addEventListener('DOMContentLoaded', () => {

  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  const getAudioByReps = (reps) => {
    if (reps <= 8) return new Audio('/audio/beep8.mp3');
    if (reps <= 12) return new Audio('/audio/beep12.mp3');
    if (reps <= 15) return new Audio('/audio/beep15.mp3');
    return new Audio('/audio/beep20.mp3');
  };

  document.querySelectorAll('.start-btn').forEach(button => {

    button.addEventListener('click', () => {

      const reps = parseInt(button.dataset.reps);
      if (!reps) return;

      const programDayWorkoutId = button.dataset.programDayWorkoutId;
      const setNumber = button.dataset.setNumber;

      const setItem = button.closest('.set-item');
      const counter = setItem?.querySelector('.counter');
      if (!counter) return;

      const audio = getAudioByReps(reps);

      let current = 1;

      button.disabled = true;
      button.textContent = 'Running...';

      counter.classList.remove('hidden');
      counter.textContent = current;

      // 🔊 PLAY AUDIO SEKALI
      audio.currentTime = 0;
      audio.play();

      const interval = setInterval(() => {
        current++;
        counter.textContent = current;

        if (current >= reps) {
          clearInterval(interval);

          // 🔥 SAVE TO DB
          fetch('/workout-sets/complete', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
              program_day_workout_id: programDayWorkoutId,
              set_number: setNumber,
            }),
          });

          // 🔒 LOCK SET
          button.textContent = 'Completed';
          button.classList.remove('bg-gray-900');
          button.classList.add('bg-green-600');
          button.disabled = true;
        }
      }, 1800);

    });

  });

});
