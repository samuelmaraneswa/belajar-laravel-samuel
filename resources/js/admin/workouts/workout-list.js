import { renderPagination } from '../utils/pagination.js'

document.addEventListener('DOMContentLoaded', () => {
  const grid = document.getElementById('workoutGrid')
  const paginationBox = document.getElementById('pagination')

  window.workoutState = {
    page: 1,
    search: '',
    context: window.workoutContext ?? '',
    muscle: new URLSearchParams(window.location.search).get('muscle') || ''
  }

  window.loadWorkouts = function (page = 1) {
    workoutState.page = page

    const params = new URLSearchParams(workoutState)

    fetch(`/admin/workouts/ajax?${params}`)
      .then(res => res.json())
      .then(res => {
        grid.innerHTML = res.html

        renderPagination({
          container: paginationBox,
          pagination: res.pagination,
          onPageChange: loadWorkouts
        })
      })
  }

  // FIRST LOAD
  loadWorkouts(1)
})
