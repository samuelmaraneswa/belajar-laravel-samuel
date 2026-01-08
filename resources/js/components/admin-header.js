document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("userMenuBtn");
  const menu = document.getElementById("userMenu");
  if (!btn || !menu) return;

  btn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  document.addEventListener("click", (e) => {
    if (!menu.contains(e.target) && !btn.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
});