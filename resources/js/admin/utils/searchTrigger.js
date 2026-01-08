export function initSearchTrigger({ input, form, onSearch }) {
  // ENTER submit
  form.addEventListener('submit', function (e) {
    e.preventDefault()
    const value = input.value.trim()
    if (!value) return

    const suggestions = document.getElementById('suggestions')
    if (suggestions) suggestions.classList.add('hidden')

    onSearch(value)
  })

  // manual trigger (dipanggil dari suggestion)
  input.triggerSearch = function (value) {
    input.value = value
    onSearch(value)
  }
}
