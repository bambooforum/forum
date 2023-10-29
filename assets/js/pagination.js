/**
 * @param {(li: HTMLLIElement, data: unknown) => void} renderer 
 */
async function pagination (renderer) {
    const wrapper = document.querySelector('main div.pagination-wrapper');
    const controlswrapper = wrapper.querySelector('.pagination-controls');
    /**
     * @type {Map<string, HTMLButtonElement>}
     */
    const controls = new Map();
    for(const btn of controlswrapper.querySelectorAll('li button')) {
        const name = btn.id.replace(/^pagination-control-/, '');
        controls.set(name, btn);
    }
    const content = wrapper.querySelector('.pagination-content');

    console.log(wrapper, controls, content);

    const shown = 10;
    let actual = 1;
    let loading = false;

    function clear() {
        while(content.firstChild) {
            content.removeChild(content.lastChild);
        }
    }

    for(const [id, btn] of controls) {
        btn.addEventListener('click', event => {
            if(loading) return;
            loading = true;

            const next = actual + shown;
            const stop = next + shown - 1;
            
            const query = `?start=${next}&stop=${stop}`;

            // do the api call
            const res = new Array(shown).fill({});

            // render
            clear();
            for(const data of res) {
                const li = renderer(document.createElement('li'), data);
                if(!(li instanceof HTMLLIElement)) continue;
                li.classList.add('pagination-content-item');
                content.appendChild(li);
            }

            actual = next;
            loading = false;
        })
    }
    controls.get('start')?.dispatchEvent(new Event('click'));
}
