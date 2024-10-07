document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const filtreList = document.getElementsByClassName('liste-filtre');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedItems = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            const uncheckedItems = Array.from(checkboxes).filter(checkbox => !checkbox.checked);

            const sortedCategories = [...checkedItems, ...uncheckedItems].map(checkbox => {
                return checkbox.closest('.category-item');
            });

            filtreList.innerHTML = '';

            sortedCategories.forEach(item => {
                filtreList.appendChild(item);
            });
        });
    });
});