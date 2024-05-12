document.addEventListener('DOMContentLoaded', function() {
    const settingsForm = document.querySelector('.settings form');
    settingsForm.addEventListener('submit', function(event) {
        const emailField = document.querySelector('input[name="email"]');
        const fnameField = document.querySelector('input[name="fname"]');
        const lnameField = document.querySelector('input[name="lname"]');

        // Simple validation for email
        if (!emailField.value.includes('@')) {
            alert("Please enter a valid email address.");
            event.preventDefault(); // Stop form submission
            return false;
        }

        // Check if first name and last name are entered
        if (!fnameField.value.trim() || !lnameField.value.trim()) {
            alert("Please enter both first and last name.");
            event.preventDefault(); // Stop form submission
            return false;
        }

        // Optionally handle image validation or other fields if necessary
    });
});
