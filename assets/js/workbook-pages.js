(() => {
    function openLinkedSection() {
        const target=document.getElementById(location.hash.slice(1));
        if(target?.matches('details'))target.open=true;
    }
    window.addEventListener('hashchange',openLinkedSection);
    openLinkedSection();
})();
