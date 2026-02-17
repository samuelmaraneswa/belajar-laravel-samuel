document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("mobileMenuBtn");
  const icon = document.getElementById("menuIcon");
  const overlay = document.getElementById("mobileOverlay");
  const sidebar = document.getElementById("mobileSidebar");
  const body = document.body;

  if (!btn || !icon || !overlay || !sidebar) return;

  function openMenu() {
    overlay.classList.remove("hidden");
    sidebar.classList.remove("hidden");

    // trigger animasi
    requestAnimationFrame(() => {
      overlay.classList.remove("opacity-0");
      sidebar.classList.remove("-translate-x-full");
    });

    body.classList.add("overflow-hidden");

    icon.classList.remove("fa-bars");
    icon.classList.add("fa-xmark", "text-red-600");
  }

  function closeMenu() {
    overlay.classList.add("opacity-0");
    sidebar.classList.add("-translate-x-full");

    body.classList.remove("overflow-hidden");

    icon.classList.add("fa-bars");
    icon.classList.remove("fa-xmark", "text-red-600");

    // tunggu animasi selesai baru hidden
    setTimeout(() => {
      overlay.classList.add("hidden");
      sidebar.classList.add("hidden");
    }, 300);
  }

  btn.addEventListener("click", () => {
    overlay.classList.contains("hidden") ? openMenu() : closeMenu();
  });

  overlay.addEventListener("click", closeMenu);
});
