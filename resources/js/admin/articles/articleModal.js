document.addEventListener('DOMContentLoaded', () => {

  const page = document.getElementById('articlePage')
  if (!page) return

  const modal = document.getElementById('articleModal')
  const modalContent = document.getElementById('modalContent')
  const closeBtn = document.getElementById('closeArticleModal')
  const addBtn = document.getElementById('addArticleBtn')

  function openModal() {
    modal.classList.remove('hidden')
    modal.classList.add('flex')
    document.body.classList.add('overflow-hidden')
  }

  async function closeModal(cleanup = true) {

    // 🔥 Hapus semua temp jika bukan karena save
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

    modal.classList.add('hidden')
    modal.classList.remove('flex')
    modalContent.innerHTML = ''
    document.body.classList.remove('overflow-hidden')
  }

  function initTiny() {
    if (typeof tinymce === 'undefined') return

    tinymce.remove('#articleContent')

    tinymce.init({
      selector: '#articleContent',
      height: 400,
      menubar: false,
      branding: false,
      plugins: 'link image lists code',
      toolbar:
        'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',

      images_upload_url: '/admin/articles/upload-image',
      automatic_uploads: true,

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
      },

      content_style: `
        body {
          font-family: sans-serif;
          max-width: 100%;
          overflow-x: hidden;
        }
      `
    })
  }

  // OPEN CREATE
  addBtn?.addEventListener('click', async () => {
    const res = await fetch('/admin/articles/create')
    const html = await res.text()

    modalContent.innerHTML = html
    openModal()

    requestAnimationFrame(() => {
      initTiny()
    })
  })

  // 🔥 OPEN EDIT
  document.addEventListener('click', async (e) => {

    const button = e.target.closest('.edit-article')
    if (!button) return

    const id = button.dataset.id

    try {
      const res = await fetch(`/admin/articles/${id}/edit`)
      const html = await res.text()

      modalContent.innerHTML = html
      openModal()

      requestAnimationFrame(() => {
        initTiny()
      })

    } catch (err) {
      console.error('Gagal load edit form:', err)
    }

  })

  // 🔥 SUBMIT AJAX (CREATE + UPDATE)
  modalContent.addEventListener('submit', async function (e) {

    if (e.target.id !== 'articleForm') return
    e.preventDefault()

    const form = e.target
    const formData = new FormData(form)

    const editor = tinymce.get('articleContent')
    if (editor) {
      formData.set('content', editor.getContent())
    }

    const id = formData.get('id') // 🔥 cek apakah edit

    let url = '/admin/articles'
    let method = 'POST'

    if (id) {
      url = `/admin/articles/${id}`
      formData.append('_method', 'PUT') // Laravel spoof
    }

    try {

      const response = await fetch(url, {
        method: 'POST', // tetap POST, karena kita pakai _method
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      })

      const data = await response.json()

      if (data.success) {
        await closeModal(false)
        location.reload()
      }

    } catch (err) {
      console.error('Gagal simpan:', err)
    }

  })

  // CLOSE BUTTON (X)
  closeBtn?.addEventListener('click', () => closeModal(true))

  // CLOSE OUTSIDE
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) closeModal(true)
  })

  // CLOSE ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal(true)
    }
  })

  // 🔥 OPEN VIEW (AJAX SHOW)
  document.addEventListener('click', async (e) => {

    const button = e.target.closest('.view-article')
    if (!button) return

    const id = button.dataset.id

    try {
      const res = await fetch(`/admin/articles/${id}`)
      const html = await res.text()

      modalContent.innerHTML = html
      openModal()

    } catch (err) {
      console.error('Gagal load article:', err)
    }

  })

})
