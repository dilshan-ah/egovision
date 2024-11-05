<style>
body {
    transition: background-color 0.3s ease, color 0.3s ease;
    background-color: white; /* Light mode background */
    color: black; /* Light mode text color */
}
/* Navbar Styles */
.navbar {
    background-color: white; /* Light mode navbar background */
    color: black; /* Light mode navbar text color */
}

.navbar a {
    color: black; /* Light mode navbar link color */
}

/* Card Styles */
.card {
    background-color: white; /* Light mode card background */
    border: 1px solid #ccc; /* Light mode card border */
    transition: background-color 0.3s ease, color 0.3s ease;
}

.card-body {
    background-color: #f8f9fa; /* Light mode card body background */
    color: black; /* Light mode card body text color */
}

/* Footer Styles */
footer {
    background-color: #f8f9fa; /* Light mode footer background */
    color: black; /* Light mode footer text color */
}

/* Input Fields */
input[type="text"],
input[type="email"],
input[type="password"],
select,
textarea {
    background-color: white; /* Light mode input background */
    color: black; /* Light mode input text color */
    border: 1px solid #ccc; /* Light mode input border */
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus,
textarea:focus {
    border-color: #007bff; /* Light mode focus border color */
}

/* Dark Mode Styles */
.dark-mode body {
    background-color: black; /* Dark mode background */
    color: #d8dbe0; /* Dark mode text color */
}
.dark-mode .collectionMode {
    background-color: black; /* Dark mode background */
    color: #d8dbe0; /* Dark mode text color */
}
.dark-mode .colorMode {
    background-color: black; /* Dark mode background */
    color: #d8dbe0; /* Dark mode text color */
}
.dark-mode .duationMode {
    color: white; /* Dark mode text color */
    background-color: black; /* Dark mode background */

}
.dark-mode .abouMode {
    color: white; /* Dark mode text color */
    background-color: black; /* Dark mode background */
}
.dark-mode .mega-box {
    background-color: black; /* Dark mode navbar background */
    color:white;
}

.dark-mode .navbar a {
    color: white; 
}
.dark-mode .card {
    background-color: #444; /* Dark mode card background */
    border: 1px solid #555; /* Dark mode card border */
}

.dark-mode .card-body {
    background-color: #555; /* Dark mode card body background */
    color: #d8dbe0; /* Dark mode card body text color */
}

.dark-mode .second_header_background {
    background-color:#d8dbe0; /* Dark mode footer background */
    top:20px;
}

.dark-mode .add-to-cart-button {
   border:1px solid white;
}

/* Input Fields in Dark Mode */
.dark-mode input[type="text"],
.dark-mode input[type="email"],
.dark-mode input[type="password"],
.dark-mode select,  
.dark-mode textarea {
    background-color: #444; /* Dark mode input background */
    color: #d8dbe0; /* Dark mode input text color */
    border: 1px solid #555; /* Dark mode input border */
}
.dark-mode input[type="text"]:focus,
.dark-mode input[type="email"]:focus,
.dark-mode input[type="password"]:focus,
.dark-mode select:focus,
.dark-mode textarea:focus {
    border-color: #007bff; /* Dark mode focus border color */
}
/* Additional Text Styles */
.dark-mode h1, 
.dark-mode h2, 
.dark-mode h3, 
.dark-mode h4, 
.dark-mode h5, 
.dark-mode h6,
.dark-mode .getoffer ,
.dark-mode .subsTitle ,
.dark-mode .policyTExt,
.dark-mode .followUs,
.dark-mode .fa-facebook-f,
.dark-mode .fa-instagram,
.dark-mode .fa-linkedin-in,
.dark-mode .fa-pinterest,
.dark-mode .fa-youtube,
.dark-mode .fa-tiktok,
.dark-mode .fa-twitter,
.dark-mode .acceptPay
{
    color: white; 
}
/* Toggle Button Styles */
.custom-toggle-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Space between toggle and mode text */
}

.custom-toggle-button {
    position: relative;
    width: 40px;  /* Width of the toggle switch */
    height: 20px; /* Height of the toggle switch */
    cursor: pointer; /* Change cursor to pointer on hover */
}

.custom-switch-label {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 10px; /* Rounded corners */
    background-color: #ccc; /* Light background */
    transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
}

.custom-switch-label:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Shadow effect on hover */
}

