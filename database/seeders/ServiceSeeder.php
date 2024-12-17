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
            'id'=>5,
            'name'=>'pulsa',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>6,
            'name'=>'data',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>7,
            'name'=>'pln',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>8,
            'name'=>'telkom',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>9,
            'name'=>'bpjs',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>10,
            'name'=>'negara',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>11,
            'name'=>'hostel',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>12,
            'name'=>'hotel',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>13,
            'name'=>'finance',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>14,
            'name'=>'tv-internet',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>15,
            'name'=>'ewallet',
            'deleted_at'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL
            ] );



            Service::create( [
            'id'=>16,
            'name'=>'listrik-token',
            'deleted_at'=>NULL,
            'created_at'=>'2023-10-02 00:37:37',
            'updated_at'=>'2023-10-02 00:37:38'
            ] );


    }
}
