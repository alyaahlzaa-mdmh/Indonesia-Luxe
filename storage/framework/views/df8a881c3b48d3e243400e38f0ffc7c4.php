
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    [x-cloak] { display: none !important; }

    /* Custom range slider styling */
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #FF7A45;
        border: 3px solid white;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        cursor: pointer;
    }
    input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #FF7A45;
        border: 3px solid white;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        cursor: pointer;
    }

    /* Custom scrollbar for booking panel */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Marquee animation */
    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 25s linear infinite;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }

    .text-shadow-sm {
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
</style>
<?php /**PATH /var/www/indonesia-luxe/resources/views/partials/guest-styles.blade.php ENDPATH**/ ?>