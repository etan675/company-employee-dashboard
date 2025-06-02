<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Corp 1',
            'abn' => '1234567890',
            'email' => 'contact@corp1.com',
            'address' => '123 Corporate Street'
        ]);

        Company::create([
            'name' => 'Corp 2',
            'abn' => '9876543210',
            'email' => 'contact@corp2.com',
            'address' => '124 Corporate Street'
        ]);
    }
}
