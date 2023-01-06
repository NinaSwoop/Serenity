let showMoreButton = document.getElementById('show-more-schemas');
showMoreButton.addEventListener('click', function() {
    let schemas = document.querySelectorAll('.schema-card');
    schemas.forEach(function(schema) {
        schema.classList.remove('d-none');
    })
    showMoreButton.style.display = 'none';
});
