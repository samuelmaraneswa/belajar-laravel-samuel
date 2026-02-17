import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {
  if (!document.getElementById('foodPage')) return

  const input = document.getElementById('search')
  if (!input) return  

  const suggestions = document.getElementById('suggestions') 
  const icon = document.getElementById('searchIcon')
  const form = input.closest('form')

  // icon behavior (clear / search)
  initSearchInputIcon(input, icon)

  input.addEventListener('input', () => {
    if (!input.value.trim()) {
      window.foodState.search = ''
      window.loadFoods(1)
    }
  })

  // trigger search (ENTER / icon click)
  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      window.foodState.search = value
      window.loadFoods(1)   // reload page 1
    }
  })

  // suggestions
  initSearchSuggestions({
    input,
    suggestions,
    endpoint: `/admin/foods/suggest`,
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })

})
