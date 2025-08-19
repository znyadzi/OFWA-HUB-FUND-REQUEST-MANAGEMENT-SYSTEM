// Custom Checkbox Handler
document.addEventListener("DOMContentLoaded", function () {
  // Handle Terms checkbox
  const termsCheckbox = document.getElementById("terms");
  const customTermsCheckbox = document.getElementById("termsCheckbox");
  const termsCheckmark = document.getElementById("termsCheckmark");
  
  if (customTermsCheckbox) {
    customTermsCheckbox.addEventListener("click", function () {
      termsCheckbox.checked = !termsCheckbox.checked;
      updateCheckboxVisuals(termsCheckbox, termsCheckmark, customTermsCheckbox);
    });
  }

  // Terms Modal elements
  const termsModal = document.getElementById("termsModal");
  const closeTermsModal = document.getElementById("closeTermsModal");
  
  if (closeTermsModal) {
    closeTermsModal.addEventListener("click", function() {
      termsModal.classList.add("hidden");
    });
  }

  // Shared function to update checkbox visuals
  function updateCheckboxVisuals(checkbox, checkmark, customCheckbox) {
    if (checkbox.checked) {
      checkmark.classList.remove("hidden");
      customCheckbox.classList.add("bg-primary/10", "border-primary");
    } else {
      checkmark.classList.add("hidden");
      customCheckbox.classList.remove("bg-primary/10", "border-primary");
    }
  }

  // Form Validation
  const form = document.getElementById("registrationForm");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      let valid = true;
      
      // Validate all required fields
      const requiredFields = [
        'fullName', 'email', 'phone', 'role', 
        'hubName', 'hubLocation', 'username', 
        'password', 'reason'
      ];
      
      requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(`${fieldId}Error`);
        
        if (field && errorElement) {
          if (!field.value.trim()) {
            errorElement.classList.remove("hidden");
            errorElement.textContent = `Please enter your ${field.placeholder || fieldId}`;
            valid = false;
          } else {
            errorElement.classList.add("hidden");
          }
        }
      });

      // Special validations
      // Email validation
      const emailInput = document.getElementById("email");
      const emailError = document.getElementById("emailError");
      if (emailInput && emailError) {
        if (!validateEmail(emailInput.value)) {
          emailError.classList.remove("hidden");
          emailError.textContent = "Please enter a valid email address";
          valid = false;
        } else {
          emailError.classList.add("hidden");
        }
      }
      
      // Password validation
      const passwordInput = document.getElementById("password");
      const passwordError = document.getElementById("passwordError");
      if (passwordInput && passwordError) {
        if (passwordInput.value.length < 8) {
          passwordError.classList.remove("hidden");
          passwordError.textContent = "Password must be at least 8 characters";
          valid = false;
        } else {
          passwordError.classList.add("hidden");
        }
      }
      
      // Terms checkbox validation
      if (termsCheckbox && !termsCheckbox.checked) {
        termsModal.classList.remove("hidden");
        valid = false;
      }
      
      if (valid) {
        // Show loading state
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML =
          '<div class="flex items-center justify-center"><div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>Registering...</div>';
        
        // In a real app, this would be your form submission to PHP
        console.log("Form would submit now");
        // form.submit();
        
        // Simulate submission (remove in production)
        setTimeout(() => {
          alert("Registration successful!");
          submitButton.innerHTML = "Register";
          submitButton.disabled = false;
        }, 1500);
      }
    });
  }

  function validateEmail(email) {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }
});

// Password Toggle
document.addEventListener("DOMContentLoaded", function () {
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("password");
  const passwordIcon = document.getElementById("passwordIcon");
  
  togglePassword.addEventListener("click", function () {
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    if (type === "text") {
      passwordIcon.classList.remove("ri-eye-off-line");
      passwordIcon.classList.add("ri-eye-line");
    } else {
      passwordIcon.classList.remove("ri-eye-line");
      passwordIcon.classList.add("ri-eye-off-line");
    }
  });
});

// Minimal client-side validation + fetch submit for registration form
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registerForm');
  if (!form) return;

  const emailInput = form.querySelector('[name="email"]');
  const passwordInput = form.querySelector('[name="password"]');
  const usernameInput = form.querySelector('[name="username"]');
  const fullNameInput = form.querySelector('[name="full_name"]');
  const serverError = document.getElementById('serverError') || createServerError();
  const submitBtn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    serverError.classList.add('hidden');
    let errors = [];

    if (!fullNameInput || fullNameInput.value.trim() === '') errors.push('Full name is required');
    if (!emailInput || !validateEmail(emailInput.value)) errors.push('Valid email is required');
    if (!usernameInput || usernameInput.value.trim().length < 3) errors.push('Username must be at least 3 characters');
    if (!passwordInput || passwordInput.value.length < 6) errors.push('Password must be at least 6 characters');

    if (errors.length) {
      serverError.textContent = errors.join('; ');
      serverError.classList.remove('hidden');
      return;
    }

    // Prepare UI
    const originalHtml = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="loading">Registering...</span>';

    try {
      const fd = new FormData(form);
      const resp = await fetch(form.action || 'backend.php', {
        method: 'POST',
        body: fd,
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json' },
      });

      let data;
      try {
        data = await resp.json();
      } catch (err) {
        throw new Error('Invalid server response');
      }

      if (resp.ok && data && data.ok) {
        // Redirect to login page or show a success UI
        // Change target as needed
        window.location.href = '../login/';
        return;
      } else {
        const msg = (data && (data.error || data.message)) || 'Registration failed';
        serverError.textContent = msg;
        serverError.classList.remove('hidden');
      }
    } catch (err) {
      serverError.textContent = err.message || 'Network error';
      serverError.classList.remove('hidden');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalHtml;
    }
  });

  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email || '').toLowerCase());
  }

  function createServerError() {
    const div = document.createElement('div');
    div.id = 'serverError';
    div.className = 'text-red-600 text-sm mt-2';
    form.prepend(div);
    div.classList.add('hidden');
    return div;
  }
});