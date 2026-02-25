import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {

  const pageWrapper = document.getElementById('programPage')
  if (!pageWrapper) return

  const tableWrapper = document.getElementById('programTableWrapper')
  const paginationBox = document.getElementById('programPagination')

  if (!tableWrapper || !paginationBox) return

  // STATE KHUSUS PROGRAMS
  window.adminProgramsState = {
    page: 1,
    search: ''
  }

  window.loadAdminPrograms = function (page = 1) {

    adminProgramsState.page = page

    const params = new URLSearchParams(adminProgramsState)

    fetch(`/admin/programs?${params}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {

        tableWrapper.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadAdminPrograms
        })

      })
  }

  // FIRST LOAD
  loadAdminPrograms(1)

})