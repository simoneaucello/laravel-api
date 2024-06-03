<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;
use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Front End', 'Back End', 'Design', 'UX', 'Laravel', 'Angular', 'React'];
        foreach ($data as $item) {
            $new_item = new Type();
            $new_item->name = $item;
            $new_item->slug = Helper::generateSlug($item, Type::class);

            $new_item->save();
        }
    }
}
