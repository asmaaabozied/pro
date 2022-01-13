<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Language;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::whereIn('id', [12, 9, 13, 14, 15, 16])->forceDelete();

        $category = new Category();
        $data = [
            'id'        => 12,
            'title_en'  => 'Cars',
            'image'     => 'storage/Categories/menu/cars.png',
            'icon'      => 'storage/Categories/menu/carsicon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 1,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Cars';
        }
        $category->fill($data)->save();

        $category = new Category();
        $data = [
            'id'        => 9,
            'title_en'  => 'Motorcycles',
            'image'     => 'storage/Categories/menu/Motorcycles.png',
            'icon'      => 'storage/Categories/menu/motorcycle-icon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 2,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Motorcycles';
        }
        $category->fill($data)->save();

        $category = new Category();
        $data = [
            'id'        => 13,
            'title_en'  => 'Trucks',
            'image'     => 'storage/Categories/menu/Trucks.png',
            'icon'      => 'storage/Categories/menu/TrucksIcon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 3,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Trucks';
        }
        $category->fill($data)->save();

        $category = new Category();
        $data = [
            'id'        => 14,
            'title_en'  => 'Boats',
            'image'     => 'storage/Categories/menu/Boats.png',
            'icon'      => 'storage/Categories/menu/boatIcon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 4,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Boats';
        }
        $category->fill($data)->save();

        $category = new Category();
        $data = [
            'id'        => 15,
            'title_en'  => 'Bikes',
            'image'     => 'storage/Categories/menu/bicycles.png',
            'icon'      => 'storage/Categories/menu/Bike_icon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 5,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Bikes';
        }
        $category->fill($data)->save();

        $category = new Category();
        $data = [
            'id'        => 16,
            'title_en'  => 'couch',
            'image'     => 'storage/Categories/menu/couch.png',
            'icon'      => 'storage/Categories/menu/couchIcon.png',
            'menu'      => true,
            'parent'    => null,
            'active'    => true,
            'order'     => 6,
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'couch';
        }
        $category->fill($data)->save();
    }
}
