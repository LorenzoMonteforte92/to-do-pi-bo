<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organiser;
use Illuminate\Support\Str;

class OrganisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisers = [
            
            'Locale',
            'Associazione',
            'Organizzatore privato',
            'Collettivo'
        ];

        foreach($organisers as $singleOrganiser){
            $newOrganiser = new Organiser();
            $newOrganiser->name = $singleOrganiser;
            $newOrganiser->slug = Str::slug($newOrganiser->name, '-');
            $newOrganiser->save();
    
        }
    }
}
