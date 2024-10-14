// Get elements
const loginBtn = document.getElementById('loginBtn');
const loginModal = document.getElementById('loginModal');
const closeLogin = document.getElementById('closeLogin');

const signupLink = document.getElementById('signupLink');
const signupModal = document.getElementById('signupModal');
const closeSignup = document.getElementById('closeSignup');

const loginLink = document.getElementById('loginLink');

// Open login modal
loginBtn.onclick = function() {
  loginModal.style.display = 'flex';
}

// Close login modal
closeLogin.onclick = function() {
  loginModal.style.display = 'none';
}

// Open signup modal from login modal
signupLink.onclick = function() {
  loginModal.style.display = 'none';
  signupModal.style.display = 'flex';
}

// Open login modal from signup modal
loginLink.onclick = function() {
  signupModal.style.display = 'none';
  loginModal.style.display = 'flex';
}

// Close signup modal
closeSignup.onclick = function() {
  signupModal.style.display = 'none';
}

// Close modals when clicking outside
window.onclick = function(event) {
  if (event.target === loginModal) {
    loginModal.style.display = 'none';
  }
  if (event.target === signupModal) {
    signupModal.style.display = 'none';
  }
}
