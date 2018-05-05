<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = [
            'Basic',
            'HR',
            'Finance',
            'Sales',
            'Marketing',
        ];
        foreach($section as $i => $s){
            Section::create([
                'name' => $s,
                'order' => $i,
            ]);
        }
    }
}
