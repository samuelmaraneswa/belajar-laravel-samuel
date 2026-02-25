import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {

  if (!document.getElementById('userPage')) return

  const input = document.getElementById('searchUser')
  if (!input) return

  const suggestions = document.getElementById('userSuggestions')
  const icon = document.getElementById('searchUserIcon')
  const form = input.closest('form')

  initSearchInputIcon(input, icon)

  input.addEventListener('input', () => {
    if (!input.value.trim()) {
      window.adminUsersState.search = ''
      window.loadAdminUsers(1)
    }
  })

  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      window.adminUsersState.search = value
      window.loadAdminUsers(1)
    }
  })

  initSearchSuggestions({
    input,
    suggestions,
    endpoint: `/admin/users/suggest`,
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value)
    }
  })

  input.addEventListener('input', () => {
    if (input.value.trim() === '') {
      window.adminUsersState.search = ''
      window.adminUsersState.page = 1
      window.loadAdminUsers(1)
    }
  })

})