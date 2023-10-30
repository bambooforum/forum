const editbtns = document.querySelector('#categories').querySelectorAll('.secondarybtn');
const editfn = event => {
        const container = event.target.parentElement.parentElement;
        const text = container.querySelector('span.item-name');
        const input = document.createElement('input');
        input.value = text.textContent;
        const savebtn = document.createElement('button');
        savebtn.textContent = 'save';
        savebtn.classList.add('secondarybtn');
        for(const el of container.querySelectorAll('button, span, input, div')) {
            el.style.display = 'none';
        }
        container.appendChild(input);
        container.appendChild(savebtn);

        savebtn.addEventListener('click', () => {
            text.textContent = input.value;
            input.remove();
            savebtn.remove();
            for(const el of container.querySelectorAll('button, span, input, div')) {
                el.style.display = '';
            }
        })
    }
for(const btn of editbtns) {
    btn.addEventListener('click', editfn);
}

const delbtn = document.querySelector('#categories').querySelectorAll('.dangerbtn');
const delfn = event => {
        const container = event.target.parentElement.parentElement;
        console.log(container)
        container.remove();
    }
for(const btn of delbtn) {
    btn.addEventListener('click', delfn);
}

const add = document.querySelector('h2 button');

add.addEventListener('click', () => {
    const categories = document.querySelector('#categories');
    const li = document.createElement('li');
    const span = document.createElement('span');
    span.classList.add('item-name');
    span.textContent = 'New category';
    const edit = document.createElement('button');
    const del = document.createElement('button');
    edit.textContent = 'edit';
    del.textContent = 'remove';
    const div = document.createElement('div');

    edit.classList.add('secondarybtn');
    del.classList.add('dangerbtn');

    categories.appendChild(li);
    li.appendChild(span);
    li.appendChild(div);
    div.appendChild(edit);
    div.appendChild(del);
    edit.addEventListener('click', editfn);
    del.addEventListener('click', delfn)
    edit.dispatchEvent(new Event('click'))
})