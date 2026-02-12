import { renderPagination } from '../utils/pagination'

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('postsContainer')
  const paginationBox = document.getElementById('pagination')

  if (!container || !paginationBox) return

  window.blogState = {
    page: 1,
    search: '',
    category: new URLSearchParams(window.location.search).get('category') || ''
  }

  window.loadPosts = function (page = 1) {
    blogState.page = page

    const params = new URLSearchParams(blogState)

    fetch(`/admin/blog/posts?${params}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(res => {
        container.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadPosts
        })
      })
  }

  // FIRST LOAD
  loadPosts(1)
})
