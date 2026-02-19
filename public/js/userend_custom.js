/*------------- Get references to mobile navigation elements ------------*/
const mobileToggleBtn = document.getElementById('mobileToggleBtn');
const mobileNavOverlay = document.getElementById('mobileNavOverlay');

/*------------- Event listener for mobile toggle button ------------*/
mobileToggleBtn.addEventListener('click', toggleMobileNav);

function toggleMobileNav() {
    mobileToggleBtn.classList.toggle('active');
    mobileNavOverlay.classList.toggle('active');
    document.body.classList.toggle('no-scroll', mobileNavOverlay.classList.contains('active'));
}