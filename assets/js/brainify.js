(() => {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    const loops = [], reveals = new Set(), visible = new WeakMap();
    let paused = false;
    function loop(element, frames, duration, name, delay = 0) {
        const animation = element.animate(frames, {duration, delay, iterations:Infinity, easing:'ease-in-out'});
        animation.id = `brainify-${name}`;
        loops.push({animation,region:element.closest('section,footer')});animation.pause();
    }
    function network(parent, className) {
        const ns='http://www.w3.org/2000/svg', svg=document.createElementNS(ns,'svg');
        svg.setAttribute('viewBox','0 0 600 500');svg.setAttribute('class',className);svg.setAttribute('aria-hidden','true');
        const nodes=[[45,90],[155,40],[285,105],[440,35],[560,135],[505,270],[565,425],[395,450],[305,325],[145,430],[40,290],[155,205],[355,210]];
        const edges=[[0,1],[1,2],[2,3],[3,4],[4,5],[5,6],[6,7],[7,8],[8,9],[9,10],[10,0],[0,11],[11,2],[11,10],[11,8],[2,12],[12,5],[12,8],[8,5]];
        edges.forEach(([a,b],i)=>{
            const path=document.createElementNS(ns,'path');path.setAttribute('d',`M${nodes[a]} L${nodes[b]}`);path.setAttribute('class','neural-link');svg.append(path);
            if(i%2===0){const pulse=path.cloneNode();pulse.setAttribute('class','neural-packet');pulse.setAttribute('pathLength','100');svg.append(pulse);}
        });
        nodes.forEach(([cx,cy])=>{const node=document.createElementNS(ns,'circle');node.setAttribute('cx',cx);node.setAttribute('cy',cy);node.setAttribute('r','4');svg.append(node);});
        parent.prepend(svg);
        svg.querySelectorAll('.neural-packet').forEach((packet,i)=>loop(packet,[{strokeDashoffset:110,opacity:0},{strokeDashoffset:80,opacity:.85,offset:.2},{strokeDashoffset:-10,opacity:0}],4200+i*190,`${className}-packet-${i}`,-i*620));
        return svg;
    }
    const field=network(document.querySelector('.brainify-hero'),'brainify-neural-field');
    loop(field,[{transform:'translate(-2%,0) scale(1)'},{transform:'translate(2%,-3%) scale(1.07)'},{transform:'translate(-2%,0) scale(1)'}],18000,'hero-field');
    loop(document.querySelector('.brainify-hero-visual>img'),[{transform:'scale(1.02)'},{transform:'scale(1.14) translateX(-2%)'},{transform:'scale(1.02)'}],14000,'hero-camera');
    loop(document.querySelector('.brainify-image-caption'),[{transform:'translateY(0)'},{transform:'translateY(9px)'},{transform:'translateY(0)'}],4200,'hero-caption');
    loop(document.querySelector('.brainify-live-dot'),[{boxShadow:'0 0 0 0 #18459855'},{boxShadow:'0 0 0 9px #18459800'}],2200,'status-pulse');
    network(document.querySelector('.brainify-mentor-art'),'brainify-mentor-network');
    loop(document.querySelector('.brainify-mentor-core'),[{transform:'scale(1)',boxShadow:'0 0 35px #3264bc44'},{transform:'scale(1.07)',boxShadow:'0 0 85px #3264bc99'},{transform:'scale(1)',boxShadow:'0 0 35px #3264bc44'}],4200,'mentor-core');
    document.querySelectorAll('.brainify-orbit-label').forEach((label,i)=>loop(label,[{transform:'translateY(0)'},{transform:`translateY(${i%2?-10:10}px)`},{transform:'translateY(0)'}],3800+i*700,`mentor-label-${i}`));
    document.querySelectorAll('.brainify-level-grid article').forEach((article,i)=>{
        const trace=document.createElement('span');trace.className='brainify-level-trace';trace.setAttribute('aria-hidden','true');article.prepend(trace);
        loop(trace,[{transform:'scaleX(0)',opacity:0},{transform:'scaleX(1)',opacity:1,offset:.45},{transform:'scaleX(1)',opacity:0}],4500,`level-trace-${i}`,i*1000);
    });
    const footer=document.createElement('div');footer.className='footer-motion';footer.setAttribute('aria-hidden','true');footer.innerHTML='<img src="assets/images/footer.png" alt=""><img src="assets/images/footer.png" alt="">';document.querySelector('footer').prepend(footer);
    loop(footer,[{transform:'translateX(0)'},{transform:'translateX(-50%)'},{transform:'translateX(0)'}],20000,'footer-pattern');
    function reveal(element,delay=0){
        if(reduced.matches||paused)return;
        const animation=element.animate([{opacity:0,transform:'translateY(26px)'},{opacity:1,transform:'translateY(0)'}],{duration:850,delay,easing:'cubic-bezier(.22,1,.36,1)',fill:'backwards'});
        reveals.add(animation);animation.onfinish=()=>reveals.delete(animation);
    }
    const entrance=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting){reveal(entry.target,Number(entry.target.dataset.motionDelay||0));entrance.unobserve(entry.target);}}),{threshold:.12});
    document.querySelectorAll('.brainify-hero-copy>*,.brainify-hero-visual,.brainify-facts>div,.brainify-section>.brainify-eyebrow,.brainify-section>h2,.brainify-promise>p:last-child,.brainify-section-heading,.brainify-path,.brainify-level-grid article,.brainify-mentor>div:last-child,.brainify-audience-list span,.brainify-join>.brainify-button').forEach((element,i)=>{element.dataset.motionDelay=(i%3)*90;entrance.observe(element);});
    document.querySelectorAll('.brainify-path').forEach(card=>card.addEventListener('toggle',()=>{if(card.open)reveal(card.querySelector('.brainify-path-description'));}));
    function sync() {
        const stopped=paused||document.hidden||reduced.matches;
        document.body.classList.toggle('motion-paused', stopped);
        loops.forEach(({animation,region})=>{if(stopped||!visible.get(region))animation.pause();else animation.play();if(reduced.matches)animation.currentTime=0;});
        if(stopped){reveals.forEach(a=>a.finish());reveals.clear();}
    }
    document.addEventListener('visibilitychange', sync);
    reduced.addEventListener('change',sync);
    const viewport=new IntersectionObserver(entries=>{entries.forEach(entry=>{visible.set(entry.target,entry.isIntersecting);entry.target.classList.toggle('brainify-offscreen',!entry.isIntersecting);});sync();},{threshold:0});
    new Set(loops.map(item=>item.region)).forEach(region=>viewport.observe(region));
    sync();
})();
