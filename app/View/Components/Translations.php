<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class Translations extends Component
{
    
    public function __construct()
    {
        //
    }

    public function render()
    {
        $locale = App::getLocale();
 
        $translations = [];
        $phpTranslations = [];
        $jsonTranslations = [];
 
            if (File::exists(lang_path("$locale"))) {
                $phpTranslations = collect(File::allFiles(lang_path($locale)))
                    ->filter(function ($file) {
                        return $file->getExtension() === "php";
                    })->flatMap(function ($file) {
                        return Arr::dot(File::getRequire($file->getRealPath()));
                    })->toArray();
            }
 
            if (File::exists(lang_path($locale.".json"))) {
                $jsonTranslations = json_decode(File::get(lang_path($locale.".json")), true);
            }
 
            $translations=array_merge($phpTranslations, $jsonTranslations);
 
        return view('components.translations', [
            'translations' => $translations
        ]);
    }

   /*  {
        $locale = App::getLocale();
 
            $translations = Cache::rememberForever("translations_.".$locale, function () use ($locale) {
            $phpTranslations = [];
            $jsonTranslations = [];
 
            if (File::exists(lang_path($locale))) {
                $phpTranslations = collect(File::allFiles(lang_path($locale)))
                    ->filter(function ($file) {
                        return $file->getExtension() === "php";
                    })->flatMap(function ($file) {
                        return Arr::dot(File::getRequire($file->getRealPath()));
                    })->toArray();
            }
 
            if (File::exists(lang_path($locale.".json"))) {
                $jsonTranslations = json_decode(File::get(lang_path($locale.".json")), true);
            }
 
            return array_merge($phpTranslations, $jsonTranslations);
        });
 
        return view('components.translations', [
            'translations' => $translations
        ]);
    } */

}
