<?php

use App\Models\DataConflict;
use App\Models\DataSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('can create a data conflict', function () {
    $source = DataSource::create(['name' => 'Test Source', 'type' => 'file', 'url' => 'test.csv']);
    
    $conflict = DataConflict::create([
        'model_class' => 'App\Models\Resources\Student',
        'model_pk_value' => 'S001',
        'data_source_id' => $source->id,
        'incoming_data' => ['first_name_th' => 'New Name'],
        'current_data' => ['first_name_th' => 'Old Name'],
    ]);

    expect($conflict->model_class)->toBe('App\Models\Resources\Student')
        ->and($conflict->incoming_data['first_name_th'])->toBe('New Name')
        ->and($conflict->current_data['first_name_th'])->toBe('Old Name');
});
