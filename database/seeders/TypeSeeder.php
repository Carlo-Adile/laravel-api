<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Fullstack', 'Front-end', 'Back-end', 'IoT'];

        foreach($types as $type){
            $newCat = new Type();
            $newCat->name = $type;
            $newCat->slug = Str::slug($newCat->name, '-');
            $newCat->save();
        }
    }
}
