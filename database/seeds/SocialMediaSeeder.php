<?php

use Illuminate\Database\Seeder;
use App\Models\SocialMediaLink;
use App\Models\Language;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMediaLink::truncate();
        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Facebook',
            'link'      => 'https://www.facebook.com/',
            'icon'      => 'fa fa-facebook',
            'active'    => true,
            'description_en' => 'Facebook',
            'background_color' => '#4267B2',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Facebook';
            $data['description_'.$language] = 'Facebook';
        }
        $socialMediaLink->fill($data)->save();

        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Twitter',
            'link'      => 'https://www.twitter.com/',
            'icon'      => 'fa fa-twitter',
            'active'    => true,
            'description_en' => 'Twitter',
            'background_color' => '#1DA1F2',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Twitter';
            $data['description_'.$language] = 'Twitter';
        }
        $socialMediaLink->fill($data)->save();

        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Instagram',
            'link'      => 'https://www.instagram.com/',
            'icon'      => 'fa fa-instagram',
            'active'    => true,
            'description_en' => 'Instagram',
            'background_color' => '#f77737',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Instagram';
            $data['description_'.$language] = 'Instagram';
        }
        $socialMediaLink->fill($data)->save();

        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Snapchat',
            'link'      => 'https://www.snapchat.com/',
            'icon'      => 'fa fa-snapchat-ghost',
            'active'    => true,
            'description_en' => 'Snapchat',
            'background_color' => '#FFFC00',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Snapchat';
            $data['description_'.$language] = 'Snapchat';
        }
        $socialMediaLink->fill($data)->save();

        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Phone',
            'link'      => 'tel:+9700000000',
            'icon'      => 'fa fa-mobile',
            'active'    => true,
            'description_en' => '+9700000000',
            'background_color' => 'red',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Phone';
            $data['description_'.$language] = '+9700000000';
        }
        $socialMediaLink->fill($data)->save();

        $socialMediaLink = new SocialMediaLink();
        $data = [
            'title_en'  => 'Email',
            'link'      => 'mailTo:info@partoro.com',
            'icon'      => 'fa fa-envelope',
            'active'    => true,
            'description_en' => 'info@partoro.com',
            'background_color' => 'brown',
        ];
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        foreach ($languages as $language) {
            $data['title_'.$language] = 'Email';
            $data['description_'.$language] = 'info@partoro.com';
        }
        $socialMediaLink->fill($data)->save();
    }
}
