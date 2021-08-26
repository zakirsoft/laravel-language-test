<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\File;
use Modules\Language\Entities\Language;
use Illuminate\Contracts\Support\Renderable;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $languages = Language::get();
        return view('language::index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $path = base_path('modules/language/resources/json/languages.json');
        $translations = json_decode(file_get_contents($path), true);

        // dd($translations);
        return view('language::create', compact('translations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required'
            ],
            [
                'name.required' => 'You must select a language',
                'code.required' => 'You must select a language code'
            ],
        );

        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        if ($language) {
            $baseFile = base_path('resources/lang/default.json');
            $fileName = base_path('resources/lang/' . Str::slug($request->code) . '.json');
            copy($baseFile, $fileName);
        }
        return back()->with('msg', 'Language added successfully!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('language::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Language $language)
    {
        $path = base_path('modules/language/resources/json/languages.json');
        $translations = json_decode(file_get_contents($path), true);

        return view('language::edit', compact('translations', 'language'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Language $language)
    {
        // validation
        // $request->validate(
        //     [
        //         'name' => 'required',
        //         'code' => 'required'
        //     ],
        //     [
        //         'name.required' => 'You must select a language',
        //         'code.required' => 'You must select a language code'
        //     ],
        // );

        // rename file
        $oldFile = $language->code . '.json';
        $oldName = base_path('resources/lang/' . $oldFile);
        $newFile = Str::slug($request->code) . '.json';
        $newName = base_path('resources/lang/' . $newFile);

        $fileRename = rename($oldName, $newName);

        // update
        $language->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return back()->with('msg', 'Language updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Language $language)
    {
        // delete file
        if (File::exists(base_path('resources/lang/' . $language->code . '.json'))) {
            File::delete(base_path('resources/lang/' . $language->code . '.json'));
        }

        $language->delete();

        return back()->with('msg', 'Language deleted successfully!');
    }
}
