document.addEventListener("DOMContentLoaded", function () {
    // Initialize password toggles
    initPasswordToggles();

    // Initialize form validation
    // const forms = document.querySelectorAll(".auth__form");
    // forms.forEach((form) => {
    //     form.addEventListener("submit", handleFormSubmit);
    // });

    // Add input event listeners
    // const inputs = document.querySelectorAll(".form__input-wrapper input");
    // inputs.forEach((input) => {
    //     input.addEventListener("input", () => validateInput(input));
    //     input.addEventListener("blur", () => validateInput(input));
    // });
});

// Password toggle functionality
function initPasswordToggles() {
    const toggleButtons = document.querySelectorAll(".form__toggle-password");

    toggleButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const input = this.parentElement.querySelector("input");
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");
            } else {
                input.type = "password";
                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");
            }
        });
    });
}

// Input validation
// function validateInput(input) {
//     const wrapper = input.closest(".form__input-wrapper");
//     const errorSpan = wrapper.nextElementSibling;
//     let errorMessage = "";

//     wrapper.classList.remove("error");

//     switch (input.type) {
//         case "email":
//             if (!input.value) {
//                 errorMessage = "Email is required";
//             } else if (!isValidEmail(input.value)) {
//                 errorMessage = "Please enter a valid email address";
//             }
//             break;

//         case "password":
//             if (!input.value) {
//                 errorMessage = "Password is required";
//             } else if (input.value.length < 8) {
//                 errorMessage = "Password must be at least 8 characters";
//             }
//             break;

//         case "text":
//             if (!input.value) {
//                 errorMessage = `${
//                     input.name.charAt(0).toUpperCase() + input.name.slice(1)
//                 } is required`;
//             }
//             break;
//     }

//     if (input.id === "password_confirmation") {
//         const password = document.getElementById("password");
//         if (input.value !== password.value) {
//             errorMessage = "Passwords do not match";
//         }
//     }

//     if (errorMessage) {
//         wrapper.classList.add("error");
//         if (errorSpan) {
//             errorSpan.innerHTML = `<i class='bx bx-error-circle'></i>${errorMessage}`;
//             errorSpan.style.display = "flex";
//         }
//         return false;
//     }

//     if (errorSpan) {
//         errorSpan.style.display = "none";
//     }
//     return true;
// }

// Email validation helper
// function isValidEmail(email) {
//     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
// }

// Form submission handler
// function handleFormSubmit(e) {
//     e.preventDefault();

//     const form = e.target;
//     const inputs = form.querySelectorAll('input:not([type="checkbox"])');
//     let isValid = true;

//     inputs.forEach((input) => {
//         if (!validateInput(input)) {
//             isValid = false;
//         }
//     });

//     const termsCheckbox = form.querySelector('input[name="terms"]');
//     if (termsCheckbox && !termsCheckbox.checked) {
//         const termsWrapper = termsCheckbox.closest(".form__terms");
//         termsWrapper.classList.add("error");
//         const errorSpan = termsWrapper.querySelector(".form__error");
//         if (errorSpan) {
//             errorSpan.innerHTML = `<i class='bx bx-error-circle'></i>You must accept the Terms & Conditions`;
//             errorSpan.style.display = "flex";
//         }
//         isValid = false;
//     }

//     if (isValid) {
//         const submitButton = form.querySelector('button[type="submit"]');
//         const originalText = submitButton.innerHTML;

//         submitButton.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i>Processing...`;
//         submitButton.disabled = true;

//         // Simulate form submission
//         setTimeout(() => {
//             form.submit();
//         }, 1000);
//     }
// }
