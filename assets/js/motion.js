/* Figma prototype reactions, read directly from the original component variants.
 * Frame 11: 2 s hold + 300 ms ease-in-out, three states, then reverse to first.
 * Timelines use real layers so images move across the crop instead of being swapped.
 */
(() => {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    const animations = [];
    let userPaused = false;
    const ease = 'cubic-bezier(0.42, 0, 0.58, 1)';

    function loop(element, frames, duration, name) {
        const animation = element.animate(frames, {duration, iterations:Infinity, fill:'both'});
        animation.id = name;
        animations.push(animation);
        return animation;
    }

    function states(values, property, hold, duration) {
        const cycle = values.length * (hold + duration);
        const frames = [{[property]:values[0], offset:0, easing:ease}];
        values.forEach((value, i) => {
            frames.push({[property]:value, offset:(i*(hold+duration)+hold)/cycle, easing:ease});
            frames.push({[property]:values[(i+1)%values.length], offset:((i+1)*(hold+duration))/cycle, easing:ease});
        });
        return frames;
    }

    const hero = loop(document.querySelector('.hero-track'), states(['translateX(0%)','translateX(-100%)','translateX(-200%)'],'transform',2000,300),6900,'hero-slides');
    const progress = loop(document.querySelector('.hero-progress span'), states([0,299/224*100,586/224*100].map(x=>`translateX(${x}%)`),'transform',2000,300),6900,'hero-progress');
    const numbers = [...document.querySelectorAll('.slide-number>span')].map((el,index)=>loop(el,states([0,1,2].map(i=>i===index?1:0),'opacity',2000,300),6900,`hero-number-${index+1}`));
    // One start time keeps the image, slide number and progress indicator synchronized.
    const heroAnimations = [hero,progress,...numbers];
    const heroStart = document.timeline.currentTime;
    heroAnimations.forEach(a=>{a.startTime=heroStart;});
    document.querySelector('.hero-progress').addEventListener('click',()=>{
        const next=(Math.floor((Number(hero.currentTime)||0)%6900/2300)+1)%3;
        heroAnimations.forEach(a=>{a.currentTime=next*2300;});
    });

    // Frame 18 advances images horizontally and words vertically on the same clock.
    const journey = loop(document.querySelector('.journey-track'),states([0,-1180/1109*100,-2360/1109*100].map(x=>`translateX(${x}%)`),'transform',1200,300),4500,'journey-images');
    const words = loop(document.querySelector('.journey-words'),states([0,-106/117*100,-230/117*100].map(y=>`translateY(${y}%)`),'transform',1200,300),4500,'journey-words');
    const journeyStart=document.timeline.currentTime;
    [journey,words].forEach(a=>{a.startTime=journeyStart;});

    function twoStates(element,from,to,outward,holdAtEnd,returnDuration,holdAtStart,name) {
        const total=holdAtStart+outward+holdAtEnd+returnDuration;
        return loop(element,[
            {...from,offset:0,easing:ease},
            {...from,offset:holdAtStart/total,easing:ease},
            {...to,offset:(holdAtStart+outward)/total,easing:ease},
            {...to,offset:(holdAtStart+outward+holdAtEnd)/total,easing:ease},
            {...from,offset:1,easing:ease}
        ],total,name);
    }

    // Crop transforms use the image fill matrices from the source variants.
    if(document.querySelector('.news-background')) twoStates(document.querySelector('.news-background'),{transform:'translateY(0%)'},
        {transform:`translateY(${-(0.2834782302379608-0.015072447247803211)*100}%)`},8000,800,8000,1,'news-background-pan');
    const businessScale=0.5425240397453308/0.44218680262565613;
    const businessX=(0.36351168155670166-0.4701792299747467*businessScale)*100;
    const businessY=(0.0002862872206605971-0.110542431473732*(0.9994275569915771/0.814588189125061))*100;
    twoStates(document.querySelector('.business-background'),{transform:'translate(0%,0%) scale(1)'},
        {transform:`translate(${businessX}%,${businessY}%) scale(${businessScale})`},8000,1,8000,1,'business-background-zoom');

    const footerTrack=document.createElement('div');
    footerTrack.className='footer-motion';footerTrack.setAttribute('aria-hidden','true');
    footerTrack.innerHTML='<img src="assets/images/footer.png" alt=""><img src="assets/images/footer.png" alt="">';
    document.querySelector('footer').prepend(footerTrack);
    twoStates(footerTrack,{transform:'translateX(0%)'},{transform:'translateX(-50%)'},10000,1,10000,1,'footer-pattern');

    // Preserve the exported colored SVGs rather than approximating their colors with filters.
    function addIconStates(selector,hoverAsset,kind='arrow') {
        const img=document.querySelector(selector);
        const wrapper=document.createElement('span');
        wrapper.className=`motion-icon motion-icon-${kind}`;wrapper.setAttribute('aria-hidden','true');
        img.before(wrapper);wrapper.append(img);
        if(hoverAsset){const hover=img.cloneNode();hover.src=hoverAsset;hover.className='icon-hover';wrapper.append(hover);}
    }
    addIconStates('.login>img','assets/images/arrow-blue.svg');
    addIconStates('.about>.pill>img','assets/images/smallArrow-blue.svg');
    addIconStates('.learning-image>.pill>img',null);
    addIconStates('.business-copy>.pill>img',null);
    addIconStates('.language>img:first-child','assets/images/globe-blue.svg','globe');
    addIconStates('.language>img.chevron','assets/images/languageChevron-blue.svg','chevron');
    const about=document.querySelector('.about');
    const hoverImage=document.createElement('img');
    hoverImage.className='about-hover-background';hoverImage.src='assets/images/about-hover.png';hoverImage.alt='';
    const shade=document.createElement('div');shade.className='about-shade';shade.setAttribute('aria-hidden','true');
    about.querySelector('.about-background').after(hoverImage,shade);

    // Desktop prototype expands articles from their arrow hotspots; clicks also serve touch/keyboard.
    if(document.querySelector('.news-items')) {
    const newsItems=[...document.querySelectorAll('.news-item')];
    const finePointer=matchMedia('(hover: hover) and (pointer: fine)');
    // GENTLE is exported without physical parameters. This sampled physical spring is
    // a provisional neutral spring (mass 1, stiffness 100, damping 15), not a bezier.
    // Reconfirm against the prototype once the Figma API quota is available again.
    const springSamples=Array.from({length:81},(_,i)=>{
        const time=i/80*1.0220937728881836;
        const omega=Math.sqrt(100-7.5*7.5);
        const value=1-Math.exp(-7.5*time)*(Math.cos(omega*time)+7.5/omega*Math.sin(omega*time));
        return i===80?1:Number(value.toFixed(6));
    });
    document.querySelector('.news-items').style.setProperty('--news-spring',`linear(${springSamples.join(',')})`);
    let selectedNews=0;
    document.addEventListener('ignite:newschange',event=>{
        const duration=selectedNews===1&&event.detail.index===0?1022.0938:383.2856;
        document.querySelector('.news-items').style.setProperty('--news-duration',`${duration}ms`);
        selectedNews=event.detail.index;
    });
    newsItems.forEach((item,index)=>{
        const arrow=item.querySelector('.news-selector>img');
        arrow.addEventListener('pointerenter',()=>{if(finePointer.matches)selectNews(index);});
        // These two mouse-leave reactions are explicitly present in the source variants.
        arrow.addEventListener('pointerleave',()=>{
            if(!finePointer.matches||!item.classList.contains('active'))return;
            if(index===0)selectNews(1);
            else if(index===1)selectNews(0);
        });
        item.querySelector('button').addEventListener('focus',()=>{if(item.querySelector('button').matches(':focus-visible'))selectNews(index);});
    });

    }

    function syncPlayback() {
        animations.forEach(a=>{
            if(reduced.matches){a.pause();a.currentTime=0;}
            else if(document.hidden||userPaused)a.pause();
            else a.play();
        });
        document.dispatchEvent(new CustomEvent('ignite:motionchange', {detail:{paused:userPaused}}));
    }
    reduced.addEventListener('change',syncPlayback);
    document.addEventListener('visibilitychange',syncPlayback);
    syncPlayback();
})();
