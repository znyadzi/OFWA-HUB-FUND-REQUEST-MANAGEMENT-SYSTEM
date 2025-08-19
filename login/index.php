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
        <center><img src="../media/ofwaLogo.png" alt="OFWA Logo" class="h-10 md:h-20 mb-2"></center>
        <h2 class="text-xl font-semibold text-gray-800">Welcome back</h2>
        <p class="text-gray-500 mt-1">Sign in to access your team workspace</p>
      </div>

      <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- Form posts to backend.php (JS will intercept and POST via fetch) -->
        <form id="loginForm" method="post" action="backend.php" novalidate>
          <div class="mb-5">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-1"
              >Email address</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full"
              >
                <i class="ri-mail-line text-gray-400"></i>
              </div>
              <input
                type="email"
                id="email"
                name="email"
                class="form-input w-full pl-10 pr-3 py-2 border border-gray-300 rounded text-gray-700 focus:ring-primary focus:border-primary"
                placeholder="name@company.com"
                required
              />
            </div>
            <div id="emailError" class="text-red-500 text-xs mt-1 hidden">
              Please enter a valid email address
            </div>
          </div>
          <div class="mb-5">
            <div class="flex justify-between mb-1">
              <label
                for="password"
                class="block text-sm font-medium text-gray-700"
                >Password</label
              >
            </div>
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none w-10 h-full"
              >
                <i class="ri-lock-line text-gray-400"></i>
              </div>
              <input
                type="password"
                id="password"
                name="password"
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
            <div id="passwordError" class="text-red-500 text-xs mt-1 hidden">
              Password must be at least 6 characters
            </div>
          </div>

          <div id="serverError" class="text-red-500 text-xs mt-1 hidden"></div>

          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
              <input type="checkbox" id="remember" name="remember" value="1" class="hidden" />
              <div
                id="customCheckbox"
                class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center mr-2 cursor-pointer"
              >
                <div
                  class="w-2 h-2 bg-primary rounded-sm hidden"
                  id="checkmark"
                ></div>
              </div>
              <label for="remember" class="text-sm text-gray-600 cursor-pointer"
                >Remember me</label
              >
            </div>
            <a
              href="#"
              class="text-sm font-medium text-primary hover:text-primary/80 whitespace-nowrap"
              >Forgot password?</a
            >
          </div>

          <button
            type="submit"
            class="w-full bg-primary text-white py-2.5 px-4 !rounded-button font-medium hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 whitespace-nowrap"
          >
            Sign in
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-200">
          <div class="text-center mb-4">
            <span class="text-sm text-gray-500">Or continue with</span>
          </div>

          <div class="grid grid-cols-3 gap-3">
            <button
              class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded !rounded-button hover:bg-gray-50 whitespace-nowrap"
            >
              <div class="w-5 h-5 flex items-center justify-center mr-2">
                <i class="ri-google-fill text-[#EA4335]"></i>
              </div>
              <span class="text-sm text-gray-700">Google</span>
            </button>
            <button
              class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded !rounded-button hover:bg-gray-50 whitespace-nowrap"
            >
              <div class="w-5 h-5 flex items-center justify-center mr-2">
                <i class="ri-apple-fill text-black"></i>
              </div>
              <span class="text-sm text-gray-700">Apple</span>
            </button>
            <button
              class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded !rounded-button hover:bg-gray-50 whitespace-nowrap"
            >
              <div class="w-5 h-5 flex items-center justify-center mr-2">
                <i class="ri-github-fill text-black"></i>
              </div>
              <span class="text-sm text-gray-700">GitHub</span>
            </button>
          </div>
        </div>
      </div>

      <div class="text-center mt-6">
        <p class="text-sm text-gray-600">
          Don't have an account?
          <a href="#" class="font-medium text-primary hover:text-primary/80"
            >Sign up</a
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