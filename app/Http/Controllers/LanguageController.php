<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::get();
        return view('language.index', compact('languages'));
    }

    public function create()
    {
        return view('language.create');
    }

    public function store(Request $request)
    {
        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        if ($language) {
            $baseFile = base_path('resources/lang/default.json');
            $fileName = base_path('resources/lang/' . Str::slug($request->code) . '.json');
            copy($baseFile, $fileName);
        }
        return back();
    }

    public function show(Language $language)
    {
        //
    }

    public function transUpdate(Request $request)
    {
        // \Log::debug($request->all());
        $language = Language::findOrFail($request->lang_id);
        $data = file_get_contents(base_path('resources/lang/' . $language->code . '.json'));

        $translations = json_decode($data, true);

        foreach ($translations as $key => $value) {
            if ($request->$key) {
                $translations[$key] = $request->$key;
            } else {
                $translations[$key] = "";
            }
        }

        file_put_contents(base_path('resources/lang/' . $language->code . '.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));
        return back();
    }

    public function langView($code)
    {
        $path = base_path('resources/lang/' . $code . '.json');
        $translations = json_decode(file_get_contents($path), true);
        $language = Language::where('code', $code)->first();
        return view('language.lang_view', compact('language', 'translations'));

        // \Log::debug($translations);
    }

    public function setLanguage($language)
    {
        // \Log::info($language);

        $languagesArray = Language::pluck('slug')->toArray();

        if (!in_array($language, $languagesArray)) {
            abort(400);
        }

        // \Log::info('set translation');

        App::setLocale($language);
        return redirect()->back();
    }


    public function changeLanguage($lang)
    {
        session()->put('lang', $lang);
        app()->setLocale($lang);

        return back();
    }
}
