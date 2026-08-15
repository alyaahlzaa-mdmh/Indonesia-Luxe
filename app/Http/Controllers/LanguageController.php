<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Supported locales.
     */
    protected array $supported = ['id', 'en'];

    /**
     * Switch the application locale.
     */
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'id');

        if (in_array($locale, $this->supported)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
