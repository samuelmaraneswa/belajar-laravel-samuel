document.addEventListener('DOMContentLoaded', () => {

  const page = document.getElementById('articlePage')
  if (!page) return

  const modal = document.getElementById('articleModal')
  const modalContent = document.getElementById('modalContent')
  const closeBtn = document.getElementById('closeArticleModal')
  const addBtn = document.getElementById('addArticleBtn')
  const tableWrapper = document.getElementById('tableWrapper')

  /* =======================================================
     🎨 SMOOTH MODAL OPEN / CLOSE
  ======================================================= */

  function openModal() {
    modal.classList.remove('hidden')
    modal.classList.add('flex')

    // reset scroll ke atas
    const scrollArea = modal.querySelector('.overflow-y-auto')
    if (scrollArea) scrollArea.scrollTop = 0

    document.body.classList.add('overflow-hidden')

    // smooth animation
    modal.style.opacity = 0
    modal.style.transition = 'opacity 200ms ease'

    requestAnimationFrame(() => {
      modal.style.opacity = 1
    })
  }

  async function closeModal(cleanup = true) {

    if (cleanup) {
      try {
        await fetch('/admin/articles/cleanup-temp', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
      } catch (err) {
        console.error('Cleanup temp gagal:', err)
      }
    }

    if (typeof tinymce !== 'undefined') {
      tinymce.remove('#articleContent')
    }

    modal.style.opacity = 0

    setTimeout(() => {
      modal.classList.add('hidden')
      modal.classList.remove('flex')
      modalContent.innerHTML = ''
      document.body.classList.remove('overflow-hidden')
    }, 200)
  }

  /* =======================================================
     🎯 VALIDATION
  ======================================================= */

  function showValidationErrors(errors) {
    document.querySelectorAll('.error-text').forEach(el => el.remove())

    for (const field in errors) {
      const input = document.querySelector(`[name="${field}"]`)
      if (!input) continue

      const div = document.createElement('div')
      div.className = 'error-text text-red-500 text-sm mt-1'
      div.innerText = errors[field][0]

      input.parentNode.appendChild(div)
    }
  }

  /* =======================================================
     🔄 REFRESH TABLE
  ======================================================= */

  async function refreshTable() {
    if (typeof window.loadArticles === 'function') {
      window.loadArticles(window.articleState.page || 1)
    }
  }

  /* =======================================================
     ✍️ TINYMCE
  ======================================================= */

  function initTiny() {
    if (typeof tinymce === 'undefined') return

    tinymce.remove('#articleContent')

    tinymce.init({
      selector: '#articleContent',
      height: 400,
      menubar: false,
      branding: false,
      plugins: 'link image lists code table table advlist fontsize fontfamily lineheight',
      toolbar:
        'undo redo | fontfamily fontsize lineheight | bold italic | alignleft aligncenter alignright | bullist numlist | link image table | code',

      setup: function (editor) {
        editor.on('keydown', function (e) {
          if (e.key === 'Tab') {
            e.preventDefault()
            editor.execCommand('InsertHTML', false, '&nbsp;&nbsp;&nbsp;&nbsp;')
          }
        })
      },

      images_upload_handler: async (blobInfo) => {
        const formData = new FormData()
        formData.append('image', blobInfo.blob())
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)

        const response = await fetch('/admin/articles/upload-image', {
          method: 'POST',
          body: formData
        })

        const data = await response.json()
        return data.location
      }
    })
  }

  /* =======================================================
     ➕ CREATE
  ======================================================= */

  addBtn?.addEventListener('click', async () => {
    const res = await fetch('/admin/articles/create')
    modalContent.innerHTML = await res.text()
    openModal()
    requestAnimationFrame(initTiny)
  })

  /* =======================================================
     ✏️ EDIT
  ======================================================= */

  document.addEventListener('click', async (e) => {
    const button = e.target.closest('.edit-article')
    if (!button) return

    const id = button.dataset.id
    const res = await fetch(`/admin/articles/${id}/edit`)
    modalContent.innerHTML = await res.text()
    openModal()
    requestAnimationFrame(initTiny)
  })

  /* =======================================================
     💾 SUBMIT (CREATE + UPDATE)
  ======================================================= */

  modalContent.addEventListener('submit', async function (e) {

    if (e.target.id !== 'articleForm') return
    e.preventDefault()

    const form = e.target
    const formData = new FormData(form)

    const editor = tinymce.get('articleContent')
    if (editor) {
      formData.set('content', editor.getContent())
    }

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
        showValidationErrors(errorData.errors)
        return
      }

      const data = await response.json()

      if (data.success) {
        await closeModal(false)
        await refreshTable()
        notifySuccess('Data berhasil disimpan')
      }

    } catch (err) {
      console.error('Gagal simpan:', err)
    }

  })

  /* =======================================================
     🗑 DELETE
  ======================================================= */

  document.addEventListener('submit', async function (e) {

    const form = e.target.closest('.delete-form')
    if (!form) return

    e.preventDefault()

    const confirmed = await notifyConfirm({
      title: 'Yakin hapus?',
      text: 'Data tidak bisa dikembalikan'
    })

    if (!confirmed.isConfirmed) return

    const url = form.getAttribute('action')

    try {

      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: new FormData(form)
      })

      const data = await response.json()

      if (data.success) {
        await refreshTable()
        notifySuccess('Data berhasil dihapus')
      }

    } catch (err) {
      notifyError('Gagal menghapus data')
    }

  })

  /* =======================================================
     👁 VIEW
  ======================================================= */

  document.addEventListener('click', async (e) => {
    const button = e.target.closest('.view-article')
    if (!button) return

    const id = button.dataset.id
    const res = await fetch(`/admin/articles/${id}`)
    modalContent.innerHTML = await res.text()
    openModal()
  })

  closeBtn?.addEventListener('click', () => closeModal(true))

  modal?.addEventListener('click', (e) => {
    if (e.target === modal) closeModal(true)
  })

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal(true)
    }
  })

})
