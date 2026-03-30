<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@royalfurniture.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Customer User
        User::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Living Room', 'slug' => 'living-room', 'description' => 'Elegant living room furniture', 'status' => 'active'],
            ['name' => 'Bedroom', 'slug' => 'bedroom', 'description' => 'Luxurious bedroom sets', 'status' => 'active'],
            ['name' => 'Dining Room', 'slug' => 'dining-room', 'description' => 'Premium dining furniture', 'status' => 'active'],
            ['name' => 'Office', 'slug' => 'office', 'description' => 'Professional office furniture', 'status' => 'active'],
            ['name' => 'Outdoor', 'slug' => 'outdoor', 'description' => 'Outdoor living solutions', 'status' => 'active'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Products
        $products = [
            ['category_id' => 1, 'name' => 'Royal Velvet Sofa', 'slug' => 'royal-velvet-sofa', 'short_description' => 'Luxurious velvet sofa with gold accents', 'description' => 'Premium quality velvet sofa with elegant gold trim and premium cushioning.', 'price' => 2499.99, 'old_price' => 2999.99, 'sku' => 'RVS-001', 'stock_quantity' => 15, 'material' => 'Velvet', 'dimensions' => '84"W x 36"D x 32"H', 'color' => 'Navy Blue', 'featured' => true, 'status' => 'active'],
            ['category_id' => 1, 'name' => 'Classic Leather Armchair', 'slug' => 'classic-leather-armchair', 'short_description' => 'Genuine leather armchair', 'description' => 'Handcrafted leather armchair with premium wood frame.', 'price' => 1299.99, 'sku' => 'CLA-002', 'stock_quantity' => 20, 'material' => 'Genuine Leather', 'dimensions' => '36"W x 34"D x 38"H', 'color' => 'Brown', 'featured' => true, 'status' => 'active'],
            ['category_id' => 2, 'name' => 'Majestic King Bed', 'slug' => 'majestic-king-bed', 'short_description' => 'Royal king size bed with canopy', 'description' => 'Stunning king bed with ornate headboard and canopy design.', 'price' => 3999.99, 'old_price' => 4999.99, 'sku' => 'MKB-003', 'stock_quantity' => 8, 'material' => 'Solid Wood', 'dimensions' => '80"W x 86"D x 90"H', 'color' => 'Walnut', 'featured' => true, 'status' => 'active'],
            ['category_id' => 2, 'name' => 'Elegant Nightstand', 'slug' => 'elegant-nightstand', 'short_description' => 'Marble top nightstand', 'description' => 'Luxurious nightstand with marble top and gold handles.', 'price' => 449.99, 'sku' => 'EN-004', 'stock_quantity' => 25, 'material' => 'Wood & Marble', 'dimensions' => '24"W x 18"D x 28"H', 'color' => 'White/Gold', 'featured' => false, 'status' => 'active'],
            ['category_id' => 3, 'name' => 'Grand Dining Table', 'slug' => 'grand-dining-table', 'short_description' => 'Seats 10 guests', 'description' => 'Magnificent dining table seating up to 10 guests.', 'price' => 3499.99, 'old_price' => 4299.99, 'sku' => 'GDT-005', 'stock_quantity' => 5, 'material' => 'Solid Oak', 'dimensions' => '120"W x 48"D x 30"H', 'color' => 'Oak', 'featured' => true, 'status' => 'active'],
            ['category_id' => 3, 'name' => 'Velvet Dining Chairs', 'slug' => 'velvet-dining-chairs', 'short_description' => 'Set of 6 chairs', 'description' => 'Set of 6 elegant velvet dining chairs.', 'price' => 1199.99, 'sku' => 'VDC-006', 'stock_quantity' => 30, 'material' => 'Velvet & Wood', 'dimensions' => '22"W x 24"D x 36"H', 'color' => 'Emerald Green', 'featured' => false, 'status' => 'active'],
            ['category_id' => 4, 'name' => 'Executive Desk', 'slug' => 'executive-desk', 'short_description' => 'Premium home office desk', 'description' => 'Spacious executive desk with leather top.', 'price' => 1899.99, 'old_price' => 2299.99, 'sku' => 'ED-007', 'stock_quantity' => 12, 'material' => 'Wood & Leather', 'dimensions' => '72"W x 36"D x 30"H', 'color' => 'Mahogany', 'featured' => true, 'status' => 'active'],
            ['category_id' => 4, 'name' => 'Leather Office Chair', 'slug' => 'leather-office-chair', 'short_description' => 'Ergonomic leather chair', 'description' => 'Premium ergonomic leather office chair.', 'price' => 799.99, 'sku' => 'LOC-008', 'stock_quantity' => 18, 'material' => 'Genuine Leather', 'dimensions' => '26"W x 26"D x 45"H', 'color' => 'Black', 'featured' => false, 'status' => 'active'],
            ['category_id' => 5, 'name' => 'Patio Lounge Set', 'slug' => 'patio-lounge-set', 'short_description' => '5-piece outdoor set', 'description' => 'Luxurious 5-piece outdoor lounge set.', 'price' => 2799.99, 'old_price' => 3499.99, 'sku' => 'PLS-009', 'stock_quantity' => 10, 'material' => 'Rattan & Fabric', 'dimensions' => 'Various', 'color' => 'Natural', 'featured' => true, 'status' => 'active'],
            ['category_id' => 1, 'name' => 'Coffee Table Set', 'slug' => 'coffee-table-set', 'short_description' => 'Modern glass coffee table', 'description' => 'Elegant glass coffee table with gold legs.', 'price' => 699.99, 'sku' => 'CTS-010', 'stock_quantity' => 22, 'material' => 'Glass & Metal', 'dimensions' => '48"W x 24"D x 18"H', 'color' => 'Clear/Gold', 'featured' => false, 'status' => 'active'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create Sliders
        Slider::create([
            'title' => 'Royal Collection',
            'subtitle' => 'Experience Luxury Like Never Before',
            'image' => 'slider1.jpg',
            'link' => '/shop',
            'button_text' => 'Shop Now',
            'status' => 'active',
            'order' => 1,
        ]);

        Slider::create([
            'title' => 'New Arrivals',
            'subtitle' => 'Discover Our Latest Designs',
            'image' => 'slider2.jpg',
            'link' => '/shop?sort=newest',
            'button_text' => 'Explore',
            'status' => 'active',
            'order' => 2,
        ]);

        // Create Pages
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<h2>Welcome to Royal Furniture</h2><p>Since 1985, we have been crafting the finest furniture for discerning customers who appreciate luxury and quality. Our commitment to excellence has made us a leader in the industry.</p><h3>Our Mission</h3><p>To provide exceptional furniture that transforms houses into homes, with a focus on quality, design, and customer satisfaction.</p>',
            'meta_title' => 'About Us - Royal Furniture',
            'meta_description' => 'Learn about Royal Furniture\'s history and commitment to quality.',
            'status' => 'active',
        ]);

        Page::create([
            'title' => 'FAQ',
            'slug' => 'faq',
            'content' => '<h2>Frequently Asked Questions</h2><h3>What is your return policy?</h3><p>We offer a 30-day return policy on most items.</p><h3>Do you offer assembly?</h3><p>Yes, we provide professional assembly services for an additional fee.</p><h3>What is the warranty?</h3><p>All our furniture comes with a minimum 1-year warranty.</p>',
            'status' => 'active',
        ]);

        // Create Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Royal Furniture'],
            ['key' => 'site_description', 'value' => 'Premium furniture for luxurious living'],
            ['key' => 'contact_email', 'value' => 'info@royalfurniture.com'],
            ['key' => 'contact_phone', 'value' => '+1 234 567 890'],
            ['key' => 'contact_address', 'value' => '123 Royal Street, New York, NY 10001'],
            ['key' => 'currency', 'value' => 'USD'],
            ['key' => 'shipping_cost', 'value' => '50'],
            ['key' => 'tax_rate', 'value' => '8'],
            ['key' => 'facebook', 'value' => 'https://facebook.com'],
            ['key' => 'twitter', 'value' => 'https://twitter.com'],
            ['key' => 'instagram', 'value' => 'https://instagram.com'],
            ['key' => 'youtube', 'value' => 'https://youtube.com'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
