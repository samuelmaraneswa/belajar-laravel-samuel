import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('search')
  if (!input) return  

  const suggestions = document.getElementById('suggestions')
  const icon = document.getElementById('searchIcon')
  const form = input.closest('form')

  initSearchInputIcon(input, icon)

  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      fetch(`/admin/workouts/search?search=${encodeURIComponent(value)}`)
        .then(res => res.text())
        .then(html => {
          document.getElementById('workoutGrid').innerHTML = html
        })
    }
  })

  initSearchSuggestions({
    input,
    suggestions,
    endpoint: '/admin/workouts/suggest',
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })
})
