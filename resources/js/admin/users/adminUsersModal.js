document.addEventListener('DOMContentLoaded', () => {

  const userPage = document.getElementById('userPage')
  if (!userPage) return

  const userModal = document.getElementById('userModal')
  const userModalContent = document.getElementById('userModalContent')
  const closeUserModalBtn = document.getElementById('closeUserModal')
  const addUserBtn = document.getElementById('addUserBtn')

  /* =======================================================
     🎨 OPEN / CLOSE MODAL
  ======================================================= */

  function openUserModal() {
    userModal.classList.remove('hidden')
    userModal.classList.add('flex')

    const scrollArea = userModal.querySelector('.overflow-y-auto')
    if (scrollArea) scrollArea.scrollTop = 0

    document.body.classList.add('overflow-hidden')

    userModal.style.opacity = 0
    userModal.style.transition = 'opacity 200ms ease'

    requestAnimationFrame(() => {
      userModal.style.opacity = 1
    })
  }

  function closeUserModal() {
    userModal.style.opacity = 0

    setTimeout(() => {
      userModal.classList.add('hidden')
      userModal.classList.remove('flex')
      userModalContent.innerHTML = ''
      document.body.classList.remove('overflow-hidden')
    }, 200)
  }

  /* =======================================================
     🔄 REFRESH TABLE (FIXED - STABLE)
  ======================================================= */

  async function refreshUserTable() {

    const res = await fetch('/admin/users', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })

    const data = await res.json()

    document.getElementById('userTableWrapper').innerHTML = data.html
  }

  /* =======================================================
     ➕ CREATE
  ======================================================= */

  addUserBtn?.addEventListener('click', async () => {
    const res = await fetch('/admin/users/create')
    userModalContent.innerHTML = await res.text()
    openUserModal()
  })

  /* =======================================================
     ✏️ EDIT
  ======================================================= */

  document.addEventListener('click', async (e) => {
    const button = e.target.closest('.edit-user')
    if (!button) return

    const id = button.dataset.id
    const res = await fetch(`/admin/users/${id}/edit`)
    userModalContent.innerHTML = await res.text()
    openUserModal()
  })

  /* =======================================================
     👁 VIEW
  ======================================================= */

  document.addEventListener('click', async (e) => {
    const button = e.target.closest('.view-user')
    if (!button) return

    const id = button.dataset.id
    const res = await fetch(`/admin/users/${id}`)
    userModalContent.innerHTML = await res.text()
    openUserModal()
  })

  /* =======================================================
     💾 SUBMIT (CREATE + UPDATE)
  ======================================================= */

  userModalContent.addEventListener('submit', async function (e) {

    if (e.target.id !== 'adminUserForm') return
    e.preventDefault()

    const form = e.target
    const formData = new FormData(form)
    const url = form.getAttribute('action')

    try {

      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      })

      if (!response.ok) {
        const errorData = await response.json()
        showAdminUserValidationErrors(errorData.errors)
        return
      }

      const data = await response.json()

      if (data.success) {
        closeUserModal()
        await refreshUserTable()
        notifySuccess('User berhasil disimpan')
      }

    } catch (err) {
      console.error('Gagal simpan user:', err)
    }

  })

  /* =======================================================
     🔁 TOGGLE ACTIVE
  ======================================================= */

  document.addEventListener('click', async (e) => {
    const button = e.target.closest('.toggle-user')
    if (!button) return

    const id = button.dataset.id

    const confirmed = await notifyConfirm({
      title: 'Ubah status user?',
      text: 'Status aktif akan berubah'
    })

    if (!confirmed.isConfirmed) return

    try {

      const response = await fetch(`/admin/users/${id}/toggle`, {
        method: 'PATCH',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      })

      const data = await response.json()

      if (data.success) {
        await refreshUserTable()
        notifySuccess('Status user berhasil diperbarui')
      }

    } catch (err) {
      notifyError('Gagal mengubah status user')
    }

  })

  /* =======================================================
     VALIDATION
  ======================================================= */

  function showAdminUserValidationErrors(errors) {
    userModalContent.querySelectorAll('.admin-user-error').forEach(el => el.remove())

    for (const field in errors) {
      const input = userModalContent.querySelector(`[name="${field}"]`)
      if (!input) continue

      const div = document.createElement('div')
      div.className = 'admin-user-error text-red-500 text-sm mt-1'
      div.innerText = errors[field][0]

      input.parentNode.appendChild(div)
    }
  }

  closeUserModalBtn?.addEventListener('click', closeUserModal)

  userModal?.addEventListener('click', (e) => {
    if (e.target === userModal) closeUserModal()
  })

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !userModal.classList.contains('hidden')) {
      closeUserModal()
    }
  })

})