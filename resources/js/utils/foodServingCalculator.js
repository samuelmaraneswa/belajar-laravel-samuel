export function initFoodServingCalculator(scope = document) {

  const input = scope.querySelector('#servingInput')
  const button = scope.querySelector('#calculateBtn')

  if (!input || !button) return

  function calculate() {

    const baseServing = parseFloat(input.dataset.base)
    if (isNaN(baseServing)) return

    const serving = parseFloat(input.value)
    if (!serving || serving <= 0) return

    const ratio = serving / baseServing

    scope.querySelectorAll('[data-base]').forEach(el => {

      const base = parseFloat(el.dataset.base)
      if (isNaN(base)) return

      const unit = el.dataset.unit || ''

      let newValue = (base * ratio).toFixed(2)

      el.textContent = newValue + (unit ? ` ${unit}` : '')
    })
  }

  // ⬇ PENTING: pasang listener tanpa cek baseServing di luar
  button.addEventListener('click', calculate)

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault()
      calculate()
    }
  })
}