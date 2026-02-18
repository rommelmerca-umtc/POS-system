<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name'           => 'Tarpaulin',
            'description'    => 'A durable tarpaulin material, ideal for outdoor use.',
            'image_url'      => 'https://images.pexels.com/photos/3091203/pexels-photo-3091203.jpeg',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Sticker',
            'description'    => 'A durable sticker material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.pexels.com/photos/9381081/pexels-photo-9381081.jpeg',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Sintra 1mm thick',
            'description'    => 'A durable sintra material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.pexels.com/photos/6373657/pexels-photo-6373657.jpeg',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Sintra 3mm thick',
            'description'    => 'A durable sintra material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.pexels.com/photos/6373657/pexels-photo-6373657.jpeg',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Sintra 5mm thick',
            'description'    => 'A durable sintra material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.pexels.com/photos/6373657/pexels-photo-6373657.jpeg',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Panaflex Signage (Non-lighted)',
            'description'    => 'A durable panaflex material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.unsplash.com/photo-1618623266812-f5075ba99663?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Panaflex Signage (lighted)',
            'description'    => 'A durable lighted panaflex material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://images.unsplash.com/photo-1544059799-1e84c415f2d6?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'default_price'  => null,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Pull up Banner (2.75ft x 6.5ft)',
            'description'    => 'A durable pull up banner material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://customsignage.com.au/wp-content/uploads/2024/01/custom-standard-pull-up-banner-600-model-printing-1200x885.png',
            'default_price'  => 1300.00,
            'default_width'  => 2.75,
            'default_height' => 6.5,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Pull up Banner (2ft x 5ft)',
            'description'    => 'A durable pull up banner material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://customsignage.com.au/wp-content/uploads/2024/01/custom-standard-pull-up-banner-600-model-printing-1200x885.png',
            'default_price'  => 1500.00,
            'default_width'  => 2.0,
            'default_height' => 5.0,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Pull up Banner (4ft x 6ft)',
            'description'    => 'A durable pull up banner material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://customsignage.com.au/wp-content/uploads/2024/01/custom-standard-pull-up-banner-600-model-printing-1200x885.png',
            'default_price'  => 1500.00,
            'default_width'  => 4.0,
            'default_height' => 6.0,
            'default_unit'   => 'feet'
        ]);
        Product::create([
            'name'           => 'Full Sublimation (Polo shirt)',
            'description'    => 'A durable full sublimation polo shirt material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://www.chilliwebsites.com/sitefiles/1609/image/11%20Sublimation/Polo%20Shirts/2022/July%202022/RS/4%20RS%20%20front%20%26%20back%20polo.jpg',
            'default_price'  => 350.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
        Product::create([
            'name'           => 'Full Sublimation (T-shirt)',
            'description'    => 'A durable full sublimation t-shirt material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://www.chilliwebsites.com/sitefiles/1609/image/11%20Sublimation/Polo%20Shirts/2022/July%202022/RS/4%20RS%20%20front%20%26%20back%20polo.jpg',
            'default_price'  => 450.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
        Product::create([
            'name'           => 'Full Sublimation (Top & Bottom Sportswear)',
            'description'    => 'A durable full sublimation top and bottom sportswear material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://ph-test-11.slatic.net/p/759f2fe8e7a306a8392ac2c9fede57a4.jpg',
            'default_price'  => 650.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
        Product::create([
            'name'           => 'Full Sublimation (Banner)',
            'description'    => 'A durable full sublimation banner material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://m-production.ca/wp-content/uploads/2024/11/Banners-1.webp',
            'default_price'  => 1250.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
        Product::create([
            'name'           => 'Customized T-shirt Printing (DTF)',
            'description'    => 'A durable customized t-shirt printing (DTF) material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://www.613originals.com/img/Hero-Slider-DTF02.png',
            'default_price'  => 850.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
        Product::create([
            'name'           => 'Customized T-shirt Printing (Silkscreen)',
            'description'    => 'A durable customized t-shirt printing (Silkscreen) material, ideal for indoor and outdoor use.',
            'image_url'      => 'https://planbprinting.com/wp-content/uploads/bfi_thumb/pros-and-cons-of-silk-screen-t-shirt-printing-pf8wl41v3v2q1hqc7uf50eztj9c7oohljuniyk33xo.jpg',
            'default_price'  => 750.00,
            'default_width'  => null,
            'default_height' => null,
            'default_unit'   => null
        ]);
    }
}
