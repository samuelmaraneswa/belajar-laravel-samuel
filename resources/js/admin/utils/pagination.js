export function renderPagination({ container, pagination, onPageChange }) {
  const page = Number(pagination.page)
  const last = Number(pagination.last)
  const maxButtons = 5

  if (!last || last <= 1) {
    container.innerHTML = ''
    return
  }

  let html = ''

  const half = Math.floor(maxButtons / 2)
  let start = Math.max(1, page - half)
  let end   = start + maxButtons - 1

  if (end > last) {
    end = last
    start = Math.max(1, end - maxButtons + 1)
  }

  // PREV
  html += `
    <button data-page="${page - 1}" ${page === 1 ? 'disabled' : ''}
      class="page-btn mx-1 px-3 py-1 rounded cursor-pointer
      ${page === 1 ? 'bg-gray-100 text-gray-400' : 'bg-gray-200 hover:bg-gray-300'}">
      Prev
    </button>
  `

  // LEFT DOTS
  if (start > 1) {
    html += `<span class="mx-2 text-gray-400">…</span>`
  }

  // NUMBERS
  for (let i = start; i <= end; i++) {
    html += `
      <button data-page="${i}"
        class="page-btn mx-1 px-3 py-1 rounded cursor-pointer
        ${i === page ? 'bg-indigo-600 text-white' : 'bg-gray-200 hover:bg-gray-300'}">
        ${i}
      </button>
    `
  }

  // RIGHT DOTS
  if (end < last) {
    html += `<span class="mx-2 text-gray-400">…</span>`
  }

  // NEXT
  html += `
    <button data-page="${page + 1}" ${page === last ? 'disabled' : ''}
      class="page-btn mx-1 px-3 py-1 rounded cursor-pointer
      ${page === last ? 'bg-gray-100 text-gray-400' : 'bg-gray-200 hover:bg-gray-300'}">
      Next
    </button>
  `

  container.innerHTML = html

  container.querySelectorAll('.page-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.disabled) return
      const target = Number(btn.dataset.page)
      if (target !== page && target >= 1 && target <= last) {
        onPageChange(target)
      }
    })
  })
}
