<?php

use App\CompanyModel;
use Illuminate\Database\Seeder;

class CompanyModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = [
            'Produksi Barang',
            'Produksi Jasa',
            'Reseller',
        ];
        foreach($model as $m){
            CompanyModel::create([
                'name' => $p
            ]);
        }
    }
}
