<?php

use App\Models\Resources\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('can create a faculty', function () {
    $faculty = Faculty::create([
        'faccode' => '21',
        'name_th' => 'วิศวกรรมศาสตร์',
        'name_en' => 'Engineering',
    ]);

    expect($faculty->faccode)->toBe('21')
        ->and($faculty->name_th)->toBe('วิศวกรรมศาสตร์')
        ->and($faculty->name_en)->toBe('Engineering');
});
