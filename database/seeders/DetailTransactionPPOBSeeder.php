<?php

namespace Database\Seeders;

use App\Models\DetailTransactionPPOB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransactionPPOBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailTransactionPPOB::create([
            'id' => 1,
            'transaction_id' => 5,
            'product_id' => 362,
            'nama_pelanggan' => null,
            'nomor_pelanggan' => '8888802737458797',
            'total_tagihan' => 152501,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '111',
            'created_at' => '2023-12-19 15:05:55',
            'updated_at' => '2023-12-19 15:05:15',
        ]);

        DetailTransactionPPOB::create([
            'id' => 2,
            'transaction_id' => 8,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010863874',
            'total_tagihan' => 136080,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '222',
            'created_at' => '2023-12-19 15:05:56',
            'updated_at' => '2023-12-19 15:05:16',
        ]);

        DetailTransactionPPOB::create([
            'id' => 3,
            'transaction_id' => 10,
            'product_id' => 362,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '8888802737458797',
            'total_tagihan' => 152501,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '333',
            'created_at' => '2023-12-19 15:05:56',
            'updated_at' => '2023-12-19 15:05:15',
        ]);

        DetailTransactionPPOB::create([
            'id' => 4,
            'transaction_id' => 35,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010863874',
            'total_tagihan' => 136080,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '444',
            'created_at' => '2023-12-19 15:05:56',
            'updated_at' => '2023-12-19 15:05:16',
        ]);

        DetailTransactionPPOB::create([
            'id' => 5,
            'transaction_id' => 36,
            'product_id' => 362,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '8888802737458797',
            'total_tagihan' => 152501,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '555',
            'created_at' => '2023-12-19 15:05:57',
            'updated_at' => '2023-12-19 15:05:17',
        ]);

        DetailTransactionPPOB::create([
            'id' => 6,
            'transaction_id' => 59,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010887747',
            'total_tagihan' => 142144,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '666',
            'created_at' => '2023-12-19 15:05:57',
            'updated_at' => '2023-12-19 15:05:17',
        ]);

        DetailTransactionPPOB::create([
            'id' => 7,
            'transaction_id' => 63,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010890459',
            'total_tagihan' => 137668,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '777',
            'created_at' => '2023-12-19 15:05:58',
            'updated_at' => '2023-12-19 15:05:18',
        ]);

        DetailTransactionPPOB::create([
            'id' => 8,
            'transaction_id' => 64,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010890459',
            'total_tagihan' => 137668,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '888',
            'created_at' => '2023-12-19 15:05:58',
            'updated_at' => '2023-12-19 15:05:19',
        ]);

        DetailTransactionPPOB::create([
            'id' => 9,
            'transaction_id' => 74,
            'product_id' => 442,
            'nama_pelanggan' => NULL,
            'nomor_pelanggan' => '232010863874',
            'total_tagihan' => 136080,
            'fee_travelsya' => 2500,
            'fee_mili' => 100,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => '999',
            'created_at' => '2023-12-19 15:05:58',
            'updated_at' => '2023-12-19 15:05:18',
        ]);

    }
}
