<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Despre Proiect',
                'slug' => 'despre-proiect',
                'content' => '<h2>Despre Proiect</h2><p>Proiectul „Dezvoltarea economică a orașului Tismana" este co-finanțat din Fondul European de Dezvoltare Regională.</p><p>Obiectivul principal al proiectului este sprijinirea a 21 de firme locale pentru modernizarea activității, crearea de noi locuri de muncă și creșterea competitivității pe piața regională și națională.</p><h3>Obiective specifice</h3><ul><li>Sprijinirea antreprenoriatului local</li><li>Crearea a minimum 150 de locuri de muncă</li><li>Digitalizarea și modernizarea proceselor de producție</li><li>Dezvoltarea competențelor profesionale</li></ul>',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Politica de confidențialitate',
                'slug' => 'politica-confidentialitate',
                'content' => '<h2>Politica de confidențialitate</h2><p>Primăria Orașului Tismana respectă confidențialitatea datelor dumneavoastră personale, în conformitate cu Regulamentul (UE) 2016/679 (GDPR).</p>',
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
