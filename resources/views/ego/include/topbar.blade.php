<style>
    .rotating-text {
        position: relative;
        font-size: 12px;
        text-align: center;
        height: 28px;
        overflow: hidden;
        background-color: black;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .rotating-text .sentence {
        position: absolute;
        width: 100%;
        opacity: 0;
        transform: translateX(-100%);
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        animation: slideLeftToRight 9s infinite;
    }

    .rotating-text .sentence:nth-child(1) {
        animation-delay: 0s;
    }

    .rotating-text .sentence:nth-child(2) {
        animation-delay: 3s;
    }

    .rotating-text .sentence:nth-child(3) {
        animation-delay: 6s;
    }

    @keyframes slideLeftToRight {
        0% {
            opacity: 0;
            transform: translateX(-100%);
        }

        10% {
            opacity: 1;
            transform: translateX(0%);
        }

        30% {
            opacity: 1;
            transform: translateX(0%);
        }

        40% {
            opacity: 0;
            transform: translateX(100%);
        }

        100% {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>



<div class="rotating-text">
    <div class="sentence">FREE STANDARD EXPRESS SHIPPING ON ORDERS CONTAINING AT LEAST</div>
    <div class="sentence">FREE SAMPLES: PICK YOURS IN THE SHOPPING BAG BEFORE CHECKOUT</div>
    <div class="sentence">EUROPE: DELIVERY WITHIN 1 to 2 WORKING DAYS
    </div>
</div>
