const menu = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#main-navigation');
const compactHeader = matchMedia('(max-width: 1100px)');
const mobileActions = document.createElement('div');
mobileActions.className = 'mobile-menu-actions';
const headerActions = ['.search-toggle', '.language', '.login'].map(selector => {
    const element = document.querySelector(selector);
    if (!element) return null;
    const marker = document.createComment('Header action position');
    element.before(marker);
    return {element, marker};
}).filter(Boolean);
function closeMenu(restoreFocus = false) {
    navigation.classList.remove('open');
    menu.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('mobile-menu-open');
    if (restoreFocus) menu.focus();
}
function arrangeHeader() {
    closeMenu();
    if (compactHeader.matches) {
        navigation.append(mobileActions);
        headerActions.forEach(({element}) => mobileActions.append(element));
    } else {
        headerActions.forEach(({element, marker}) => marker.after(element));
        mobileActions.remove();
    }
}
arrangeHeader();
compactHeader.addEventListener('change', arrangeHeader);
menu.addEventListener('click', () => {
    const open = !navigation.classList.contains('open');
    navigation.classList.toggle('open', open);
    menu.setAttribute('aria-expanded', String(open));
    document.body.classList.toggle('mobile-menu-open', open);
});
navigation.addEventListener('click', event => {
    if(event.target.closest('a')) closeMenu();
});
document.addEventListener('keydown', event => {
    if(!compactHeader.matches || !navigation.classList.contains('open')) return;
    if(event.key === 'Escape') {event.preventDefault();closeMenu(true);}
    if(event.key === 'Tab') {
        const focusable = [menu, ...navigation.querySelectorAll('a[href],button')];
        const first = focusable[0], last = focusable[focusable.length - 1];
        if(event.shiftKey && document.activeElement === first) {event.preventDefault();last.focus();}
        else if(!event.shiftKey && document.activeElement === last) {event.preventDefault();first.focus();}
    }
});
const newsItems = [...document.querySelectorAll('.news-item')];
const dots = [...document.querySelectorAll('.news-dots button')];
function selectNews(index) {document.dispatchEvent(new CustomEvent('ignite:newschange',{detail:{index}}));newsItems.forEach((item,i) => {item.classList.toggle('active',i===index);item.querySelector('button').setAttribute('aria-expanded',String(i===index));});dots.forEach((dot,i)=>{dot.classList.toggle('active',i===index);dot.setAttribute('aria-pressed',String(i===index));});}
newsItems.forEach((item,i)=>item.querySelector('button').addEventListener('click',()=>selectNews(i)));
dots.forEach((dot,i)=>dot.addEventListener('click',()=>selectNews(i)));
const info = document.querySelector('#information');
document.querySelectorAll('a[href^="#"]').forEach(a=>a.addEventListener('click',event=>{const target=a.getAttribute('href');if(document.getElementById(target.slice(1)))return;event.preventDefault();info.querySelector('h2').textContent=a.textContent.trim();info.querySelector('p').textContent=window.igniteText('This destination is not included in the supplied homepage. Its page or service URL is needed to connect this link.');info.showModal();}));
document.querySelector('.language').addEventListener('click',()=>{closeMenu(true);document.querySelector('#language-dialog').showModal();});
document.querySelectorAll('[data-language]').forEach(link=>link.addEventListener('click',()=>{const url=new URL(link.href);url.hash=location.hash;link.href=url.href;}));
document.querySelectorAll('dialog').forEach(dialog=>{dialog.querySelector('.dialog-close').addEventListener('click',()=>dialog.close());dialog.addEventListener('click',event=>{if(event.target===dialog){const r=dialog.getBoundingClientRect();if(event.clientX<r.left||event.clientX>r.right||event.clientY<r.top||event.clientY>r.bottom)dialog.close();}});});
const search = document.querySelector('#search-dialog');
document.querySelector('.search-toggle')?.addEventListener('click',()=>{closeMenu(true);search.showModal();});
search.querySelector('form').addEventListener('submit',event=>{event.preventDefault();const query=document.querySelector('#site-search').value.trim().toLowerCase();const section=[...document.querySelectorAll('main section,footer')].find(section=>section.textContent.toLowerCase().includes(query));if(section){search.close();section.scrollIntoView({behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'instant':'smooth'});}else search.querySelector('.search-result').textContent=window.igniteText('No matching content on this page.');});
