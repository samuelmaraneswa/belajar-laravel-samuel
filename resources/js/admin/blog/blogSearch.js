import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {
  if (!document.getElementById('blogPage')) return
  
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
      window.blogState.search = value
      window.loadPosts(1)
    }
  })

  initSearchSuggestions({
    input,
    suggestions,
    endpoint: `/admin/blog/posts/suggest`,
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })
})
