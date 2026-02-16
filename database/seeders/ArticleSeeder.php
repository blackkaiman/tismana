<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        $templates = [
            'Lansare oficială a activității companiei %s',
            'Rezultatele primului trimestru pentru %s',
            'Compania %s participă la târgul regional de afaceri',
            'Noi locuri de muncă create de %s',
            '%s investește în echipamente moderne',
        ];

        foreach ($companies as $company) {
            $count = rand(2, 3);
            for ($i = 0; $i < $count; $i++) {
                $template = $templates[$i % count($templates)];
                $title = sprintf($template, $company->name);

                Article::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'company_id' => $company->id,
                        'title' => $title,
                        'excerpt' => "Aflați ultimele noutăți despre activitatea companiei {$company->name} în cadrul proiectului fonduri europene Tismana.",
                        'content' => "<h2>{$title}</h2><p>Compania <strong>{$company->name}</strong> continuă să se dezvolte în cadrul proiectului finanțat din fonduri europene, implementat de Primăria Orașului Tismana.</p><p>Prin intermediul acestui proiect, firma beneficiază de sprijin financiar pentru modernizarea activității și crearea de noi locuri de muncă în comunitatea locală din Tismana, județul Gorj.</p><h3>Obiective principale</h3><ul><li>Creșterea capacității de producție</li><li>Modernizarea echipamentelor</li><li>Crearea de noi locuri de muncă</li><li>Dezvoltarea competențelor angajaților</li></ul><p>Proiectul este co-finanțat din Fondul European de Dezvoltare Regională prin Programul Operațional Regional.</p>",
                        'is_published' => true,
                        'published_at' => now()->subDays(rand(1, 90)),
                    ]
                );
            }
        }
    }
}
