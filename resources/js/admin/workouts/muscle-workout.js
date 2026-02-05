document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("svg").forEach(svg => {

    svg.querySelectorAll("path").forEach(path => {
      path.classList.remove("primary", "secondary")
    })

    const primary = muscles.primary || [];
    const secondary = muscles.secondary || [];

    primary.forEach(slug => {
      svg.querySelectorAll(`.${slug}`).forEach(el => {
        el.classList.add("primary");
      });
    });

    secondary.forEach(slug => {
      svg.querySelectorAll(`.${slug}`).forEach(el => {
        el.classList.add("secondary");
      });
    });

  });
}) 