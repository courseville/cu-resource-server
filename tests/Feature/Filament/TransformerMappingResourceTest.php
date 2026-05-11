<?php

use App\Filament\Resources\TransformerMappings\Pages\CreateTransformerMapping;
use App\Filament\Resources\TransformerMappings\Pages\EditTransformerMapping;
use App\Filament\Resources\TransformerMappings\Pages\ListTransformerMappings;
use App\Models\TransformerMapping;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListTransformerMappings::class)->assertOk();
});

it('shows existing mappings on the list page', function () {
    $mapping = makeTransformerMapping();

    Livewire::test(ListTransformerMappings::class)
        ->assertCanSeeTableRecords([$mapping]);
});

it('renders the create page', function () {
    Livewire::test(CreateTransformerMapping::class)->assertOk();
});

it('creates a TransformerMapping via the form', function () {
    $dataSource = makeDataSource();

    Livewire::test(CreateTransformerMapping::class)
        ->fillForm([
            'data_source_id' => (string) $dataSource->id,
            'model' => 'App\\Models\\Resources\\Student',
            'field' => 'last_name_th',
            'mapping' => 'lname_th',
            'formatting' => 'trim|upper',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $mapping = TransformerMapping::firstWhere('field', 'last_name_th');

    expect($mapping)->not->toBeNull()
        ->and((int) $mapping->data_source_id)->toBe($dataSource->id)
        ->and($mapping->model)->toBe('App\\Models\\Resources\\Student')
        ->and($mapping->mapping)->toBe('lname_th')
        ->and($mapping->formatting)->toBe('trim|upper');
});

it('flags required fields on create when missing', function () {
    Livewire::test(CreateTransformerMapping::class)
        ->fillForm([
            'data_source_id' => null,
            'model' => null,
            'field' => null,
            'mapping' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'data_source_id' => 'required',
            'model' => 'required',
            'field' => 'required',
            'mapping' => 'required',
        ]);
});

it('renders the edit page with the form pre-filled', function () {
    $mapping = makeTransformerMapping([
        'field' => 'first_name_th',
        'mapping' => 'fname_th',
    ]);

    Livewire::test(EditTransformerMapping::class, ['record' => $mapping->getRouteKey()])
        ->assertFormSet([
            'data_source_id' => (string) $mapping->data_source_id,
            'model' => 'App\\Models\\Resources\\Student',
            'field' => 'first_name_th',
            'mapping' => 'fname_th',
        ]);
});

it('updates a mapping via the edit form', function () {
    $mapping = makeTransformerMapping([
        'field' => 'old_field',
        'mapping' => 'old',
        'formatting' => null,
    ]);

    Livewire::test(EditTransformerMapping::class, ['record' => $mapping->getRouteKey()])
        ->fillForm([
            'field' => 'new_field',
            'mapping' => 'new_mapping',
            'formatting' => 'lowercase',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $mapping->refresh();

    expect($mapping->field)->toBe('new_field')
        ->and($mapping->mapping)->toBe('new_mapping')
        ->and($mapping->formatting)->toBe('lowercase');
});
