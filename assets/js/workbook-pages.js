(() => {
    function openLinkedSection() {
        const target=document.getElementById(location.hash.slice(1));
        if(target?.matches('details'))target.open=true;
        if(target){
            if(!target.hasAttribute('tabindex'))target.setAttribute('tabindex','-1');
            target.focus({preventScroll:true});
        }
    }
    window.addEventListener('hashchange',openLinkedSection);
    openLinkedSection();
    // Fonts can change section positions after a cross-page anchor has loaded.
    if(location.hash)document.fonts.ready.then(()=>{
        const target=document.getElementById(location.hash.slice(1));
        target?.scrollIntoView({behavior:'instant',block:'start'});
    });
})();
