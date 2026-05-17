<?php

use App\Models\Resources\Company;
use App\Models\Resources\StudentInternship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('has many internships', function () {
    $company = Company::create(['name' => 'Test Company']);
    
    $internship = StudentInternship::create([
        'student_id' => 'S001',
        'company_id' => $company->id,
        'intern_year' => 2024,
    ]);

    expect($company->internships)->toHaveCount(1);
    expect($company->internships->first()->id)->toBe($internship->id);
});

it('belongs to a company', function () {
    $company = Company::create(['name' => 'Test Company']);
    
    $internship = StudentInternship::create([
        'student_id' => 'S001',
        'company_id' => $company->id,
        'intern_year' => 2024,
    ]);

    expect($internship->company->id)->toBe($company->id);
});
