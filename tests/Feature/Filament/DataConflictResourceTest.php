<?php

use App\Filament\Resources\DataConflicts\Pages\ListDataConflicts;
use App\Models\DataConflict;
use App\Models\DataSource;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListDataConflicts::class)->assertOk();
});

it('shows existing conflicts on the list page', function () {
    $source = DataSource::create(['name' => 'Test Source', 'type' => 'file', 'url' => 'test.csv']);
    
    $conflict = DataConflict::create([
        'model_class' => 'App\Models\Resources\Student',
        'model_pk_value' => 'S001',
        'data_source_id' => $source->id,
        'incoming_data' => ['first_name_th' => 'New Name'],
        'current_data' => ['first_name_th' => 'Old Name'],
        'status' => 'pending',
    ]);

    Livewire::test(ListDataConflicts::class)
        ->assertCanSeeTableRecords([$conflict]);
});
