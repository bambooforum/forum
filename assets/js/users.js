pagination('/api/users/partial.php', (li, data) => {
    function create(type, classes = []) {
        const element = document.createElement(type);
        for(const classname of classes) {
            element.classList.add(classname);
        }
        return element;
    }
    function append(parent, childs) {
        for(const child of childs) {
            parent.appendChild(child);
        }
        return parent;
    }

    /**
     * 
     * @param {string} str 
     */
    function shorternstr(str) {
        const maxlen = 40;
        let retstr = str;

        if(str.length > maxlen) {
            retstr = str.substring(0, maxlen - 4) + '...';
        }

        return retstr;
    }

    const user = create('div', ['user-info']);
    user.onclick = () => window.location = `/user.php?username=${data.name}`;
    const imagewrapper = create('div', ['user-image']);
    const image = create('img');
    image.src = `/assets/img/users/${data.id}.png`;
    image.alt = 'pfp';
    const details = create('div', ['user-details']);
    const name = create('span', ['user-name']);
    name.textContent = data.name;
    const role = create('span', ['user-role']);
    role.textContent = data.admin ? 'Admin' : 'normi';
    const description = create('span', ['user-description']);
    description.textContent = shorternstr(data.description ?? '');
    
    li.appendChild(append(user, [
        append(imagewrapper, [image]),
        append(details, [
            name,
            role,
            description
        ])
    ]));
    return li;
});
