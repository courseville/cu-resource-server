<?php

use App\Models\Resources\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('can create a department', function () {
    $department = Department::create([
        'depcode' => '2110',
        'name_th' => 'ภาควิชาวิศวกรรมคอมพิวเตอร์',
        'name_en' => 'Department of Computer Engineering',
    ]);

    expect($department->depcode)->toBe('2110')
        ->and($department->name_th)->toBe('ภาควิชาวิศวกรรมคอมพิวเตอร์')
        ->and($department->name_en)->toBe('Department of Computer Engineering');
});
