<?php

if (!function_exists('settings')) {
    function settings($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $currency = settings('currency', 'USD');
        return match ($currency) {
            'EUR' => '€',
            'GBP' => '£',
            'INR' => '₹',
            'BDT' => '৳',
            default => '$',
        };
    }
}

if (!function_exists('currency_format')) {
    function currency_format($amount, $decimals = 2)
    {
        $symbol = currency_symbol();
        return $symbol . ' ' . number_format($amount, $decimals);
    }
}

