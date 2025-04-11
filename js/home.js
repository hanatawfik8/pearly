function throttle(fn, wait) {
  let lastTime = 0;
  return function (...args) {
    const now = Date.now();
    if (now - lastTime >= wait) {
      fn.apply(this, args);
      lastTime = now;
    }
  };
}

function animateOnScroll() {
  const elements = document.querySelectorAll(".hidden");
  const windowHeight = window.innerHeight;

  elements.forEach((el) => {
    const rect = el.getBoundingClientRect();
    const elementTop = rect.top + window.scrollY;
    const triggerPoint = window.scrollY + windowHeight * 0.8;
    if (elementTop < triggerPoint) {
      requestAnimationFrame(() => {
        el.classList.add("show");
      });
    }
  });
}

window.addEventListener("scroll", throttle(animateOnScroll, 100));

animateOnScroll();
