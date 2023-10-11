<?php

namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create( [
            'id'=>1,
            'category'=>'point',
            'name'=>'point',
            'value'=>100.00,
            'is_percent'=>0,
            'created_at'=>'2023-05-28 14:45:07',
            'updated_at'=>'2023-05-28 14:45:07'
            ] );
            
            
                        
            Setting::create( [
            'id'=>2,
            'category'=>'fee',
            'name'=>'hostel',
            'value'=>5.00,
            'is_percent'=>0,
            'created_at'=>'2023-05-28 14:45:21',
            'updated_at'=>'2023-05-29 07:09:58'
            ] );
            
            
                        
            Setting::create( [
            'id'=>3,
            'category'=>'fee',
            'name'=>'ppob-pulsa',
            'value'=>2000.00,
            'is_percent'=>0,
            'created_at'=>'2023-05-28 14:45:39',
            'updated_at'=>'2023-05-28 14:45:39'
            ] );
            
            
    }
}
