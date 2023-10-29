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

    const post = create('div', ['post']);

    const user = create('div', ['post-user']);
    const username = create('span', ['post-username']);
    const image = create('img', ['post-image']);

    const main = create('div', ['post-main']);
    const content = create('div', ['post-content']);
    const extra = create('div', ['post-extra']);
    const signature = create('div', ['post-signature']);
    const likes = create('div', ['post-likes']);

    username.textContent = 'Username';
    image.href = '#';
    image.alt = 'pfp'

    li.appendChild(append(post, [
        append(user, [username, image]),
        append(main, [content, append(extra, [signature, likes])])
    ]))
    return li;
});
