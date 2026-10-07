/* Five publication positions, with cloned edges for seamless movement in either direction. */
(() => {
    const section = document.querySelector('.coverage');
    const track = section.querySelector('.coverage-track');
    const cards = [...track.children];
    const dots = [...section.querySelectorAll('.coverage-dots button')];
    const count = cards.length;
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    let index = 0, position = count, busy = false, timer, settleTimer;
    let hovered = false, focused = false, visible = false;
    let paused = false;
    const clone = card => {
        const copy = card.cloneNode(true);
        copy.setAttribute('aria-hidden', 'true');
        return copy;
    };
    track.prepend(...cards.map(clone));
    track.append(...cards.map(clone));
    function paint(animate = true) {
        const step = cards[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap);
        track.style.transition = animate && !reduced.matches ? '' : 'none';
        track.style.transform = `translateX(${-position * step}px)`;
        dots.forEach((dot, i) => dot.setAttribute('aria-pressed', String(i === index)));
        section.dataset.index = index;
    }
    function schedule() {
        clearTimeout(timer);
        if (!reduced.matches && !paused && !document.hidden && !hovered && !focused && visible)
            timer = setTimeout(() => move(1), 3500);
    }
    function settle() {
        clearTimeout(settleTimer);
        position = count + index;
        paint(false);
        busy = false;
        schedule();
    }
    function move(delta) {
        if (busy || !delta) return;
        clearTimeout(timer);
        busy = true;
        index = (index + delta + count) % count;
        position += delta;
        // Commit an edge reset before restoring the CSS transition.
        track.getBoundingClientRect();
        paint();
        if (reduced.matches) settle();
        else settleTimer = setTimeout(settle, 600);
    }
    track.addEventListener('transitionend', event => {
        if (event.target === track && event.propertyName === 'transform') settle();
    });
    section.querySelector('.coverage-prev').addEventListener('click', () => move(-1));
    section.querySelector('.coverage-next').addEventListener('click', () => move(1));
    dots.forEach((dot, i) => dot.addEventListener('click', () => move(i - index)));
    section.addEventListener('keydown', event => {
        if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
            event.preventDefault();
            move(event.key === 'ArrowLeft' ? -1 : 1);
        }
    });
    section.addEventListener('pointerenter', event => { if(event.pointerType === 'mouse'){hovered = true; schedule();} });
    section.addEventListener('pointerleave', () => {hovered = false; schedule();});
    section.addEventListener('focusin', () => {focused = true; schedule();});
    section.addEventListener('focusout', () => {
        requestAnimationFrame(() => {focused = section.contains(document.activeElement); schedule();});
    });
    document.addEventListener('ignite:motionchange', event => {paused = event.detail.paused; schedule();});
    document.addEventListener('visibilitychange', schedule);
    reduced.addEventListener('change', settle);
    new IntersectionObserver(([entry]) => {visible = entry.isIntersecting; schedule();}, {threshold: .15}).observe(section);
    new ResizeObserver(settle).observe(section.querySelector('.coverage-window'));
    paint(false);
})();
