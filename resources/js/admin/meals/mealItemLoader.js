import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {
  const pageWrapper = document.querySelector('[data-page="meals-items"]')
  if (!pageWrapper) return

  const tableWrapper = document.getElementById('tableWrapper')
  const paginationBox = document.getElementById('pagination')

  if (!tableWrapper || !paginationBox) return

  // ===============================
  // INIT STATE FROM URL
  // ===============================
  const urlParams = new URLSearchParams(window.location.search)

  window.mealState = {
    page: parseInt(urlParams.get('page')) || 1,
    search: urlParams.get('search') || '',
    category: urlParams.get('category') || '',
    goal: urlParams.get('goal') || ''
  }

  // ===============================
  // LOAD DATA
  // ===============================
  window.loadMeals = function (page = 1) {
    mealState.page = page

    const params = new URLSearchParams()

    Object.entries(mealState).forEach(([key, value]) => {
      if (value) params.append(key, value)
    })

    fetch(`/admin/meals/items?${params.toString()}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {
        tableWrapper.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadMeals
        })
      })
  }

  // ===============================
  // FIRST LOAD (SYNC WITH URL)
  // ===============================
  loadMeals(mealState.page)
})