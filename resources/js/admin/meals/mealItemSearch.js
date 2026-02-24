import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {
  const pageWrapper = document.querySelector('[data-page="meals-items"]')
  if (!pageWrapper) return

  const input = document.getElementById('search')
  if (!input) return

  const suggestions = document.getElementById('suggestions')
  const icon = document.getElementById('searchIcon')
  const form = input.closest('form')

  // toggle icon clear / search
  initSearchInputIcon(input, icon)

  // trigger search (enter / icon click)
  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      window.mealState.search = value
      window.mealState.page = 1
      window.loadMeals(1)
    }
  })

  // suggestions
  initSearchSuggestions({
  input,
  suggestions,
  endpoint: () => {
    const params = new URLSearchParams(window.mealState)
    return `/admin/meals/items/suggest?${params.toString()}`
  },
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })

  input.addEventListener('input', () => {
    if (input.value.trim() === '') {
      window.mealState.search = ''
      window.mealState.page = 1
      window.loadMeals(1)
    }
  })
})