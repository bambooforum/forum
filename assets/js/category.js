pagination('/api/threads/partial.php', (li, data) => {
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
    thread.setAttribute('data-author', data.authorName);
    thread.setAttribute('data-id', data.id);

    const title = create('h3', []);
    const titlelink = create('a', ['titulo-thread']);
    titlelink.textContent = data.title;
    titlelink.href = '/thread.php?thread_id=' + data.id;
    // const authorimage = create('img', [])
    const smalltext = create('span', []);
    smalltext.textContent = data.text;

    li.appendChild(append(thread, [
        append(title, [titlelink]),
        smalltext
    ]))
    return li;
}, [{
    category_id: categoryId
}]);
document.getElementById('pagination-page-control-button').addEventListener('click', () => {
    window.location = '/createthread.php?category_id=' + categoryId;
})