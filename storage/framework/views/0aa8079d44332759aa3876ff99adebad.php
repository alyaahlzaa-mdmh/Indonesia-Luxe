<div
    x-data="{ 
        show: false, 
        message: '',
        status: '',
        timeout: null,
        showToast(payload) {
            this.message = payload.message;
            this.status = payload.status;
            this.show = true;

            if(this.timeout) clearTimeout(this.timeout);
            this.timeout = setTimeout(() => { this.show = false; }, 3000);
        }
    }"
    <?php
    $timeoutMs=3000;
    ?>
    x-on:action-toast.window="showToast($event.detail)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4"
    :class="status === 'guest' ? 'bg-[#311010]' : 'bg-yellow-100'"
    class="fixed top-20 right-6 z-50 flex items-center gap-2.5 px-4 py-3 rounded-xl shadow-xl w-max max-w-[90vw]"
    style="display: none;">
    <svg x-show="status == 'guest'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert w-5 h-5 text-[#fca5a5]">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" x2="12" y1="8" y2="12" />
        <line x1="12" x2="12.01" y1="16" y2="16" />
    </svg>
    <svg x-show="status != 'guest'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check w-5 h-5 text-yellow-700">
        <circle cx="12" cy="12" r="10" />
        <path d="m9 12 2 2 4-4" />
    </svg>
    <span :class="status === 'guest' ? 'text-[#fca5a5]' : 'text-yellow-700'" class="text-[13px] sm:text-[14px] font-medium tracking-wide whitespace-nowrap" x-text="message"></span>
</div><?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/components/guest/toast.blade.php ENDPATH**/ ?>