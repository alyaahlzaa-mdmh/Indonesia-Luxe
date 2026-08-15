<?php

/**
 * Contact Information Helper Functions
 * 
 * These functions provide convenient access to contact information
 * from the centralized contact configuration.
 */

if (!function_exists('getAdminWhatsapp')) {
    /**
     * Get the admin WhatsApp number
     * 
     * @param bool $withPlus If true, returns with '+' prefix, otherwise returns plain number
     * @return string Admin WhatsApp number
     */
    function getAdminWhatsapp($withPlus = false)
    {
        $number = config('contact.whatsapp.admin', '6287890333000');

        if ($withPlus && strpos($number, '+') === false) {
            return '+' . $number;
        }

        if (!$withPlus && strpos($number, '+') === 0) {
            return substr($number, 1);
        }

        return $number;
    }
}

if (!function_exists('getAdminPhone')) {
    /**
     * Get the admin phone number
     * 
     * @return string Admin phone number with '+' prefix
     */
    function getAdminPhone()
    {
        return config('contact.phone.admin', '+6287890333000');
    }
}

if (!function_exists('getDefaultWhatsappMessage')) {
    /**
     * Get the default WhatsApp message
     * 
     * @return string Default message for WhatsApp
     */
    function getDefaultWhatsappMessage()
    {
        return config('contact.whatsapp.default_message', 'Halo, saya ingin konsultasi tentang Sultanah Tour.');
    }
}

if (!function_exists('getWhatsappUrl')) {
    /**
     * Generate WhatsApp URL for opening chat
     * 
     * @param string|null $message Optional custom message
     * @return string WhatsApp API URL
     */
    function getWhatsappUrl($message = null)
    {
        $phone = getAdminWhatsapp();
        $msg = $message ?? getDefaultWhatsappMessage();

        return 'https://api.whatsapp.com/send/?phone=' . $phone . '&text=' . urlencode($msg) . '&type=phone_number&app_absent=0';
    }
}

if (!function_exists('getWhatsappMeUrl')) {
    /**
     * Generate WhatsApp wa.me URL for opening chat
     * 
     * @return string WhatsApp wa.me URL
     */
    function getWhatsappMeUrl()
    {
        $phone = getAdminWhatsapp();
        return 'https://wa.me/' . $phone;
    }
}

if (!function_exists('getPackageWhatsappUrl')) {
    /**
     * Generate WhatsApp URL for package inquiry
     * 
     * @param string $packageName Package name
     * @param float $price Package price
     * @return string WhatsApp API URL for package inquiry
     */
    function getPackageWhatsappUrl($packageName, $price = null)
    {
        $phone = getAdminWhatsapp();
        $priceText = $price ? ' seharga Rp ' . number_format($price, 0, ',', '.') : '';
        $msg = "Halo, saya tertarik dengan paket {$packageName}{$priceText}. Mohon informasi lebih lanjut.";

        return 'https://api.whatsapp.com/send/?phone=' . $phone . '&text=' . urlencode($msg) . '&type=phone_number&app_absent=0';
    }
}

if (!function_exists('getBookingWhatsappUrl')) {
    /**
     * Generate WhatsApp URL for package inquiry
     * 
     * @param string $packageName Package name
     * @param float $price Package price
     * @return string WhatsApp API URL for package inquiry
     */
    function getBookingWhatsappUrl(
        $packageName,
        $totalJamaah,
        $name,
        $email,
        $phoneNumber,
        $price,
        $referralCode = '-',
        $voucherCode = '-',
        $additionalPilgrims = []
    ) {
        $phone = getAdminWhatsapp();

        $paymentText = number_format($price, 0, ',', '.');

        $additionalText = "";
        foreach ($additionalPilgrims as $index => $pilgrim) {
            $num = $index + 2;
            $pName = $pilgrim['name'] ?? '-';
            $pPhone = $pilgrim['phone'] ?? '-';
            $additionalText .= "\n*Jamaah {$num}*:\nNama: {$pName}\nNo. Telp: {$pPhone}\n";
        }

        $msg = "Assalamu'alaikum Sultanah Travel, saya ingin memesan paket:\n"
            . "*Paket*: {$packageName}\n"
            . "*Total Jamaah*: {$totalJamaah} Orang\n\n"
            . "*Data Pemesan*:\n"
            . "Nama: {$name}\n"
            . "Email: {$email}\n"
            . "No. Telp: {$phoneNumber}\n"
            . $additionalText . "\n"
            . "*Kode Referral*: {$referralCode}\n"
            . "*Kode Voucher*: {$voucherCode}\n\n"
            . "*Total Pembayaran*: Rp {$paymentText}\n"
            . "Saya akan melakukan transfer ke rekening BSI Sultanah. Mohon bantuannya untuk proses selanjutnya.";

        return 'https://api.whatsapp.com/send/?phone='
            . $phone
            . '&text=' . urlencode($msg)
            . '&type=phone_number&app_absent=0';
    }
}
