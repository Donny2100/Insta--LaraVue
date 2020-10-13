<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CategoriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $catId = DB::table('categories')->insertGetId([
            'name' => 'Auto care',
            'slug' => 'auto-care',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Auto care',
            'icon_map_marker' => 'category/icn-car.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Auto care',
                'feature_title' => 'Auto care',
            ]
        ]);

        $catId = DB::table('categories')->insertGetId([
            'name' => 'Homecare',
            'slug' => 'homecare',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Homecare',
            'icon_map_marker' => 'category/icn-house-care.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Homecare',
                'feature_title' => 'Homecare',
            ]
        ]);
            
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Junk Removal',
            'slug' => 'junk-removal',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Junk Removal',
            'icon_map_marker' => 'category/icn-junk-removal.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Junk Removal',
                'feature_title' => 'Junk Removal',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Barber',
            'slug' => 'barber',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Barber',
            'icon_map_marker' => 'category/icn-barber.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Barber',
                'feature_title' => 'Barber',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Hairstylist',
            'slug' => 'hairstylist',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Hairstylist',
            'icon_map_marker' => 'category/icn-hairstylist.svg',
            'type' => 'place',
            'status' => true,
        ]);

         DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Hairstylist',
                'feature_title' => 'Hairstylist',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Nailtech',
            'slug' => 'nailtech',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Nailtech',
            'icon_map_marker' => 'category/icn-nailtech.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Nailtech',
                'feature_title' => 'Nailtech',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Masseuse ',
            'slug' => 'masseuse ',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Masseuse ',
            'icon_map_marker' => 'category/icn-masseuse.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Masseuse',
                'feature_title' => 'Masseuse',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Wax Services',
            'slug' => 'wax-services',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Wax Services',
            'icon_map_marker' => 'category/icn-wax-services.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Wax Services',
                'feature_title' => 'Wax Services',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Handy man',
            'slug' => 'handy-man',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Handy man',
            'icon_map_marker' => 'category/icn-handy-man.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Handy man',
                'feature_title' => 'Handy man',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Lawn & Yard',
            'slug' => 'lawn-yard',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Lawn & Yard',
            'icon_map_marker' => 'category/icn-lawn-yard.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Lawn & Yard',
                'feature_title' => 'Lawn & Yard',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Cleaning & Housekeeping',
            'slug' => 'cleaning-housekeeping',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Cleaning & Housekeeping',
            'icon_map_marker' => 'category/icn-cleaning-housekeeping.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Cleaning & Housekeeping',
                'feature_title' => 'Cleaning & Housekeeping',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Yard/Garage Sale',
            'slug' => 'yard-garage-sale',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Yard/Garage Sale',
            'icon_map_marker' => 'category/icn-garage-sale.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Yard/Garage Sale',
                'feature_title' => 'Yard/Garage Sale',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Meal-Prep',
            'slug' => 'meal-prep',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Meal-Prep',
            'icon_map_marker' => 'category/icn-meal-prep.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Meal-Prep',
                'feature_title' => 'Meal-Prep',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Party Décor',
            'slug' => 'party-decor',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Party Décor',
            'icon_map_marker' => 'category/icn-party-decor.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Party Décor',
                'feature_title' => 'Party Décor',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Party Favors',
            'slug' => 'party-favors',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Party Favors',
            'icon_map_marker' => 'category/icn-party-favors.svg',
            'type' => 'place',
            'status' => true,
        ]);

         DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Party Favors',
                'feature_title' => 'Party Favors',
            ]
        ]);
            
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Party Rentals',
            'slug' => 'party-rentals',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Party Rentals',
            'icon_map_marker' => 'category/icn-party-rentals.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Party Rentals',
                'feature_title' => 'Party Rentals',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Event Planning',
            'slug' => 'event-planning',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Event Planning',
            'icon_map_marker' => 'category/icn-event-planning.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Event Planning',
                'feature_title' => 'Event Planning',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Baking services',
            'slug' => 'baking-services',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Baking services',
            'icon_map_marker' => 'category/icn-baking-services.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Baking services',
                'feature_title' => 'Baking services',
            ]
        ]);            
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Video/Photographers',
            'slug' => 'video-photographers',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Video/Photographers',
            'icon_map_marker' => 'category/icn-video-photographers.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Video/Photographers',
                'feature_title' => 'Video/Photographers',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Clothing',
            'icon_map_marker' => 'category/icn-clothing.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Clothing',
                'feature_title' => 'Clothing',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Handmade items',
            'slug' => 'handmade-items',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Handmade items',
            'icon_map_marker' => 'category/icn-handmade-items.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Handmade items',
                'feature_title' => 'Handmade items',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Health & Wellness',
            'slug' => 'health-wellness',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Health & Wellness',
            'icon_map_marker' => 'category/icn-health-wellness.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Health & Wellness',
                'feature_title' => 'Health & Wellness',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Delivery & Courier',
            'slug' => 'delivery-courier',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Delivery & Courier',
            'icon_map_marker' => 'category/icn-delivery-courier.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Delivery & Courier',
                'feature_title' => 'Delivery & Courier',
            ]
        ]); 
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Pet care',
            'slug' => 'pet-care',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Pet care',
            'icon_map_marker' => 'category/icn-pet-care.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Pet care',
                'feature_title' => 'Pet care',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Notary',
            'slug' => 'notary',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Notary',
            'icon_map_marker' => 'category/icn-notary.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Notary',
                'feature_title' => 'Notary',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Graphic designers',
            'slug' => 'graphic-designers',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Graphic designers',
            'icon_map_marker' => 'category/icn-graphic-designers.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Graphic designers',
                'feature_title' => 'Graphic designers',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Web Service',
            'slug' => 'web-service',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Web Service',
            'icon_map_marker' => 'category/icn-web-service.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Web Services',
                'feature_title' => 'Web Services',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Computer/Phone repair',
            'slug' => 'computer-phone-repair',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Computer/Phone repair',
            'icon_map_marker' => 'category/icn-computer-phone-repair.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Computer/Phone repair',
                'feature_title' => 'Computer/Phone repair',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Tutoring',
            'slug' => 'tutoring',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Tutoring',
            'icon_map_marker' => 'category/icn-tutoring.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Tutoring',
                'feature_title' => 'Tutoring',
            ]
        ]);        
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Tax prep',
            'slug' => 'tax-prep',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Tax prep',
            'icon_map_marker' => 'category/icn-tax-prep.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Tax prep',
                'feature_title' => 'Tax prep',
            ]
        ]);        
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Real Estate Investors/Realtors',
            'slug' => 'real-estate-investors-realtors',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Real Estate Investors/Realtors',
            'icon_map_marker' => 'category/icn-real-estate.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Real Estate Investors/Realtors',
                'feature_title' => 'Real Estate Investors/Realtors',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Printing services',
            'slug' => 'printing-services',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Printing services',
            'icon_map_marker' => 'category/icn-printing-services.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Printing services',
                'feature_title' => 'Printing services',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Floristry',
            'slug' => 'floristry',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Floristry',
            'icon_map_marker' => 'category/icn-floristry.svg',
            'type' => 'place',
            'status' => true,
        ]);
        
        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Floristry',
                'feature_title' => 'Floristry',
            ]
        ]);

        $catId = DB::table('categories')->insertGetId([
            'name' => 'Truck Drivers',
            'slug' => 'truck-drivers',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Truck Drivers',
            'icon_map_marker' => 'category/icn-truck-drivers.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Truck Drivers',
                'feature_title' => 'Truck Drivers',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Wigs and Bundles',
            'slug' => 'wigs-bundles',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Wigs and Bundles',
            'icon_map_marker' => 'category/icn-wigs-bundles.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Wigs and Bundles',
                'feature_title' => 'Wigs and Bundles',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Hair and Beauty Supplies',
            'slug' => 'hair-beauty-supplies',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Hair and Beauty Supplies',
            'icon_map_marker' => 'category/icn-hair-beauty-supplies.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Hair and Beauty Supplies',
                'feature_title' => 'Hair and Beauty Supplies',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Makeup Artist',
            'slug' => 'makeup-artist',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Makeup Artist',
            'icon_map_marker' => 'category/icn-makeup-artist.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Makeup Artist',
                'feature_title' => 'Makeup Artist',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Lashes',
            'slug' => 'lashes',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Lashes',
            'icon_map_marker' => 'category/icn-lashes.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Lashes',
                'feature_title' => 'Lashes',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Eyebrow Micro blading',
            'slug' => 'eyebrow-micro-blading',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Eyebrow Micro blading',
            'icon_map_marker' => 'category/icn-eyebrow-micro-blading.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Eyebrow Micro blading',
                'feature_title' => 'Eyebrow Micro blading',
            ]
        ]);
        
        $catId = DB::table('categories')->insertGetId([
            'name' => 'Tattoo Artist',
            'slug' => 'tattoo-artist',
            'priority' => 0,
            'is_feature' => 0,
            'feature_title' => 'Tattoo Artist',
            'icon_map_marker' => 'category/icn-tattoo-artist.svg',
            'type' => 'place',
            'status' => true,
        ]);

        DB::table('category_translations')->insert([
            [
                'category_id' => $catId,
                'locale' => 'en',
                'name' => 'Tattoo Artist',
                'feature_title' => 'Tattoo Artist',
            ]
        ]);
    }
}