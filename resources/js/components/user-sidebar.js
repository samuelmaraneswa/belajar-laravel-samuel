document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("userSidebarToggle")
  const sidebar = document.getElementById("userSidebar")
  const overlay = document.getElementById("sidebarOverlay")

  if (!btn || !sidebar || !overlay) return

  const toggleSidebar = () => {
    sidebar.classList.toggle("-translate-x-full")
    overlay.classList.toggle("hidden")
  }

  btn.addEventListener("click", toggleSidebar)
  overlay.addEventListener("click", toggleSidebar)
})
