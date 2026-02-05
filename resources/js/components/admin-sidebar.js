document.addEventListener("DOMContentLoaded", () => {

  /* ===============================
   * MOBILE SIDEBAR TOGGLE
   * =============================== */
  const btn = document.getElementById("sidebarToggle")
  const sidebar = document.getElementById("adminSidebar")
  const overlay = document.getElementById("sidebarOverlay")

  if (btn && sidebar && overlay) {
    const toggleSidebar = () => {
      sidebar.classList.toggle("-translate-x-full")
      overlay.classList.toggle("hidden")
    }

    btn.addEventListener("click", toggleSidebar)
    overlay.addEventListener("click", toggleSidebar)
  }

  /* ===============================
   * SUBMENU TOGGLE (WORKOUTS)
   * =============================== */
  const submenuToggles = document.querySelectorAll('[data-submenu-toggle]')

  submenuToggles.forEach(toggle => {
    const key = toggle.dataset.submenuToggle
    const submenu = document.querySelector(`[data-submenu="${key}"]`)
    const icon = toggle.querySelector('[data-submenu-icon]')

    if (!submenu) return

    // auto open jika sedang di halaman workouts
    if (window.location.pathname.startsWith('/admin/workouts')) {
      submenu.classList.remove('hidden')
      icon?.classList.add('rotate-180')
    }

    toggle.addEventListener('click', () => {
      submenu.classList.toggle('hidden')
      icon?.classList.toggle('rotate-180')
    })
  })

})
