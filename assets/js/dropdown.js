const ddb = document.querySelector('button.mobile-dropdown-button');
const dd = document.querySelector('.mobile-dropdown');
dd.dataset.state = 'open';
function dropdown(event) {
    function toggleState(state) {
        return state === 'open' ? 'close' : 'open'; 
    }
    const animationOptions = {
        duration: 400,
        easing: 'ease-in-out',
        iterations: 1,
        fill: 'forwards'
    };
    const keyframes = {
        'open': {
            transform: 'translateY(100%)'
        },
        'close': {
            transform: 'translateY(-100%)'
        }
    }
    window.scrollTo(0, 0);
    const animation = keyframes[dd.dataset.state];
    dd.dataset.state = toggleState(dd.dataset.state); 
    dd.animate(animation, animationOptions).addEventListener('finish', async () => {
        console.log('hi')
        window.scrollTo(0, 0);
        document.body.style.overflow = 
        dd.dataset.state !== 'open' ? 'hidden' : '';
    })
}
ddb.addEventListener('click', dropdown);
const ddcb = document
    .querySelector('.m-close-btn')
ddcb.addEventListener('click', dropdown);
dd.addEventListener('animationend', () => {
    console.log(123)
})