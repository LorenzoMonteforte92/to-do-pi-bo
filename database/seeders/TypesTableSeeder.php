<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventTypes = [

            'musica',
            'food',
            'teatro',
            'stand up',
            'sport',
            'festival',
            'cinema',
            'workshop',
            'arte',
            'talk',
            'seminario',
            'riunione',
            'open day',
            'giochi da tavolo',
            'concerti',

        ];

        foreach($eventTypes as $singleEventType){
            $newEventType = new Type();
            $newEventType->name = $singleEventType;
            $newEventType->slug = Str::slug($newEventType->name, '-');
            $newEventType->save();
    
        }
    }
}
