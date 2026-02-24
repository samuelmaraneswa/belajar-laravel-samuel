function escapeRegex(str) {
  return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
}

function highlightText(text, keyword) {
  if (!keyword) return text

  const escaped = escapeRegex(keyword)
  const regex = new RegExp(`(${escaped})`, 'gi')

  return text.replace(regex, '<strong>$1</strong>')
}

export function initSearchSuggestions({
  input,
  suggestions,
  endpoint,
  onSelect
}) {
  let controller = null
  let activeIndex = -1
  let isNavigating = false

  function setActive(items) {
    items.forEach((el, i) => {
      el.classList.toggle('bg-gray-100', i === activeIndex)
    })

    if (activeIndex >= 0) {
      items[activeIndex].scrollIntoView({
        block: 'nearest',
      })
    }
  }

  input.addEventListener('input', async function () {
    if (isNavigating) return   // 🔒 cegah fetch saat arrow nav

    const q = input.value.trim()
    activeIndex = -1

    if (!q) {
      suggestions.innerHTML = ''
      suggestions.classList.add('hidden')
      return
    }

    if (controller) controller.abort()
    controller = new AbortController()

    try{
      const baseUrl = typeof endpoint === 'function'
      ? endpoint()
      : endpoint

    const url = baseUrl.includes('?')
      ? `${baseUrl}&q=${encodeURIComponent(q)}`
      : `${baseUrl}?q=${encodeURIComponent(q)}`

      const res = await fetch(url, {
        signal: controller.signal
      })

      const data = await res.json()

      suggestions.innerHTML = data.length
        ? data.map(item =>
            `<li class="list-none px-4 py-2 cursor-pointer hover:bg-gray-100 whitespace-nowrap"
                data-value="${item}">
              ${highlightText(item, q)}
            </li>`
          ).join('')
        : `<li class="list-none px-4 py-2 text-gray-400">Data tidak ada</li>`

      suggestions.classList.remove('hidden')

      Array.from(suggestions.children).forEach((li, i) => {
        li.addEventListener('click', () => onSelect(li.dataset.value))
      })
    }catch(err){
      if (err.name !== 'AbortError') {
        console.error(err)
      }
    }
  })

  input.addEventListener('keydown', function (e) {
    const items = Array.from(suggestions.children)
    if (!items.length || suggestions.classList.contains('hidden')) return

    if (e.key === 'ArrowDown') {
      e.preventDefault()
      isNavigating = true
      activeIndex = (activeIndex + 1) % items.length
    }

    if (e.key === 'ArrowUp') {
      e.preventDefault()
      isNavigating = true
      activeIndex = (activeIndex - 1 + items.length) % items.length
    }

    if (activeIndex >= 0 && (e.key === 'ArrowDown' || e.key === 'ArrowUp')) {
      input.value = items[activeIndex].dataset.value
      setActive(items)
      setTimeout(() => (isNavigating = false), 0)
    }

    if (e.key === 'Enter' && activeIndex >= 0) {
      e.preventDefault()
      onSelect(items[activeIndex].dataset.value)
    }

    if (e.key === 'Escape') {
      suggestions.classList.add('hidden')
      suggestions.innerHTML = ''
      activeIndex = -1
      return
    }
  })

  document.addEventListener('click', function (e) {
  if (
    !suggestions.contains(e.target) &&
    !input.contains(e.target)
  ) {
    suggestions.classList.add('hidden')
    activeIndex = -1
  }
})
}
