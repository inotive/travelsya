<?php

namespace Database\Seeders;
use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create( [
            'id'=>1,
            'name'=>'pulsa',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>2,
            'name'=>'data',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>3,
            'name'=>'pln',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>4,
            'name'=>'telkom',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>5,
            'name'=>'bpjs',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>6,
            'name'=>'negara',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>7,
            'name'=>'hostel',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>8,
            'name'=>'hotel',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>9,
            'name'=>'finance',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>10,
            'name'=>'tv-internet',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
                        
            Service::create( [
            'id'=>11,
            'name'=>'ewallet',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );
            
            
    }
}
