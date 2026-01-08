document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("mobileMenuBtn");
  const icon = document.getElementById("menuIcon");
  const overlay = document.getElementById("mobileOverlay");
  const sidebar = document.getElementById("mobileSidebar");

  if (!btn || !icon || !overlay || !sidebar) return;

  btn.addEventListener("click", () => {
    overlay.classList.toggle("hidden");
    sidebar.classList.toggle("hidden");

    icon.classList.toggle("fa-bars");
    icon.classList.toggle("fa-xmark");
    icon.classList.toggle("text-white");
  });

  overlay.addEventListener("click", () => {
    overlay.classList.add("hidden");
    sidebar.classList.add("hidden");

    icon.classList.add("fa-bars");
    icon.classList.remove("fa-xmark", "text-white");
  });
});
