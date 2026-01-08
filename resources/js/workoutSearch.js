document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("search");
  const box = document.getElementById("suggestions");
  const icon = document.getElementById("searchIcon");
  
  if(!input || !box || !icon) return;

  const hasValueOnLoad = input.value.trim().length > 0;
  icon.classList.toggle("fa-magnifying-glass", !hasValueOnLoad);
  icon.classList.toggle("fa-xmark", hasValueOnLoad);
  icon.classList.toggle("text-gray-400", !hasValueOnLoad);
  icon.classList.toggle("text-red-500", hasValueOnLoad);

  let controller;
  let activeIndex = -1;

  input.addEventListener("input", async () => {
    const q = input.value.trim();
    activeIndex = -1;

    const hasValue = input.value.trim().length > 0;
    icon.classList.toggle("fa-magnifying-glass", !hasValue);
    icon.classList.toggle("fa-xmark", hasValue);
    icon.classList.toggle("text-gray-400", !hasValue);
    icon.classList.toggle("text-red-500", hasValue);
    
    if(q.length < 1){
      box.classList.add("hidden");
      box.innerHTML = "";
      return;
    }

    if(controller) controller.abort();
    controller = new AbortController();

    try{
      const res = await fetch(`/workouts/suggest?q=${encodeURIComponent(q)}`, {
        signal: controller.signal,
        headers: {"X-Requested-With": "XMLHttpRequest"}
      });

      const data = await res.json();

      if(!data.length){
        box.classList.add("hidden");
        return;
      }

      box.innerHTML = data.map(title => `
        <div
          class="px-4 py-2 cursor-pointer hover:bg-indigo-50"
          data-title="${title}">
          ${title}
        </div>
      `).join("");

      box.classList.remove("hidden")
      }catch (e){
      // abort = normal
      console.error(e);
    }
  });

  input.addEventListener("keydown", (e) => {
    if (box.classList.contains("hidden")) return;

    const items = box.querySelectorAll("[data-title]");
    if(!items.length) return;

    if(e.key === "ArrowDown"){
      e.preventDefault();
      activeIndex = activeIndex < items.length - 1 ? activeIndex + 1 : 0;
      updateActive(items);
    }

    if(e.key === "ArrowUp"){
      e.preventDefault();
      activeIndex = activeIndex > 0 ? activeIndex - 1 : items.length - 1;
      updateActive(items);
    }
  });

  function updateActive(items){
    items.forEach((el, i) => {
      el.classList.toggle("bg-indigo-100", i === activeIndex);
    });

    if (activeIndex >= 0) {
      input.value = items[activeIndex].dataset.title; 
    }
  }

  icon.addEventListener("click", () => {
    if(!input.value) return;

    input.value = "";
    box.classList.add("hidden");
    box.innerHTML = "";

    icon.classList.remove("fa-xmark", "text-red-500");
    icon.classList.add("fa-magnifying-glass", "text-gray-400");

    input.focus();
  })

  box.addEventListener("click", (e) => {
    const item = e.target.closest("[data-title]");
    if(!item) return;

    const title = item.dataset.title;
    window.location.href = `/workouts?search=${encodeURIComponent(title)}`;
  });

  document.addEventListener("click", (e) => {
    if(!e.target.closest("form")){
      box.classList.add("hidden");
      activeIndex = -1;
    }
  })
})