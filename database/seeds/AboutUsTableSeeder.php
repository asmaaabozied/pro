<?php

use Illuminate\Database\Seeder;
use App\Models\AboutUs;
use App\Models\Language;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about_us = new AboutUs();
        $data = [
            'slug' => 'about-us',
            'title_en' => trans('aboutus.fields.title_en'),
            'description_en' => trans('aboutus.fields.description_en'),
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = trans('aboutus.fields.title_'.$language);
            $data['description_'.$language] = trans('aboutus.fields.description_'.$language);
        }
        $about_us->fill($data)->save();

        $about_us = new AboutUs();
        $data = [
            'slug' => 'terms-and-conditions',
            'title_en' => trans('aboutus.fields.title_en'),
            'description_en' => trans('aboutus.fields.description_en'),
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = trans('aboutus.fields.title_'.$language);
            $data['description_'.$language] = trans('aboutus.fields.description_'.$language);
        }
        $about_us->fill($data)->save();

        $about_us = new AboutUs();
        $data = [
            'slug' => 'privacy-and-policy',
            'title_en' => trans('aboutus.fields.title_en'),
            'description_en' => trans('aboutus.fields.description_en'),
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = trans('aboutus.fields.title_'.$language);
            $data['description_'.$language] = trans('aboutus.fields.description_'.$language);
        }
        $about_us->fill($data)->save();
    }
}
