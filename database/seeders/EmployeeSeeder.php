<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $corp1 = Company::where('name', 'Corp 1')->first();
        $corp2 = Company::where('name', 'Corp 2')->first();

        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'johnsmith@corp1.com',
            'address' => '123 Corporate Street',
            'company_id' => $corp1->id,
        ]);

        Employee::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@corp2.com',
            'address' => '124 Corporate Street',
            'company_id' => $corp2->id,
        ]);
    }
}
