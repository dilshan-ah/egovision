<!-- jQuery and Slick Slider JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $(".multiple-items").slick({
            infinite: true,
            speed: 500,
            slidesToShow: 5,
            slidesToScroll: 3,
            centerMode: true,
            centerPadding: '0',
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    centerPadding: '0'
                }
            }]
        });
    });
    // suscribe button 
    document.getElementById('emailInput').addEventListener('focus', function() {
        document.getElementById('subscribeSection').classList.remove('hidden');
    });

    document.getElementById('privacyPolicyCheck').addEventListener('change', function() {
        const subscribeButton = document.getElementById('subscribeButton');
        if (this.checked) {
            subscribeButton.disabled = false;
        } else {
            subscribeButton.disabled = true;
        }
    });
</script>
<!-- JS libraries and initialization script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- for topbar -->
<script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#textCarousel").slick({
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
        });
    });
</script>
<!-- Sidebar MOdal  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay-sidebar');

        openSidebarBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.add('show');
            overlay.classList.add('show');
        });

        closeSidebarBtn.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const numberDisplay = document.getElementById('number');

        let count = 0;

        decreaseButton.addEventListener('click', function() {
            count--;
            numberDisplay.textContent = count;
        });

        increaseButton.addEventListener('click', function() {
            count++;
            numberDisplay.textContent = count;
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('.product-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1700,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    });
</script>

<!-- chat bot -->
<script>
    const recaptchaSidebar = document.getElementById('recaptcha-sidebar');
    const recaptchaText = document.getElementById('recaptcha-text');
    const recaptchaIcon = document.getElementById('recaptcha-icon');

    recaptchaSidebar.addEventListener('mouseover', function() {
        recaptchaSidebar.classList.add('expanded');
    });

    recaptchaSidebar.addEventListener('mouseout', function() {
        recaptchaSidebar.classList.remove('expanded');
    });
</script>
<!-- chat bot for index file-->
<script>
    const initialMessage = `
            Welcome, I'm ego vision Virtual Assistant.<br>
            Please SELECT an option from the list below:<br>
            <span class="option" onclick="handleOption('purchase')">Make a Purchase</span><br>
            <span class="option" onclick="handleOption('other')">Other</span>
        `;

    document.getElementById('chatbot-button').addEventListener('click', function() {
        document.getElementById('chatbot-body').innerHTML = `<div class="message bot">${initialMessage}</div>`;
        document.getElementById('chatbot').style.display = 'flex';
        this.style.display = 'none';
    });

    document.getElementById('close-chatbot').addEventListener('click', function() {
        document.getElementById('chatbot').style.opacity = 0;
        setTimeout(() => {
            document.getElementById('chatbot').style.display = 'none';
            document.getElementById('chatbot-button').style.display = 'block';
        }, 300); // Matches the opacity transition duration
    });

    document.getElementById('send-message').addEventListener('click', function() {
        const userInput = document.getElementById('user-input').value;
        if (userInput.trim() !== '') {
            displayMessage(userInput, 'user');
            document.getElementById('user-input').value = '';

            // Simulate AI response
            setTimeout(function() {
                const aiResponse = generateAIResponse(userInput);
                displayMessage(aiResponse, 'bot');
            }, 1000);
        }
    });

    function displayMessage(message, sender) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender);
        messageElement.innerHTML = message;
        document.getElementById('chatbot-body').appendChild(messageElement);
        document.getElementById('chatbot-body').scrollTop = document.getElementById('chatbot-body').scrollHeight;
    }

    function generateAIResponse(userInput) {
        if (userInput.toLowerCase().includes('hello')) {
            return "Hi there! How can I help you?";
        } else if (userInput.toLowerCase().includes('help')) {
            return "Sure, I'm here to help! What do you need assistance with?";
        } else {
            return "I'm not sure I understand, but I'm here to assist!";
        }
    }

    function handleOption(option) {
        let response = '';
        if (option === 'purchase') {
            response = 'You selected "Make a Purchase". How can I assist you with your purchase?';
        } else if (option === 'other') {
            response = 'You selected "Other". Please let me know what else you need help with.';
        }
        displayMessage(response, 'bot');
    }
</script>