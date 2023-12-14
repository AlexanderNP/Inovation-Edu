document.querySelectorAll('.testQuestion input[type="checkbox"]').
forEach(checkbox => {
    checkbox.addEventListener('change', function(e) {
        if (this.checked) {
            let parentDiv = this.closest('.testQuestion');
            parentDiv.querySelectorAll('input[type="checkbox"]:checked').forEach(otherCheckbox => {
                if (otherCheckbox !== this) {
                    otherCheckbox.checked = false;
                }
            });
        }
    });
});