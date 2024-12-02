document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById('sidebar');
    const menuTextElements = document.querySelectorAll('.menu-text');
    const menuItem = document.getElementById('menuItem');

    function toggleSidebar() {
        if (sidebar.style.width === '250px' || sidebar.style.width === '') {
            sidebar.style.width = '76px';
            menuTextElements.forEach(text => text.style.display = 'none');
        } else {
            sidebar.style.width = '250px';
            menuTextElements.forEach(text => text.style.display = 'inline');
        }
    }

    menuItem.addEventListener('click', toggleSidebar);
});
