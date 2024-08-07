document.addEventListener('DOMContentLoaded', () => {
    const themeButton = document.getElementById('themeButton'); 
    const currentTheme = localStorage.getItem('theme') || 'light';

    function toggleDarkTheme(isDark) {
        document.body.classList.toggle('dark-theme', isDark);
        document.querySelectorAll('header').forEach(header => header.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.navbar').forEach(navbar => navbar.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#searchButton').forEach(button => button.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.selected').forEach(selected => selected.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('a').forEach(a => a.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('a:hover').forEach(a => a.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('button').forEach(button => button.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.card').forEach(card => card.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.content').forEach(content => content.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.logoutBTN').forEach(button => button.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('footer').forEach(footer => footer.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('h1, h2, h3, h4').forEach(heading => heading.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.formContainer').forEach(container => container.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.socials').forEach(social => social.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.table').forEach(table => table.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.table a').forEach(a => a.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('footer .table th').forEach(th => th.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('footer .help a').forEach(a => a.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.main-section').forEach(section => section.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.filter').forEach(filter => filter.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.formGroup label').forEach(label => label.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.product-container').forEach(container => container.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('button').forEach(button => button.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.formContainer .btn').forEach(btn => btn.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#themeButton').forEach(themeButton => themeButton.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#archiveButton').forEach(archiveButton => archiveButton.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.errorMessage').forEach(errorMessage => errorMessage.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.cartTitle').forEach(cartTitle => cartTitle.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#cart-items').forEach(cartItems => cartItems.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.userContent').forEach(userContent => userContent.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.address-details').forEach(addressDetails => addressDetails.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.card-details').forEach(cardDetails => cardDetails.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#applyCoupon').forEach(applyCoupon => applyCoupon.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.container').forEach(container => container.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.forumPostandFilters').forEach(forumPostandFilters => forumPostandFilters.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.user_input_container').forEach(userInputContainer => userInputContainer.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.search_engine').forEach(searchEngine => searchEngine.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.table-container').forEach(tableContainer => tableContainer.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.post').forEach(post => post.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.post-content').forEach(postContent => postContent.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('.post-details').forEach(postDetails => postDetails.classList.toggle('dark-theme', isDark));
        document.querySelectorAll('#filterForm').forEach(filterForm => filterForm.classList.toggle('dark-theme', isDark));

        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    toggleDarkTheme(currentTheme === 'dark');

    themeButton.addEventListener('click', () => {
        const isDark = document.body.classList.toggle('dark-theme');
        toggleDarkTheme(isDark);
    });
});