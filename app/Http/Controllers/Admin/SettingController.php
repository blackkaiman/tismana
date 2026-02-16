<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::orderBy('group')->orderBy('sort_order')->get()->groupBy('group');
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $key = $setting->key;

            if ($setting->type === 'image') {
                if ($request->hasFile("settings.{$key}")) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $path = $request->file("settings.{$key}")->store('settings', 'public');
                    Setting::set($key, $path);
                }
            } else {
                if ($request->has("settings.{$key}")) {
                    Setting::set($key, $request->input("settings.{$key}"));
                }
            }
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Setările au fost salvate cu succes.');
    }
}
