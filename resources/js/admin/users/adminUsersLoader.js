import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {

  const pageWrapper = document.getElementById('userPage')
  if (!pageWrapper) return

  const tableWrapper = document.getElementById('userTableWrapper')
  const paginationBox = document.getElementById('userPagination')

  if (!tableWrapper || !paginationBox) return

  // STATE KHUSUS USERS
  window.adminUsersState = {
    page: 1,
    search: ''
  }

  window.loadAdminUsers = function (page = 1) {

    adminUsersState.page = page

    const params = new URLSearchParams(adminUsersState)

    fetch(`/admin/users?${params}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {
        tableWrapper.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadAdminUsers
        })
      })
  }

  // FIRST LOAD
  loadAdminUsers(1)

})