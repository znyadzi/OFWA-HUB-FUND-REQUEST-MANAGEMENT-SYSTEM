// Form Validation
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let valid = true;
    
    // Email validation
    if (!validateEmail(emailInput.value)) {
      emailError.classList.remove("hidden");
      valid = false;
    } else {
      emailError.classList.add("hidden");
    }
    
    // Password validation
    if (passwordInput.value.length < 6) {
      passwordError.classList.remove("hidden");
      valid = false;
    } else {
      passwordError.classList.add("hidden");
    }
    
    if (valid) {
      // Simulate login - in a real app, this would be an API call
      const submitButton = form.querySelector('button[type="submit"]');
      submitButton.innerHTML =
        '<div class="flex items-center justify-center"><div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>Signing in...</div>';

      setTimeout(() => {
        alert("Login successful!");
        submitButton.innerHTML = "Sign in";
      }, 1500);
    }
  });

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

// Custom Checkbox Handler
document.addEventListener("DOMContentLoaded", function () {
  const checkbox = document.getElementById("remember");
  const customCheckbox = document.getElementById("customCheckbox");
  const checkmark = document.getElementById("checkmark");
  
  customCheckbox.addEventListener("click", function () {
    checkbox.checked = !checkbox.checked;
    if (checkbox.checked) {
      checkmark.classList.remove("hidden");
      customCheckbox.classList.add("bg-primary/10", "border-primary");
    } else {
      checkmark.classList.add("hidden");
      customCheckbox.classList.remove("bg-primary/10", "border-primary");
    }
  });
});

function toggleCheckbox() {
  const checkbox = document.getElementById('termsCheckbox');
  const checkmark = document.getElementById('termsCheckmark');
  const hiddenCheckbox = document.getElementById('terms');
  
  const isChecked = checkbox.getAttribute('data-checked') === 'true';
  
  if (isChecked) {
    checkbox.setAttribute('data-checked', 'false');
    checkmark.classList.add('hidden');
    hiddenCheckbox.checked = false;
  } else {
    checkbox.setAttribute('data-checked', 'true');
    checkmark.classList.remove('hidden');
    hiddenCheckbox.checked = true;
  }
}