<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'Primăria Orașului Tismana', 'type' => 'text', 'group' => 'homepage', 'label' => 'Titlu principal hero', 'sort_order' => 1],
            ['key' => 'hero_subtitle', 'value' => 'Proiect finanțat din fonduri europene pentru dezvoltarea economică locală', 'type' => 'textarea', 'group' => 'homepage', 'label' => 'Subtitlu hero', 'sort_order' => 2],
            ['key' => 'hero_image', 'value' => null, 'type' => 'image', 'group' => 'homepage', 'label' => 'Imagine hero (banner)', 'sort_order' => 3],
            ['key' => 'about_title', 'value' => 'Despre Proiect', 'type' => 'text', 'group' => 'homepage', 'label' => 'Titlu secțiune despre proiect', 'sort_order' => 4],
            ['key' => 'about_content', 'value' => "Proiectul de dezvoltare economică al orașului Tismana este finanțat prin Fondul European de Dezvoltare Regională, în cadrul Programului Operațional Regional.\n\nPrin acest proiect, 21 de firme locale beneficiază de sprijin pentru modernizare, digitalizare și creșterea competitivității pe piața regională.", 'type' => 'textarea', 'group' => 'homepage', 'label' => 'Conținut secțiune despre proiect', 'sort_order' => 5],
            ['key' => 'stats_companies', 'value' => '21', 'type' => 'text', 'group' => 'homepage', 'label' => 'Număr companii implicate', 'sort_order' => 6],
            ['key' => 'stats_jobs', 'value' => '150+', 'type' => 'text', 'group' => 'homepage', 'label' => 'Locuri de muncă create', 'sort_order' => 7],
            ['key' => 'stats_funding', 'value' => '2.5 mil €', 'type' => 'text', 'group' => 'homepage', 'label' => 'Valoare finanțare', 'sort_order' => 8],
            ['key' => 'contact_address', 'value' => 'Str. 1 Decembrie 1918, Nr. 63, Tismana, Gorj', 'type' => 'text', 'group' => 'contact', 'label' => 'Adresa primăriei', 'sort_order' => 1],
            ['key' => 'contact_phone', 'value' => '0253 374 100', 'type' => 'text', 'group' => 'contact', 'label' => 'Telefon primărie', 'sort_order' => 2],
            ['key' => 'contact_email', 'value' => 'primaria@tismana.ro', 'type' => 'text', 'group' => 'contact', 'label' => 'Email primărie', 'sort_order' => 3],
            ['key' => 'footer_text', 'value' => 'Proiect co-finanțat din Fondul European de Dezvoltare Regională prin Programul Operațional Regional.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Text footer (fonduri europene)', 'sort_order' => 1],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
