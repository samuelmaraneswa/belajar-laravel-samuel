console.log('admin sidebar loaded');
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("sidebarToggle")
  const sidebar = document.getElementById("adminSidebar")
  const overlay = document.getElementById("sidebarOverlay")

  if(!btn || !sidebar || !overlay) return;

  const toggle = () => {
    sidebar.classList.toggle("-translate-x-full");
    overlay.classList.toggle("hidden");
  };

  btn.addEventListener("click", toggle);
  overlay.addEventListener("click", toggle);
})