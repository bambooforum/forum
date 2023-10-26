const tabs = document.querySelectorAll('.user-tabs ul li');
const infos = document.querySelectorAll('.user-info div');

for(let i = 0; i < tabs.length; i++) {
    const tab = tabs[i];
    tab.addEventListener('click', e => {
        for(const t of tabs) t.classList.remove('active');
        // tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        for(const info of infos) info.setAttribute('hidden', '');
        // infos.forEach(info => info.setAttribute('hidden', ''));
        infos[i].removeAttribute('hidden');
    });
}