.custom-slider {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 16px;
    height: 16px;
    background-color: white;
    border-radius: 50%; /* Rounded slider */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-checkbox {
    display: none; /* Hide the default checkbox */
}

.custom-checkbox:checked ~ .custom-switch-label {
    background-color: #4caf50; /* Green background when toggled */
}

.custom-checkbox:checked ~ .custom-slider {
    transform: translateX(20px); /* Slide right when toggled */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
}

.custom-toggle-container i {
    font-size: 14px;
    color: #fff;
}

.custom-mode-text {
    color: white;
    margin-left: 10px; /* Adjust for alignment */
    font-size: 12px;
}

/* Dark Mode Footer Styles */
.dark-mode .footer {
    background-color: #1a1a1a;
    color: #d8dbe0;
}

@media (max-width: 991px) {
    .custom-typewriter-container {
        display: none; /* Hide link on mobile devices */
    }
}

.theme-toggle-container {
    display: flex;
    align-items: center;
}

.theme-toggle {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.custom-checkbox {
    display: none; /* Hide the checkbox */
}

.icon-text {
    display: flex;
    align-items: center;
    margin-left: 8px;
}

.theme-icon {
    font-size: 24px; /* Adjust icon size */
    display: none; /* Initially hide both icons */
}

.light-icon {
    display: block; /* Show the light icon by default */
}

.theme-text {
    margin-left: 4px; /* Space between icon and text */
}

/* Dark mode styles */
.dark-mode .light-icon {
    display: none; /* Hide light icon in dark mode */
}

.dark-mode .dark-icon {
    display: block; /* Show dark icon in dark mode */
}

.dark-mode .theme-text {
    display: none; /* Hide light text in dark mode */
}

.dark-mode .theme-text#modeTextDark {
    display: inline; /* Show dark text in dark mode */
}
</style>

    <div style="">
        <div class="container d-flex justify-content-between align-items-center p-1">
        <div class="theme-toggle-container">
    <label class="theme-toggle">
        <input type="checkbox" class="custom-checkbox">
        <div class="icon-text">
            <i class="fas fa-sun theme-icon light-icon" id="lightIcon"></i>
            <span class="theme-text" id="modeText">Light</span>
        </div>
        <div class="icon-text">
            <i class="fas fa-moon theme-icon dark-icon" id="darkIcon"></i>
            <span class="theme-text" id="modeTextDark">Dark</span>
        </div>
    </label>
</div>



            <!-- Typewriter Text -->
            <div class="custom-typewriter-container" style="height:30px">
                <div class="custom-typewriter-text" id="typewriter"></div>
            </div>

            @if (!Auth::check())
                <!-- User is not logged in: Show login/register link -->
                <a class="custom-icon-link" href="{{ route('ego.login') }}">
                    <img style="width:18px;height:18px" src="{{ asset('ego/white_account.svg') }}" alt="Account" />
                    Login/Register
                </a>
            @else
                <!-- User is logged in: Show user's name -->
                <a class="custom-icon-link" href="{{ route('user.home') }}">
                    <img style="width:18px;height:18px" src="{{ asset('ego/white_account.svg') }}" alt="Account" />
                    {{ Auth::user()->fullname }}
                </a>
            @endif
        </div>
    </div>


    <script>


// Dark mode toggle functionality with saved state
const toggleSwitch = document.querySelector('.custom-checkbox');
const lightIcon = document.getElementById('lightIcon');
const darkIcon = document.getElementById('darkIcon');
const modeText = document.getElementById('modeText');
const modeTextDark = document.getElementById('modeTextDark');

// Initialize dark mode based on local storage
if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark-mode');
    toggleSwitch.checked = true;
    modeText.style.display = 'none';
    modeTextDark.style.display = 'inline'; // Show dark mode text
    darkIcon.style.display = 'block';
} else {
    lightIcon.style.display = 'block';
}

// Event listener for toggle switch
toggleSwitch.addEventListener('change', () => {
    if (toggleSwitch.checked) {
        document.documentElement.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
        modeText.style.display = 'none';
        modeTextDark.style.display = 'inline'; // Show dark mode text
        darkIcon.style.display = 'block';
        lightIcon.style.display = 'none';
    } else {
        document.documentElement.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'disabled');
        modeText.style.display = 'inline'; // Show light mode text
        modeTextDark.style.display = 'none'; // Hide dark mode text
        darkIcon.style.display = 'none';
        lightIcon.style.display = 'block';
    }
});







        // Display text with fade in/out effect
        const texts = [
            "At Ego Vision, we elevate your vision with our premium lenses designed for clarity and comfort.",
            "Discover the perfect lens for every look with our extensive collection of stylish options.",
            "Experience life in high definition by choosing Ego Vision, where style meets functionality.",
            "With 30 unique lens options, finding your ideal pair has never been easier.",
            "Transform your look with Ego Vision's fashionable and functional eyewear."
        ];

        let index = 0;
        const typewriterElement = document.getElementById('typewriter');

        function displayText() {
            typewriterElement.style.animation = 'fade-out 0.5s forwards';
            setTimeout(() => {
                typewriterElement.textContent = texts[index];
                typewriterElement.style.animation = 'fade-in 0.5s forwards';
                index = (index + 1) % texts.length; // Loop through the texts
            }, 500); // Match the fade-out duration
        }

        displayText(); // Initial display
        setInterval(displayText, 3000); // Change text every 3 seconds
    </script>

