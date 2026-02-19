import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {
  if (!document.getElementById('articlePage')) return

  const input = document.getElementById('search')
  if (!input) return

  const suggestions = document.getElementById('suggestions')
  const icon = document.getElementById('searchIcon')
  const form = input.closest('form')

  initSearchInputIcon(input, icon)

  input.addEventListener('input', () => {
    if (!input.value.trim()) {
      window.articleState.search = ''
      window.loadArticles(1)
    }
  })

  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      window.articleState.search = value
      window.loadArticles(1)
    }
  })

  initSearchSuggestions({
    input,
    suggestions,
    endpoint: `/admin/articles/suggest`,
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })
})
