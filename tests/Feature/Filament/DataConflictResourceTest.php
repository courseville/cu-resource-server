<?php

use App\Filament\Resources\DataConflicts\Pages\ViewDataConflict;
use App\Livewire\DataConflictComparisonTable;
use App\Models\DataConflict;
use App\Models\DataSource;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    config(['app.env' => 'local']);
    $this->actingAs(User::factory()->create(), 'admin');
});

it('renders the view page and the comparison table component', function () {
    $source = DataSource::create([
        'name' => 'Test Source',
        'type' => 'file',
        'url' => 'test.csv',
    ]);

    // Add transformer mappings for student first_name_th (to make it a mapped field)
    \Illuminate\Support\Facades\DB::table('transformer_mappings')->insert([
        'data_source_id' => $source->id,
        'model' => 'App\Models\Resources\Student',
        'field' => 'first_name_th',
        'mapping' => 'first_name_th',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $conflict = DataConflict::create([
        'model_class' => 'App\Models\Resources\Student',
        'model_pk_value' => 'S001',
        'data_source_id' => $source->id,
        'incoming_data' => [
            'first_name_th' => 'New Name',
            'last_name_th' => 'Same Surname',
            'unmapped_field' => 'New Unmapped Value',
        ],
        'current_data' => [
            'first_name_th' => 'Old Name',
            'last_name_th' => 'Same Surname',
            'unmapped_field' => 'Old Unmapped Value',
        ],
        'status' => 'pending',
    ]);

    // Test that ViewDataConflict renders successfully
    Livewire::test(ViewDataConflict::class, ['record' => $conflict->getKey()])
        ->assertOk();

    // Test that the comparison table component renders successfully and has correct comparison data
    $test = Livewire::test(DataConflictComparisonTable::class, ['record' => $conflict])
        ->assertOk();

    $records = $test->instance()->getTable()->getRecords();
    
    expect($records)->toHaveKey('first_name_th')
        ->and($records)->toHaveKey('last_name_th')
        ->and($records)->toHaveKey('unmapped_field');

    // first_name_th is mapped and differs => conflict
    expect($records['first_name_th'])->toMatchArray([
        'id' => 'first_name_th',
        'field' => 'first_name_th',
        'is_mapped' => true,
        'status' => 'conflict',
        'current_value' => 'Old Name',
        'incoming_value' => 'New Name',
    ]);

    // last_name_th is not mapped but is identical => identical
    expect($records['last_name_th'])->toMatchArray([
        'id' => 'last_name_th',
        'field' => 'last_name_th',
        'is_mapped' => false,
        'status' => 'identical',
        'current_value' => 'Same Surname',
        'incoming_value' => 'Same Surname',
    ]);

    // unmapped_field is not mapped and differs => changed
    expect($records['unmapped_field'])->toMatchArray([
        'id' => 'unmapped_field',
        'field' => 'unmapped_field',
        'is_mapped' => false,
        'status' => 'changed',
        'current_value' => 'Old Unmapped Value',
        'incoming_value' => 'New Unmapped Value',
    ]);
});
