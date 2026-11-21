document.addEventListener('DOMContentLoaded', function() {
    const menuOpen = document.getElementById('menuOpen');
    const menuClose = document.getElementById('menuClose');
    const fash_flexbox = document.querySelector('.fash_flexbox');

    if (!menuOpen || !menuClose || !fash_flexbox) return;

    menuOpen.addEventListener('click', function(e) {
        e.stopPropagation();
        fash_flexbox.classList.add('show');
    });

    menuClose.addEventListener('click', function() {
        fash_flexbox.classList.remove('show');
    });

    document.addEventListener('click', function(e) {
        if (
            fash_flexbox.classList.contains('show') &&
            !fash_flexbox.contains(e.target) &&
            !menuOpen.contains(e.target)
        ) {
            fash_flexbox.classList.remove('show');
        }
    });
});