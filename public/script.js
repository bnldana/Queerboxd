
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('release_date').addEventListener('input', function(e) {
        var value = e.target.value;
        if (value.length > 4) {
            e.target.value = value.slice(0, 4);
        }
        e.target.value = e.target.value.replace(/\D/g, '');
    });
    
    document.getElementById('release_date').max = new Date().getFullYear();

    document.getElementById('showAllRatings').addEventListener('click', function() {
        document.getElementById('allRatings').style.display = 'block';
        this.style.display = 'none';
    });
});