<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Gallery::updateOrCreate(
                ['image' => "gal-$i.jpg"],
                [
                    'sort_order' => $i,
                    'is_active' => true
                ]
            );
        }
    }
}
