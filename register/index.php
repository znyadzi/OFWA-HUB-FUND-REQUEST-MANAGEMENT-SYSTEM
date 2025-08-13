<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Team Login</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: "#4f46e5", secondary: "#6366f1" },
            borderRadius: {
              none: "0px",
              sm: "4px",
              DEFAULT: "8px",
              md: "12px",
              lg: "16px",
              xl: "20px",
              "2xl": "24px",
              "3xl": "32px",
              full: "9999px",
              button: "8px",
            },
          },
        },
      };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    />
    <link rel="stylesheet" href="login.css" />
  </head>
  <body class="min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <center><img src="../Images/OFWA_New_Logo_Resized.png" alt="OFWA Logo" class="h-10 md:h-12 mb-2"></center>
        <h2 class="text-xl font-semibold text-gray-800">Welcome !!!</h2>
        <p class="text-gray-500 mt-1">Request for an account here</p>
      </div>

      <div class="bg-white rounded-lg shadow-lg p-8">
        <form id="registrationForm">
          <!-- Full Name -->
          <div class="mb-5">
            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-user-line text-gray-400"></i>
              </div>
              <input
                type="text"
                id="fullName"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="John Doe"
                required
              />
            </div>
            <div id="fullNameError" class="text-red-500 text-xs mt-1 hidden">Please enter your full name</div>
          </div>

          <!-- Email -->
          <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-mail-line text-gray-400"></i>
              </div>
              <input
                type="email"
                id="email"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="name@company.com"
                required
              />
            </div>
            <div id="emailError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid email address</div>
          </div>

          <!-- Phone Number -->
          <div class="mb-5">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-phone-line text-gray-400"></i>
              </div>
              <input
                type="tel"
                id="phone"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="+1 (555) 123-4567"
                required
              />
            </div>
            <div id="phoneError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid phone number</div>
          </div>

          <!-- Role -->
          <div class="mb-5">
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-briefcase-line text-gray-400"></i>
              </div>
              <select
                id="role"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary appearance-none bg-white"
                required
              >
                <option value="" disabled selected>Select your role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="coordinator">Coordinator</option>
                <option value="volunteer">Volunteer</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="ri-arrow-down-s-line text-gray-400"></i>
              </div>
            </div>
          </div>

          <!-- Hub Name -->
          <div class="mb-5">
            <label for="hubName" class="block text-sm font-medium text-gray-700 mb-1">Hub Name</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-building-line text-gray-400"></i>
              </div>
              <input
                type="text"
                id="hubName"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="Main Hub"
                required
              />
            </div>
          </div>

          <!-- Hub Location -->
          <div class="mb-5">
            <label for="hubLocation" class="block text-sm font-medium text-gray-700 mb-1">Hub Location</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-map-pin-line text-gray-400"></i>
              </div>
              <input
                type="text"
                id="hubLocation"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="City, State"
                required
              />
            </div>
          </div>

          <!-- Username -->
          <div class="mb-5">
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-user-3-line text-gray-400"></i>
              </div>
              <input
                type="text"
                id="username"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="johndoe123"
                required
              />
            </div>
            <div id="usernameError" class="text-red-500 text-xs mt-1 hidden">Username must be at least 4 characters</div>
          </div>

          <!-- Password -->
          <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full">
                <i class="ri-lock-line text-gray-400"></i>
              </div>
              <input
                type="password"
                id="password"
                class="form-input w-full pl-10 pr-10 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="••••••••"
                required
              />
              <button
                type="button"
                id="togglePassword"
                class="absolute inset-y-0 right-0 flex items-center pr-3 w-10 h-full !rounded-button"
              >
                <i class="ri-eye-off-line text-gray-400" id="passwordIcon"></i>
              </button>
            </div>
            <div id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least 8 characters</div>
          </div>

          <!-- Reason for Application -->
          <div class="mb-6">
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Application</label>
            <div class="relative">
              <textarea
                id="reason"
                rows="3"
                class="form-input w-full px-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="Explain why you're applying..."
                required
              ></textarea>
            </div>
          </div>

          <!-- Terms and Conditions -->
          <div class="flex items-center mb-6">
            <input type="checkbox" id="terms" class="hidden" required />
            <div id="termsCheckbox" class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center mr-2 cursor-pointer" >
              <div class="w-2 h-2 bg-primary rounded-sm hidden" id="termsCheckmark"></div>
            </div>
            <label for="terms" class="text-sm text-gray-600 cursor-pointer">
              I agree to the <a href="#" class="text-primary hover:text-primary/80">Terms and Conditions</a>
            </label>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="w-full bg-primary text-white py-2.5 px-4 !rounded-button font-medium hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 whitespace-nowrap" >
            Register
          </button>
        </form>
      </div>

      <div class="text-center mt-6">
        <p class="text-sm text-gray-600">
          Already have an account?
          <a href="#" class="font-medium text-primary hover:text-primary/80"
            >Sign in</a
          >
        </p>
        <div class="mt-4 text-xs text-gray-500">
          <a href="#" class="hover:text-gray-700">Privacy Policy</a>
          <span class="mx-2">•</span>
          <a href="#" class="hover:text-gray-700">Terms of Service</a>
        </div>
      </div>
    </div>

    <script src="login.js"></script>
  </body>
</html>