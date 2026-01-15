function initAnchorMenu() {
  const menu = document.querySelector('[data-anchor-menu]')
  if (!menu) return

  const links = menu.querySelectorAll('[data-anchor-link]')
  const sections = [...links]
    .map(link => document.querySelector(link.getAttribute('href')))
    .filter(Boolean)

  if (!sections.length) return

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return

        links.forEach(l => l.classList.remove('is-active'))

        const active = menu.querySelector(
          `[href="#${entry.target.id}"]`
        )
        if (active) active.classList.add('is-active')
      })
    },
    {
      rootMargin: '-40% 0px -50% 0px',
      threshold: 0
    }
  )

  sections.forEach(section => observer.observe(section))
}

document.addEventListener('DOMContentLoaded', initAnchorMenu)
