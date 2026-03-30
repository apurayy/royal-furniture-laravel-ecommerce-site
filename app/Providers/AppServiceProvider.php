<?php

namespace App\Providers;

use App\Models\FooterMenuItem;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('frontend.layout.footer', function ($view) {
            $footerLinks = FooterMenuItem::where('is_active', true)
                ->where('section', 'footer_links')
                ->orderBy('sort_order')
                ->get();

            $customerService = FooterMenuItem::where('is_active', true)
                ->where('section', 'customer_service')
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'footerLinks' => $footerLinks,
                'customerService' => $customerService,
                'siteDescription' => Setting::get('site_description', 'Experience the epitome of luxury and elegance with our exquisite furniture collection.'),
                'footerAddress' => Setting::get('contact_address', '123 Royal Street, New York, NY 10001'),
                'footerPhone' => Setting::get('contact_phone', '+1 234 567 890'),
                'footerEmail' => Setting::get('contact_email', 'info@royalfurniture.com'),
                'facebook' => Setting::get('facebook', '#'),
                'twitter' => Setting::get('twitter', '#'),
                'instagram' => Setting::get('instagram', '#'),
                'youtube' => Setting::get('youtube', '#'),
            ]);
        });
    }
}
