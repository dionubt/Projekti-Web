// Login Page Logic
const signupLink = document.getElementById('signup-link');
const signupModal = document.getElementById('signup-modal');
const closeModal = document.getElementById('close-modal');

if (signupLink && signupModal && closeModal) {
    signupLink.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default anchor behavior
        signupModal.style.display = 'flex';
    });

    closeModal.addEventListener('click', () => {
        signupModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === signupModal) {
            signupModal.style.display = 'none';
        }
    });
}

// Sign-Up Page Logic
const signupForm = document.querySelector('.auth-form');
if (signupForm) {
    signupForm.addEventListener('submit', function (event) {
        const username = document.querySelector('input[type="text"]').value.trim();
        const email = document.querySelector('input[type="email"]').value.trim();
        const password = document.querySelector('input[type="password"]').value.trim();

        if (!username || !email || !password) {
            event.preventDefault(); // Prevent form submission
            alert('All fields are required!');
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            event.preventDefault();
            alert('Please enter a valid email address.');
        }
    });
}
