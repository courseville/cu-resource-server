<?php

use App\Models\Resources\Major;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('can create a major', function () {
    $major = Major::create([
        'majorcode' => '701',
        'name_th' => 'วิศวกรรมคอมพิวเตอร์',
        'name_en' => 'Computer Engineering',
    ]);

    expect($major->majorcode)->toBe('701')
        ->and($major->name_th)->toBe('วิศวกรรมคอมพิวเตอร์')
        ->and($major->name_en)->toBe('Computer Engineering');
});
