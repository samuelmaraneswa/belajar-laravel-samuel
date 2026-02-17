import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {
  if (!document.getElementById('foodPage')) return;

  const container = document.getElementById('tableWrapper')
  const paginationBox = document.getElementById('pagination')

  if (!container || !paginationBox) return

  window.foodState = {
    page: 1,
    search: ''
  }

  window.loadFoods = function (page = 1) { 
    foodState.page = page

    const params = new URLSearchParams(foodState)

    fetch(`/admin/foods?${params}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {

        container.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadFoods
        })

      })
  }

  // FIRST LOAD
  loadFoods(1)
})
