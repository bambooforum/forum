
pagination('/api/posts/partial.php', (li, data) => {
    console.log("entra en pagination");
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
    const username = create('a', ['post-username']);
    const image = create('img', ['post-image']);

    const main = create('div', ['post-main']);
    const content = create('div', ['post-content']);
    const extra = create('div', ['post-extra']);
    const signature = create('div', ['post-signature']);
    const likes = create('div', ['post-likes']);

    username.textContent = data.authorName;
    username.href = '/user.php?username=' + data.authorName;
    console.log(`/assets/img/users/${data.authorId}.png`)
    image.src = `/assets/img/users/${data.authorId}.png`;
    image.alt = 'pfp123';
    signature.textContent = data?.signature;

    content.textContent = data.content;

    li.appendChild(append(post, [
        append(user, [username, image]),
        append(main, [content, append(extra, [signature, likes])])
    ]))
    return li;
}, [{
    'thread_id': threadId
}]);

console.log("holiii");
const popupButton = document.getElementById('pagination-page-control-button');
const popup = document.getElementById('popup');
const closeButton = document.getElementById('popup-button-cancel');
const sendBtn = document.getElementById('popup-button-send');
const replyTextarea = document.getElementById('replyTextarea');

popupButton.addEventListener('click', function() {
    popup.classList.add('active')
});
closeButton.addEventListener('click', event => {
    event.preventDefault();
    popup.classList.remove('active');
});
replyTextarea.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendBtn.click();
        popup.classList.add('active');
    }
});