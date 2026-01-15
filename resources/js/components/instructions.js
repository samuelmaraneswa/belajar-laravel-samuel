document.addEventListener('DOMContentLoaded', () => {
  const list = document.getElementById('instruction-list')
  const addBtn = document.getElementById('add-step')

  addBtn.addEventListener('click', () => {
    const li = document.createElement('li')
    li.className = 'flex gap-2'

    li.innerHTML = `
      <input
        type="text"
        name="instructions[]"
        class="flex-1 border rounded px-3 py-2"
        placeholder="Step"
        required
      />
      <button type="button" class="remove-step text-red-600 cursor-pointer">✕</button>
    `

    list.appendChild(li)
  })

  list.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-step')) {
      e.target.closest('li').remove()
    }
  })
})
