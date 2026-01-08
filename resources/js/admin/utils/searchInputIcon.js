export function initSearchInputIcon(input, icon) {
  function updateIcon() {
    if (input.value.trim()) {
      icon.classList.remove('fa-magnifying-glass', 'text-gray-400')
      icon.classList.add('fa-xmark', 'text-red-500')
    } else {
      icon.classList.remove('fa-xmark', 'text-red-500')
      icon.classList.add('fa-magnifying-glass', 'text-gray-400')
    }
  }

  input.addEventListener('input', updateIcon)

  icon.addEventListener('click', function () {
    if (!input.value) return
    input.value = ''
    input.dispatchEvent(new Event('input'))
    input.focus()
  })

  updateIcon()
}
