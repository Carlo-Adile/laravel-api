<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Laravel', 'Vue.js', 'HTML', 'CSS', 'Javascript', 'PHP', 'mySQL'];
        
        foreach($types as $type){
            $newCat = new Technology();
            $newCat->name = $type;
            $newCat->slug = Str::slug($newCat->name, '-');
            $newCat->save();
        }
    }
}
