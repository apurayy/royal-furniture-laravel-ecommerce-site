<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    private array $currencyOptions = [
        'USD' => 'USD ($)',
        'EUR' => 'EUR (&euro;)',
        'GBP' => 'GBP (&pound;)',
        'INR' => 'INR (&#8377;)',
        'BDT' => 'BDT (৳)',
    ];

    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Royal Furniture'),
            'site_logo' => Setting::get('site_logo'),
            'site_favicon' => Setting::get('site_favicon'),
            'site_description' => Setting::get('site_description'),
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_address' => Setting::get('contact_address'),
            'facebook' => Setting::get('facebook'),
            'twitter' => Setting::get('twitter'),
            'instagram' => Setting::get('instagram'),
            'youtube' => Setting::get('youtube'),
            'currency' => Setting::get('currency', 'USD'),
            'shipping_cost' => Setting::get('shipping_cost', '0'),
            'tax_rate' => Setting::get('tax_rate', '0'),
        ];

        return view('admin.settings.index', compact('settings'))
            ->with('currencyOptions', $this->currencyOptions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'currency' => ['required', 'string', 'max:10', Rule::in(array_keys($this->currencyOptions))],
        ]);

        $fields = [
            'site_name', 'site_description', 'contact_email', 'contact_phone',
            'contact_address', 'facebook', 'twitter', 'instagram', 'youtube',
            'currency', 'shipping_cost', 'tax_rate'
        ];

        foreach ($fields as $field) {
            // Save empty values as well, so clearing a field works correctly.
            Setting::set($field, $request->input($field, ''));
        }

        if ($request->hasFile('site_logo')) {
            $logo = $this->uploadImage($request->file('site_logo'), 'site_logo');
            Setting::set('site_logo', $logo);
        }

        if ($request->hasFile('site_favicon')) {
            $favicon = $this->uploadImage($request->file('site_favicon'), 'site_favicon');
            Setting::set('site_favicon', $favicon);
        }

        return back()->with('success', 'Settings saved successfully.');
    }

    private function uploadImage($file, $prefix = 'image')
    {
        $filename = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
}
