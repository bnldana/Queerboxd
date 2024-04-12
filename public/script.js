document.addEventListener('DOMContentLoaded', function() {
    var releaseDateInput = document.getElementById('release_date');
    releaseDateInput.addEventListener('input', function(e) {
        var value = e.target.value;
        value = value.replace(/\D/g, '');
        if (value.length > 4) {
            value = value.slice(0, 4);
        }
        e.target.value = value;
    });
    
    releaseDateInput.max = new Date().getFullYear().toString();

    var showAllRatingsButton = document.getElementById('showAllRatings');
    showAllRatingsButton.addEventListener('click', function() {
        var allRatings = document.getElementById('allRatings');
        allRatings.style.display = 'block'; 
        allRatings.classList.add('d-flex', 'flex-column', 'align-items-start', 'w-100');
        this.style.display = 'none';
    });
});
