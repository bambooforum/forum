const langsels = document.querySelectorAll('select.lang');

for(const sel of langsels) {
    sel.addEventListener('change', async event => {
        const target = event.target;
        await fetch(`/api/swaplang.php?lang=${target.value}`);
        window.location.reload();
    })
}

