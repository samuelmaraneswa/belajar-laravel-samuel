export function initFoodServingCalculator(scope = document) {

  const input = scope.querySelector('#servingInput')
  const button = scope.querySelector('#calculateBtn')

  if (!input || !button) return

  const baseServing = parseFloat(input.value)

  function calculate() {

    const serving = parseFloat(input.value)
    if (!serving || serving <= 0) return

    const ratio = serving / baseServing

    scope.querySelectorAll('[data-base]').forEach(el => {

      const base = parseFloat(el.dataset.base)
      if (isNaN(base)) return

      let unit = ''
      if (el.textContent.includes('mg')) unit = ' mg'
      else if (el.textContent.includes('mcg')) unit = ' mcg'
      else if (el.textContent.includes('kcal')) unit = ' kcal'
      else unit = ' g'

      let newValue = (base * ratio).toFixed(2)

      el.textContent = newValue + unit
    })
  }

  // CLICK BUTTON
  button.addEventListener('click', calculate)

  // PRESS ENTER
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault()
      calculate()
    }
  })

}
