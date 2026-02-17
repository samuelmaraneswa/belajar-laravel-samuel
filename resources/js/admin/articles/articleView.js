export function initArticleView() {

  const modal = document.getElementById("articleModal");
  const modalContent = document.getElementById("modalContent");
  const closeBtn = document.getElementById("closeArticleModal");

  if (!modal || !modalContent) return;

  // open modal
  document.addEventListener("click", function (e) {

    const button = e.target.closest(".view-article");
    if (!button) return;

    const id = button.dataset.id;

    fetch(`/articles/${id}`)
      .then(res => res.text())
      .then(html => {
        modalContent.innerHTML = html;
        modal.classList.remove("hidden");
      })
      .catch(err => {
        console.error("Gagal load article:", err);
      });

  });

  // close modal (button)
  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
      modalContent.innerHTML = "";
    });
  }

  // close modal (klik backdrop)
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      modal.classList.add("hidden");
      modalContent.innerHTML = "";
    }
  });

}
