/**
 * @param {string} endpoint 
 * @param {(li: HTMLLIElement, data: unknown) => void} renderer 
 */
async function pagination (endpoint, renderer, extra = []) {
    const wrapper = document.querySelector('main div.pagination-wrapper');
    const controlswrapper = wrapper.querySelector('.pagination-controls');
    /**
     * @type {Map<'end'|'start'|'previous'|'next', HTMLButtonElement>}
     */
    const controls = new Map();
    for(const btn of controlswrapper.querySelectorAll('li button')) {
        const name = btn.id.replace(/^pagination-control-/, '');
        controls.set(name, btn);
    }
    const content = wrapper.querySelector('.pagination-content');

    console.log(wrapper, controls, content);

    const shown = 10;
    let actual = 0;
    let loading = false;
    let total = NaN;

    function clear() {
        while(content.firstChild) {
            content.removeChild(content.lastChild);
        }
    }
    const actions = Object.freeze({
        next() {
            return {
                next: actual + shown,
                diff: shown
            }
        },
        previous() {
            return {
                next: actual - shown,
                diff: -shown
            }
        },
        start() {
            return {
                next: 0,
                diff: -actual
            }
        },
        end() {
            const num = total - (total % shown === 0 ? shown : total % shown);
            return {
                next: num,
                diff: num - actual
            }
        }
    });
    function disableforwards() {
        controls.get('end').disabled = true;
        controls.get('next').disabled = true;
    }
    function enableforwards() {
        controls.get('end').disabled = false;
        controls.get('next').disabled = false;
    }
    function disablebackwards() {
        controls.get('start').disabled = true;
        controls.get('previous').disabled = true;
    }
    
    function enablebackwards() {
        controls.get('start').disabled = false;
        controls.get('previous').disabled = false;
    }

    for(const [id, btn] of controls) {
        btn.addEventListener('click', async event => {
            if(loading) return;
            loading = true;

            const action = actions[id];

            const { next, diff } = action();
            const limit = shown;

            let query = `?start=${next}&limit=${limit}`;
            console.log('AAAAAAAAA', extra)
            for(const param of extra) {
                const key = Object.keys(param)[0];
                const value = param[key];
                console.log('BBBBBB', key, value)
                query += `&${key}=${value}`;
            }
            console.log(query);
            // do the api call
            const res = await (await fetch(`${endpoint}${query}`)).json();
            console.log(res);
            total = res.totalCount;
            // render
            if(res.count > 0) {
                clear();
                for(const data of res.data) {
                    const li = document.createElement('li');
                    renderer(li, data);
                    if(!(li instanceof HTMLLIElement)) continue;
                    li.classList.add('pagination-content-item');
                    content.appendChild(li);
                }
                actual = next;
            }
            if((next + res.count) === res.totalCount) {
                disableforwards();
            } else {
                enableforwards();
            }
            if(next === 0) {
                disablebackwards();
            } else {
                enablebackwards();
            }

            loading = false;
        })
    }
    controls.get('start')?.dispatchEvent(new Event('click'));
}
