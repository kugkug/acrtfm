
<style>
    /* Air Conditioner AJAX Loader Animation */
    .ac-loader-container {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .ac-loader {
        /* background: #fff; */
        /* border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); */
        text-align: center;
        max-width: 300px;
        width: 90%;
    }

    .ac-unit {
        width: 120px;
        height: 80px;
        background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
        border: 3px solid #ccc;
        border-radius: 10px;
        margin: 0 auto 20px;
        position: relative;
        overflow: hidden;
    }

    .ac-display {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 20px;
        background: #000;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ac-display::before {
        content: "COOLING";
        color: #00ff00;
        font-size: 8px;
        font-weight: bold;
        animation: ac-text-blink 1.5s infinite;
    }

    .ac-vents {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 8px;
        display: flex;
        justify-content: space-between;
    }

    .ac-vent {
        width: 6px;
        height: 8px;
        background: #333;
        border-radius: 2px;
        animation: ac-vent-flow 2s infinite;
    }

    .ac-vent:nth-child(1) { animation-delay: 0s; }
    .ac-vent:nth-child(2) { animation-delay: 0.2s; }
    .ac-vent:nth-child(3) { animation-delay: 0.4s; }
    .ac-vent:nth-child(4) { animation-delay: 0.6s; }
    .ac-vent:nth-child(5) { animation-delay: 0.8s; }
    .ac-vent:nth-child(6) { animation-delay: 1s; }
    .ac-vent:nth-child(7) { animation-delay: 1.2s; }
    .ac-vent:nth-child(8) { animation-delay: 1.4s; }

    .ac-air-flow {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 20px;
        display: flex;
        justify-content: center;
    }

    .ac-air-particle {
        width: 4px;
        height: 4px;
        background: #87CEEB;
        border-radius: 50%;
        margin: 0 2px;
        animation: ac-air-flow 1.5s infinite;
        opacity: 0;
    }

    .ac-air-particle:nth-child(1) { animation-delay: 0s; }
    .ac-air-particle:nth-child(2) { animation-delay: 0.1s; }
    .ac-air-particle:nth-child(3) { animation-delay: 0.2s; }
    .ac-air-particle:nth-child(4) { animation-delay: 0.3s; }
    .ac-air-particle:nth-child(5) { animation-delay: 0.4s; }

    .ac-loading-text {
        color: #333;
        font-size: 16px;
        font-weight: 500;
        margin-top: 15px;
    }

    .ac-loading-dots {
        display: inline-block;
        animation: ac-dots 1.5s infinite;
    }

    @keyframes ac-text-blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0.3; }
    }

    @keyframes ac-vent-flow {
        0%, 100% { 
            background: #333;
            transform: scaleY(1);
        }
        50% { 
            background: #87CEEB;
            transform: scaleY(1.5);
        }
    }

    @keyframes ac-air-flow {
        0% {
            opacity: 0;
            transform: translateY(0) scale(0.5);
        }
        50% {
            opacity: 1;
            transform: translateY(-15px) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-30px) scale(0.5);
        }
    }

    @keyframes ac-dots {
        0%, 20% { content: ""; }
        40% { content: "."; }
        60% { content: ".."; }
        80%, 100% { content: "..."; }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ac-loader {
            padding: 20px;
            max-width: 250px;
        }
        
        .ac-unit {
            width: 100px;
            height: 70px;
        }
        
        .ac-display {
            width: 50px;
            height: 15px;
        }
        
        .ac-display::before {
            font-size: 7px;
        }
    }
</style>

<!-- Air Conditioner AJAX Loader -->
<div class="ac-loader-container" id="full-loader">
    <div class="ac-loader">
        <div class="ac-unit">
            <div class="ac-display"></div>
            <div class="ac-vents">
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
                <div class="ac-vent"></div>
            </div>
            <div class="ac-air-flow">
                <div class="ac-air-particle"></div>
                <div class="ac-air-particle"></div>
                <div class="ac-air-particle"></div>
                <div class="ac-air-particle"></div>
                <div class="ac-air-particle"></div>
            </div>
        </div>
        {{-- <div class="ac-loading-text">
            Cooling down<span class="ac-loading-dots"></span>
        </div> --}}
    </div>
</div>