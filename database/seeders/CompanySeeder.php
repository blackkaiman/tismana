<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            'SC Tismana Construct SRL',
            'SC Gorj Agro SRL',
            'SC Montaj Instalații SRL',
            'SC Tismana Prest Servicii SRL',
            'SC Auto Trans Gorj SRL',
            'SC Mecanica Fină SRL',
            'SC Tismana Wood SRL',
            'SC Electrotech Solutions SRL',
            'SC Alimentara Tismana SRL',
            'SC Carpați Turism SRL',
            'SC Gorj Textil SRL',
            'SC Tismana IT Services SRL',
            'SC Pane Dolce SRL',
            'SC Verde Organic SRL',
            'SC Mobilier Artizanal SRL',
            'SC Tismana Farma SRL',
            'SC Aqua Gorj SRL',
            'SC Tismana Events SRL',
            'SC Consiliere Fiscală SRL',
            'SC Gorj Energy SRL',
            'SC Tismana Print SRL',
        ];

        foreach ($companies as $index => $name) {
            Company::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => "Compania {$name} este o firmă locală din orașul Tismana, parte din proiectul de dezvoltare economică finanțat din fonduri europene. Activitatea companiei contribuie la creșterea economică a comunității locale.",
                    'website' => 'https://www.' . Str::slug($name, '') . '.ro',
                    'email' => 'contact@' . Str::slug($name, '') . '.ro',
                    'phone' => '0253' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                    'address' => 'Str. Principală nr. ' . ($index + 1) . ', Tismana, Gorj',
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }
}
