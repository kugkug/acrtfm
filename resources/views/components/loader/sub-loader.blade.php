
<style>
    /* Air Conditioner AJAX Loader Animation */
    .ac-sub-loader {
        /* background: #fff; */
        /* border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); */
        text-align: center;
        max-width: 300px;
        width: 90%;
        display: none;
    }

    .ac-sub-unit {
        width: 120px;
        height: 40px;
        /* background: linear-gradient(135deg, #e0e0e0, #f5f5f5); */
        /* border: 3px solid #ccc; */
        /* border-radius: 10px; */
        /* margin: 0 auto 20px; */
        position: relative;
        overflow: hidden;
    }

    .ac-sub-display {
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

    /* .ac-display::before {
        content: "COOLING";
        color: #00ff00;
        font-size: 8px;
        font-weight: bold;
        animation: ac-text-blink 1.5s infinite;
    } */

    .ac-sub-vents {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 8px;
        display: flex;
        justify-content: space-between;
    }

    .ac-sub-vent {
        width: 6px;
        height: 8px;
        background: #333;
        border-radius: 2px;
        animation: ac-sub-vent-flow 2s infinite;
    }

    .ac-sub-vent:nth-child(1) { animation-delay: 0s; }
    .ac-sub-vent:nth-child(2) { animation-delay: 0.2s; }
    .ac-sub-vent:nth-child(3) { animation-delay: 0.4s; }
    .ac-sub-vent:nth-child(4) { animation-delay: 0.6s; }
    .ac-sub-vent:nth-child(5) { animation-delay: 0.8s; }
    .ac-sub-vent:nth-child(6) { animation-delay: 1s; }
    .ac-sub-vent:nth-child(7) { animation-delay: 1.2s; }
    .ac-sub-vent:nth-child(8) { animation-delay: 1.4s; }

    .ac-sub-air-flow {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 20px;
        display: flex;
        justify-content: center;
    }

    .ac-sub-air-particle {
        width: 4px;
        height: 4px;
        background: #87CEEB;
        border-radius: 50%;
        margin: 0 2px;
        animation: ac-sub-air-flow 1.5s infinite;
        opacity: 0;
    }

    .ac-sub-air-particle:nth-child(1) { animation-delay: 0s; }
    .ac-sub-air-particle:nth-child(2) { animation-delay: 0.1s; }
    .ac-sub-air-particle:nth-child(3) { animation-delay: 0.2s; }
    .ac-sub-air-particle:nth-child(4) { animation-delay: 0.3s; }
    .ac-sub-air-particle:nth-child(5) { animation-delay: 0.4s; }

    .ac-sub-loading-text {
        color: #333;
        font-size: 16px;
        font-weight: 500;
        margin-top: 15px;
    }

    .ac-sub-loading-dots {
        display: inline-block;
        animation: ac-sub-dots 1.5s infinite;
    }

    @keyframes ac-sub-text-blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0.3; }
    }

    @keyframes ac-sub-vent-flow {
        0%, 100% { 
            background: #333;
            transform: scaleY(1);
        }
        50% { 
            background: #87CEEB;
            transform: scaleY(1.5);
        }
    }

    @keyframes ac-sub-air-flow {
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

    @keyframes ac-sub-dots {
        0%, 20% { content: ""; }
        40% { content: "."; }
        60% { content: ".."; }
        80%, 100% { content: "..."; }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ac-sub-loader {
            padding: 20px;
            max-width: 250px;
        }
        
        .ac-sub-unit {
            width: 100px;
            height: 70px;
        }
        
        .ac-sub-display {
            width: 50px;
            height: 15px;
        }
        
        .ac-sub-display::before {
            font-size: 7px;
        }
    }
</style>

    <div class="ac-sub-loader" id="sub-loader">
        <div class="ac-sub-unit">
            {{-- <div class="ac-display"></div> --}}
            <div class="ac-sub-vents">
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
                <div class="ac-sub-vent"></div>
            </div>
            <div class="ac-sub-air-flow">
                <div class="ac-sub-air-particle"></div>
                <div class="ac-sub-air-particle"></div>
                <div class="ac-sub-air-particle"></div>
                <div class="ac-sub-air-particle"></div>
                <div class="ac-sub-air-particle"></div>
            </div>
        </div>
        {{-- <div class="ac-sub-loading-text">
            Cooling down<span class="ac-sub-loading-dots"></span>
        </div> --}}
    </div>
