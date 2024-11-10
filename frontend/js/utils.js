

export function togglePasswordVisibility(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
  
    if (passwordInput && toggleIcon) {  // Check if both elements exist
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    } else {
      console.error(`Element with id "${inputId}" or "${iconId}" not found.`);
    }
  }
  