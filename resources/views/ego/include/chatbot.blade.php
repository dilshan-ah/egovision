    <div id="chatbot">
        <div id="chatbot-header">
            <span>Chatbot</span>
            <button id="close-chatbot">✖</button>
        </div>
        <div id="chatbot-body">
            <!-- Initial message will be loaded here -->
        </div>
        <div id="chatbot-input">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button id="send-message">Send</button>
        </div>
    </div>
    <button id="chatbot-button">
        <img src="{{ asset('ego/chatbot.svg') }}" alt="Chat Icon">
    </button>
    <!-- privecy policy -->
    <div id="recaptcha-sidebar">
        <div id="recaptcha-content">
            <div id="recaptcha-text">
                <span style="margin-right: 5px;">Protected by reCAPTCHA</span>
                <a href="https://policies.google.com/privacy" target="_blank" style="color: white; text-decoration: underline; margin-right: 5px;">Privacy</a>
                <span>-</span>
                <a href="https://policies.google.com/terms" target="_blank" style="color: white; text-decoration: underline; margin-left: 5px;">Terms</a>
            </div>
            <div id="recaptcha-icon" style="background-color: white; display: inline-block; border-radius: 8px;">
                <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" style="width: 48px; height: 48px;">
            </div>
        </div>
    </div>