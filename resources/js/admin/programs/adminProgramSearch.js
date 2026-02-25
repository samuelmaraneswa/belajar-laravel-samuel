import { initSearchSuggestions } from '../utils/searchSuggestions'
import { initSearchInputIcon } from '../utils/searchInputIcon'
import { initSearchTrigger } from '../utils/searchTrigger'

document.addEventListener('DOMContentLoaded', () => {

  if (!document.getElementById('programPage')) return

  const input = document.getElementById('searchProgram')
  if (!input) return

  const suggestions = document.getElementById('programSuggestions')
  const icon = document.getElementById('searchProgramIcon')
  const form = input.closest('form')

  initSearchInputIcon(input, icon)

  // reset jika kosong
  input.addEventListener('input', () => {
    if (!input.value.trim()) {
      window.adminProgramsState.search = ''
      window.adminProgramsState.page = 1
      window.loadAdminPrograms(1)
    }
  })

  initSearchTrigger({
    input,
    form,
    onSearch(value) {
      window.adminProgramsState.search = value
      window.adminProgramsState.page = 1
      window.loadAdminPrograms(1)
    }
  })

  initSearchSuggestions({
    input,
    suggestions,
    endpoint: `/admin/programs/suggest`,
    onSelect(value) {
      suggestions.classList.add('hidden')
      input.triggerSearch(value) // langsung kirim title saja
    }
  })

})