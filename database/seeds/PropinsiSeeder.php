<?php

use App\Propinsi;
use Illuminate\Database\Seeder;

class PropinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $props = [
            'D.I. Aceh',
            'Bali',
            'Banten',
            'Bengkulu',
            'Gorontalo',
            'D.K.I. Jakarta',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimatan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'Lampung',
            'Maluku',
            'Maluku Utara',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sumatera Utara',
            'D.I. Yogyakarta',
        ];
        foreach($props as $p){
            Propinsi::create([
                'name' => $p
            ]);
        }
    }
}
