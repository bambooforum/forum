
const closeButtons = document.querySelectorAll(".banner .banner-x");
closeButtons.forEach(button => {
    button.addEventListener("click", function() {
        const banner = this.closest(".banner");
        if (banner) {
            banner.remove();
        }
    });
});
