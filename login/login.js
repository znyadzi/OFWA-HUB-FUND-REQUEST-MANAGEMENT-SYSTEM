// Form Validation and AJAX submit
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const serverError = document.getElementById("serverError");
  const submitButton = form.querySelector('button[type="submit"]');

  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    serverError.classList.add("hidden");
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

    if (!valid) return;

    // Prepare UI
    const originalButtonHtml = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML =
      '<div class="flex items-center justify-center"><div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>Signing in...</div>';

    try {
      const formData = new FormData(form);
      // POST to backend.php (relative)
      const resp = await fetch(form.action || "backend.php", {
        method: "POST",
        body: formData,
        credentials: "same-origin",
        headers: {
          // Don't set Content-Type here when using FormData
          Accept: "application/json",
        },
      });

      let data;
      try {
        data = await resp.json();
      } catch (err) {
        throw new Error("Invalid server response");
      }

      if (resp.ok && data && data.ok) {
        // On success: store minimal message and redirect up one level.
        // Assumption: after successful login the app has a protected page at the parent path.
        // You can change the redirect target to your real post-login page.
        window.location.href = "../";
        return;
      } else {
        const msg = (data && data.error) || (data && data.message) || "Login failed";
        serverError.textContent = msg;
        serverError.classList.remove("hidden");
      }
    } catch (err) {
      serverError.textContent = err.message || "Network error";
      serverError.classList.remove("hidden");
    } finally {
      submitButton.disabled = false;
      submitButton.innerHTML = originalButtonHtml;
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