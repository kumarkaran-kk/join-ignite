(() => {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    const footer = document.createElement('div');
    footer.className = 'footer-motion';footer.setAttribute('aria-hidden','true');
    footer.innerHTML = '<img src="assets/images/footer.png" alt=""><img src="assets/images/footer.png" alt="">';
    document.querySelector('footer').prepend(footer);
    const motion = footer.animate([{transform:'translateX(0)'},{transform:'translateX(-50%)'},{transform:'translateX(0)'}],{duration:20000,iterations:Infinity,easing:'ease-in-out'});
    let paused=false, footerVisible=false, heroVisible=true;
    const activeReveals=new Set();
    function sync(){
        const stopped=paused||document.hidden||reduced.matches;
        document.body.classList.toggle('motion-paused',stopped||!heroVisible);
        if(stopped||!footerVisible)motion.pause();else motion.play();
        if(reduced.matches)motion.currentTime=0;
        if(stopped){activeReveals.forEach(a=>a.finish());activeReveals.clear();}
    }
    const visibility=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.target.tagName==='FOOTER')footerVisible=e.isIntersecting;else heroVisible=e.isIntersecting;});sync();});
    visibility.observe(document.querySelector('footer'));visibility.observe(document.querySelector('.page-hero'));
    const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{if(!entry.isIntersecting)return;observer.unobserve(entry.target);if(reduced.matches||paused)return;const a=entry.target.animate([{opacity:0,transform:'translateY(24px)'},{opacity:1,transform:'translateY(0)'}],{duration:700,easing:'cubic-bezier(.22,1,.36,1)'});activeReveals.add(a);a.onfinish=()=>activeReveals.delete(a);}),{threshold:.1});
    document.querySelectorAll('.page-hero-copy>* ,.page-card,.page-content>h2,.page-next').forEach(el=>observer.observe(el));
    reduced.addEventListener('change',sync);document.addEventListener('visibilitychange',sync);sync();
})();
