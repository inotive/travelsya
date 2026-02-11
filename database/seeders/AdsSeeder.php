<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ad::create([
            'name' => 'mobil',
            'url' => '-',
            'image' => 'media/ads/lpFNgFq1YT506JFC0g1InyQxwxu8pScUrRY7P2GU.jpg',
            'is_active' => 1,
        ]);
        Ad::create([
            'name' => 'produk4',
            'url' => 'travelsya.com',
            'image' => 'media/ads/zuyda4XFInc9IPJgfISjr5ZUx3Z6I4w2dkbDMBDa.png',
            'is_active' => 1,
        ]);
        Ad::create([
            'name' => 'produk-2',
            'url' => '-',
            'image' => 'media/ads/tzDBf85CKspdVd8P3CiXrrcSRhyBTwD1SKXPlP75.png',
            'is_active' => 1,
        ]);
        Ad::create([
            'name' => 'produk-3',
            'url' => '-',
            'image' => 'media/ads/ydwdALMJlwqNV52SgsMWBW7czOrDsEBBZstjKLLW.png',
            'is_active' => 1,
        ]);
        Ad::create([
            'name' => 'produk3',
            'url' => '-',
            'image' => 'media/ads/TxS8NUtOJWJLbE1T9OFJafToCjllLOwR0QSIOxDr.png',
            'is_active' => 1,
        ]);
    }
}
