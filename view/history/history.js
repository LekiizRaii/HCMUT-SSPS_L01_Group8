document.addEventListener('DOMContentLoaded', function() {
    const seeMoreBtn = document.getElementById('seeMoreBtn');
    const items = document.querySelectorAll('.item');

    // Initial number of items to display
    let visibleItemCount = 4;

    // Show/hide items based on the current state
    function toggleItems() {
        items.forEach((item, index) => {
            if (index < visibleItemCount) {
                item.classList.remove('hidden');
            }
        });

        // Toggle the "See More" button based on the number of hidden items
        seeMoreBtn.style.display = (visibleItemCount < items.length) ? 'block' : 'none';
    }

    // Event listener for the "See More" button
    var idRole = localStorage.getItem("idRole");
        seeMoreBtn.addEventListener('click', function() {
            visibleItemCount += 10; // Increase the number of visible items
            toggleItems(); // Show/hide items
        });

    // Initial setup
    toggleItems();
});
