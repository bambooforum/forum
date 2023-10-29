pagination((li, data) => {
    function create(type, classes) {
        const element = document.createElement(type);
        for(const classname of classes) {
            element.classList.add(classname);
        }
        return element;
    }
    function append(parent, childs) {
        console.log(parent, childs)
        for(const child of childs) {
            parent.appendChild(child);
        }
        return parent;
    }

    const thread = create('div', ['thread']);
    thread.setAttribute('data-author', 'author');
    thread.setAttribute('data-id', data?.id ?? 1);

    const title = create('h3', []);
    const titlelink = create('a', ['titulo-thread']);
    titlelink.textContent = 'Thread title';
    titlelink.href = '/thread.html';
    // const authorimage = create('img', [])
    const smalltext = create('span', []);
    smalltext.textContent = 'lorem ipsum diem sit amet.'

    li.appendChild(append(thread, [
        append(title, [titlelink]),
        smalltext
    ]))
    return li;
});
