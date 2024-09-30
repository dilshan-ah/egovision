<style>
    /* Loader Container */
    .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        /* Semi-transparent background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Ensure it is above all other content */
    }

    /* Content Style */
    .content {
        align-items: center;
        display: flex;
        height: 200px;
        width: 200px;
        justify-content: center;
    }

    /* Spinner Style */
    .spinner {
        display: inline-block;
        position: relative;
        width: 40px;
        height: 40px;
    }

    .spinner div {
        transform-origin: 20px 20px;
        animation: spinner 1.2s linear infinite;
    }

    .spinner div:after {
        content: " ";
        display: block;
        position: absolute;
        top: 3px;
        left: 15px;
        width: 4px;
        height: 12px;
        border-radius: 20%;
        background: black;
    }

    .spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
    }

    .spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
    }

    .spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
    }

    .spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
    }

    .spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
    }

    .spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
    }

    .spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
    }

    .spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
    }

    .spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
    }

    .spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
    }

    .spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
    }

    .spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
    }

    @keyframes spinner {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style>
<div class="loader-container">
    <div class="content">
        <div class="spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        const loader = document.querySelector('.loader-container');
        loader.style.display = 'none';
    });
</script>