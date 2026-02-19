import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {
  const pageWrapper = document.getElementById('articlePage')
  if (!pageWrapper) return

  const tableWrapper = document.getElementById('tableWrapper')
  const paginationBox = document.getElementById('pagination')

  if (!tableWrapper || !paginationBox) return

  window.articleState = {
    page: 1,
    search: ''
  }

  window.loadArticles = function (page = 1) {
    articleState.page = page

    const params = new URLSearchParams(articleState)

    fetch(`/admin/articles?${params}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {
        tableWrapper.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadArticles
        })
      })
  }

  // FIRST LOAD
  loadArticles(1)
})
