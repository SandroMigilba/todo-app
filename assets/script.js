function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    sidebar.classList.toggle('hidden');
    content.classList.toggle('expanded');
}