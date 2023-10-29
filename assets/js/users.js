pagination((li, data) => {
    const index = data?.index ?? 0;
    function create(type, classes = []) {
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

    const user = create('div', ['user-info']);
    const imagewrapper = create('div', ['user-image']);
    const image = create('img');
    image.src = `/assets/img/00${7+index % 3}.png`;
    image.alt = 'pfp';
    const details = create('div', ['user-details']);
    const name = create('span', ['user-name']);
    name.textContent = 'name' + index;
    const role = create('span', ['user-role']);
    role.textContent = index % 3 == 0 ? 'Admin' : 'normi';
    const description = create('span', ['user-description']);
    description.textContent = 'Descripció de l\'usuari';
    
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
