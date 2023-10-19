<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create( [
            'id'=>1,
            'no_inv'=>'INV-20230328-PPOB-1680029051',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6423357d5967e2d5c0f54dfc',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
            ] );
            
            
                        
            Transaction::create( [
            'id'=>2,
            'no_inv'=>'INV-20230329-PPOB-1680130158',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6424c073efa9027a0e51836f',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>3,
            'no_inv'=>'INV-20230401-PPOB-1680320167',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6427a6a9f750fdced2d3c347',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>4,
            'no_inv'=>'INV-20230401-PPOB-1680338793',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6427ef6b476c3b8d7fdb52c5',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>5,
            'no_inv'=>'INV-20230401-PPOB-1680368019',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64286194476c3ba4c4dbaafd',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>6,
            'no_inv'=>'INV-20230402-PPOB-1680453043',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6429adb681e688fd4ecc8443',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>7,
            'no_inv'=>'INV-20230404-PPOB-1680572449',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642b80231f43660474f36a6d',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>8,
            'no_inv'=>'INV-20230404-PPOB-1680574418',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642b87d31f43667ceef374b6',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>9,
            'no_inv'=>'INV-20230404-HOSTEL-1680634305',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c71c37dfc9c6ac96817e4',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>10,
            'no_inv'=>'INV-20230404-HOSTEL-1680634393',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c721be7e27f90b40a0ed9',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>11,
            'no_inv'=>'INV-20230404-PPOB-1680634430',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c723f02f2fc9f66f1c16c',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'EWALLET',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>12,
            'no_inv'=>'INV-20230404-PPOB-1680634881',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c740302f2fc5478f1c30a',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>13,
            'no_inv'=>'INV-20230404-HOSTEL-1680635030',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c7498e7e27f9f7e0a1143',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>14,
            'no_inv'=>'INV-20230404-PPOB-1680642564',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c920502f2fca2e0f1d9a9',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>15,
            'no_inv'=>'INV-20230404-HOSTEL-1680642782',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642c92e07dfc9cc97f683088',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>16,
            'no_inv'=>'INV-20230406-HOSTEL-1680764063',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/642e6ca2e7e27f0f890bf6d5',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>17,
            'no_inv'=>'INV-20230413-HOSTEL-1681390428',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6437fb5e5686cfb3ea252475',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>18,
            'no_inv'=>'INV-20230413-PPOB-1681410146',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6438486467856e549a66a1bc',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>19,
            'no_inv'=>'INV-20230413-PPOB-1681413572',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/643855c567856e355c66accf',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>20,
            'no_inv'=>'INV-20230420-PPOB-1682005212',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64415cde5686cfe6282dd86e',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>21,
            'no_inv'=>'INV-20230420-PPOB-1682009561',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64416ddb5686cf90132de5f2',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>22,
            'no_inv'=>'INV-20230420-PPOB-1682014194',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64417ff75686cf39472df413',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>23,
            'no_inv'=>'INV-20230420-PPOB-1682014221',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6441800f6f99867059c461d0',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>24,
            'no_inv'=>'INV-20230420-PPOB-1682014776',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6441823a67856e123b6f7975',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>25,
            'no_inv'=>'INV-20230426-PPOB-1682496948',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6448ddb55686cf96d7347fac',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>26,
            'no_inv'=>'INV-20230427-PPOB-1682575485',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/644a10801bf1986d11ea3bd0',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>27,
            'no_inv'=>'INV-20230510-PPOB-1683685806',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645b01b0e119c64e283de48e',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>8,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>28,
            'no_inv'=>'INV-20230510-PPOB-1683700317',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645b3a5ee119c6a0763e4bd0',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>29,
            'no_inv'=>'INV-20230511-PPOB-1683764801',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c3644e119c6087c3f9a68',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>8,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>30,
            'no_inv'=>'INV-20230511-PPOB-1683765778',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c3a1352b2976c4bb89ccb',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>8,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>31,
            'no_inv'=>'INV-20230511-PPOB-1683784458',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c830b2762c5b7d2c95188',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>32,
            'no_inv'=>'INV-20230511-PPOB-1683784529',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c835252b2979189b8fad2',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>33,
            'no_inv'=>'INV-20230511-PPOB-1683784630',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c83b7675a978bb32138b2',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>34,
            'no_inv'=>'INV-20230511-PPOB-1683785083',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645c858352b297ce7eb8fd8e',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>35,
            'no_inv'=>'INV-20230512-PPOB-1683854137',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645d933d056a2b78535bc3c2',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>36,
            'no_inv'=>'INV-20230512-PPOB-1683855692',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645d994d056a2bc4815bc978',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>37,
            'no_inv'=>'INV-20230512-PPOB-1683855926',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645d9a37056a2b7ddf5bca6f',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>38,
            'no_inv'=>'INV-20230512-PPOB-1683856881',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645d9df21d87fa6d70dd8108',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>39,
            'no_inv'=>'INV-20230512-PPOB-1683859325',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645da77e1d87fa078cdd9269',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>40,
            'no_inv'=>'INV-20230512-PPOB-1683859355',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645da79b204c31786c683f44',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>41,
            'no_inv'=>'INV-20230512-PPOB-1683859807',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/645da960056a2bc5cc5be1d9',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>42,
            'no_inv'=>'INV-20230514-PPOB-1684086739',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64611fd6056a2bdac15f61ae',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>43,
            'no_inv'=>'INV-20230514-DATA-1684090347',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64612dec204c3136d06bc3e6',
            'service'=>'data',
            'service_id'=>3,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>44,
            'no_inv'=>'INV-20230518-PPOB-1684438754',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/64667ee4056a2bbfd76505c8',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>45,
            'no_inv'=>'INV-20230519-PPOB-1684481727',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/646726c07b4a4c6f0ba7adb9',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>46,
            'no_inv'=>'INV-20230521-PPOB-1684644226',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469a185bbbb242643cfd8a9',
            'service'=>'ppob',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>47,
            'no_inv'=>'INV-20230521-PLN-1684646320',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469a9b3d43b2bc533e6e201',
            'service'=>'pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>48,
            'no_inv'=>'INV-20230521-PLN-1684646374',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469a9e9d9bd96137e5bddc4',
            'service'=>'pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>49,
            'no_inv'=>'INV-20230521-PLN-1684646536',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469aa8ad9bd9622545bde5b',
            'service'=>'ppob-pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>50,
            'no_inv'=>'INV-20230521-PLN-1684646662',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469ab0ad9bd9632ef5bdeb9',
            'service'=>'ppob-pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>51,
            'no_inv'=>'INV-20230521-PPOB-PLN-1684648590',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469b292bbbb2465c4cfe78e',
            'service'=>'ppob-pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>52,
            'no_inv'=>'INV-20230521-PPOB-PLN-1684655720',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469ce6bbbbb24294fd001d3',
            'service'=>'ppob-pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>53,
            'no_inv'=>'INV-20230521-HOSTEL-1684655815',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469cec77dd9722cb5462fc3',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>54,
            'no_inv'=>'INV-20230521-HOSTEL-1684656290',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d0a37dd9728a7c46315a',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>55,
            'no_inv'=>'INV-20230521-HOSTEL-1684656382',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d0ffd43b2bb4dbe7060b',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>56,
            'no_inv'=>'INV-20230521-HOSTEL-1684656671',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d2207dd9720f934632c2',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>57,
            'no_inv'=>'INV-20230521-PPOB-PLN-1684657116',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d3dfbbbb24d154d006b2',
            'service'=>'ppob-pln',
            'service_id'=>0,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>58,
            'no_inv'=>'INV-20230521-PPOB-PULSA-1684657595',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d5bb7dd972f22b463633',
            'service'=>'ppob-pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>59,
            'no_inv'=>'INV-20230521-PPOB-PULSA-1684657621',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d5dd7dd9727235463660',
            'service'=>'ppob-pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>60,
            'no_inv'=>'INV-20230521-HOSTEL-1684658443',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/web/6469d90cd9bd9635d15c0916',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>61,
            'no_inv'=>'INV-20230603-PPOB-PULSA-1685764511',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ab9a2339798ad5329559a',
            'service'=>'ppob-pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>62,
            'no_inv'=>'INV-20230604-HOSTEL-1685912872',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647cfd2975290ece66ac6c5e',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>63,
            'no_inv'=>'INV-20230604-PULSA-1685913208',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647cfe793397987cc52ccb2d',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>64,
            'no_inv'=>'INV-20230604-PULSA-1685913291',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647cfecc33979814fc2ccb83',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>65,
            'no_inv'=>'INV-20230605-PULSA-1685944496',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647d78b375290e99f6ad3f66',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>66,
            'no_inv'=>'INV-20230605-NEGARA-1685944616',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647d792bb2b1907b4616bc2f',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>67,
            'no_inv'=>'INV-20230605-PLN-1685944656',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647d795033979807f42d9881',
            'service'=>'pln',
            'service_id'=>3,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>2,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>68,
            'no_inv'=>'INV-20230606-NEGARA-1686019842',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647e9f053397985ae72f4cd6',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>69,
            'no_inv'=>'INV-20230606-NEGARA-1686020084',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647e9ff83397981acd2f4e2b',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>70,
            'no_inv'=>'INV-20230606-PULSA-1686041891',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef52533979817e02fdb7e',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>71,
            'no_inv'=>'INV-20230606-PULSA-1686042026',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef5b079b4190f2ab01782',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>72,
            'no_inv'=>'INV-20230606-PULSA-1686042120',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef60ab2b19088351906c4',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>73,
            'no_inv'=>'INV-20230606-PULSA-1686042784',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef8a233979893c52fe142',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>74,
            'no_inv'=>'INV-20230606-NEGARA-1686042921',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef92d79b419327eb01c75',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>75,
            'no_inv'=>'INV-20230606-NEGARA-1686043012',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ef98479b419409cb01d08',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>76,
            'no_inv'=>'INV-20230607-PULSA-1686100300',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647fd94eb2b1902a951a5183',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>77,
            'no_inv'=>'INV-20230607-PULSA-1686107665',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/647ff6133397984c18315845',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>78,
            'no_inv'=>'INV-20230607-NEGARA-1686110451',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648000f633979833f8316fdb',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>79,
            'no_inv'=>'INV-20230607-PULSA-1686116797',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648019bd79b4197a30b1cf88',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>80,
            'no_inv'=>'INV-20230607-PULSA-1686121181',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64802ade339798124131b18d',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>81,
            'no_inv'=>'INV-20230607-PLN-1686122269',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64802f20b2b19001651ae7af',
            'service'=>'pln',
            'service_id'=>3,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>7,
            'status'=>'EXPIRED',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>82,
            'no_inv'=>'INV-20230608-PULSA-1686186417',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648129b533979891ac332a76',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>83,
            'no_inv'=>'INV-20230608-PULSA-1686186497',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64812a0133979879ce332afc',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>84,
            'no_inv'=>'INV-20230608-PULSA-1686186756',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64812b0579b41971e8b3621f',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'EWALLET',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>85,
            'no_inv'=>'INV-20230610-PULSA-1686382876',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/6484291d36322bed975de725',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>86,
            'no_inv'=>'INV-20230610-PULSA-1686391562',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64844b0bf314482569d732e7',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>87,
            'no_inv'=>'INV-20230610-PULSA-1686391617',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64844b41f314488079d73355',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>88,
            'no_inv'=>'INV-20230612-HOSTEL-1686536098',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64867fa8f314488103db28c1',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>89,
            'no_inv'=>'INV-20230612-PULSA-1686553020',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/6486c1bd36322bc72662a6c7',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>90,
            'no_inv'=>'INV-20230613-PULSA-1686639291',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648812bc3a1e4b8bfeff13ef',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>15,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>91,
            'no_inv'=>'INV-20230613-NEGARA-1686642207',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/64881e2312cefc48dc32594f',
            'service'=>'negara',
            'service_id'=>6,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>92,
            'no_inv'=>'INV-20230613-PULSA-1686656616',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/6488566841fbf482eb07efbd',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'BANK_TRANSFER',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>0,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>93,
            'no_inv'=>'INV-20230615-PULSA-1686812151',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648ab5f975dd3a212b87bf5d',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>6745,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>94,
            'no_inv'=>'INV-20230615-PULSA-1686854934',
            'req_id'=>NULL,
            'link'=>'https://checkout-staging.xendit.co/v2/648b5d18f6e4ed777f5f51d4',
            'service'=>'pulsa',
            'service_id'=>1,
            'payment'=>'xendit',
            'payment_method'=>'QR_CODE',
            'payment_channel'=>NULL,
            'user_id'=>17,
            'status'=>'PAID',
            'total'=>6910,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>99,
            'no_inv'=>'INV-20230621-HOTEL-1687341937',
            'req_id'=>'HTL-1687341939',
            'link'=>'https://checkout-staging.xendit.co/v2/6492cb721876023904adf34d',
            'service'=>'hotel',
            'service_id'=>8,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'EXPIRED',
            'total'=>121200,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>106,
            'no_inv'=>'INV-20230622-HOSTEL-1687463160',
            'req_id'=>'HST-1687463162',
            'link'=>'https://checkout-staging.xendit.co/v2/6494a4f997b2f65c41f771cf',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>1212000,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>107,
            'no_inv'=>'INV-20230622-HOSTEL-1687463168',
            'req_id'=>'HST-1687463189',
            'link'=>'https://checkout-staging.xendit.co/v2/6494a50197b2f67325f771e6',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>3,
            'status'=>'PENDING',
            'total'=>110412000,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>108,
            'no_inv'=>'INV-20230622-HOSTEL-1687463388',
            'req_id'=>'HST-1687463399',
            'link'=>'https://checkout-staging.xendit.co/v2/6494a5e69a4b48850395c27f',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'PENDING',
            'total'=>110412000,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
            
            
                        
            Transaction::create( [
            'id'=>109,
            'no_inv'=>'INV-20230622-HOSTEL-1687467039',
            'req_id'=>'HST-1687467041',
            'link'=>'https://checkout-staging.xendit.co/v2/6494b4209a4b48459895de63',
            'service'=>'hostel',
            'service_id'=>7,
            'payment'=>'xendit',
            'payment_method'=>NULL,
            'payment_channel'=>NULL,
            'user_id'=>5,
            'status'=>'PENDING',
            'total'=>1212000,
            'deleted_at'=>NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ] );
    }
}
