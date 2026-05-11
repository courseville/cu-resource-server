<?php

use App\Filament\Resources\DataSources\Pages\CreateDataSource;
use App\Filament\Resources\DataSources\Pages\EditDataSource;
use App\Filament\Resources\DataSources\Pages\ListDataSources;
use App\Models\DataSource;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListDataSources::class)->assertOk();
});

it('shows existing data sources on the list page', function () {
    $dataSource = makeDataSource(['name' => 'Sales DB']);

    Livewire::test(ListDataSources::class)
        ->assertCanSeeTableRecords([$dataSource]);
});

it('renders the create page', function () {
    Livewire::test(CreateDataSource::class)->assertOk();
});

it('creates a DataSource via the form', function () {
    Livewire::test(CreateDataSource::class)
        ->fillForm([
            'name' => 'HR Source',
            'type' => 'mysql',
            'url' => 'hr_connection:employees:id',
            'is_active' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $dataSource = DataSource::firstWhere('name', 'HR Source');

    expect($dataSource)->not->toBeNull()
        ->and($dataSource->type)->toBe('mysql')
        ->and($dataSource->url)->toBe('hr_connection:employees:id')
        ->and($dataSource->is_active)->toBeTrue();
});

it('defaults type to file and is_active to true on create', function () {
    Livewire::test(CreateDataSource::class)
        ->fillForm([
            'name' => 'Default Source',
            'url' => '/tmp/source.csv',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $dataSource = DataSource::firstWhere('name', 'Default Source');

    expect($dataSource->type)->toBe('file')
        ->and($dataSource->is_active)->toBeTrue();
});

it('flags required fields on create when missing', function () {
    Livewire::test(CreateDataSource::class)
        ->fillForm([
            'name' => null,
            'url' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'url' => 'required',
        ]);
});

it('renders the edit page with the form pre-filled', function () {
    $dataSource = makeDataSource([
        'name' => 'My Source',
        'type' => 'mysql',
        'url' => 'conn:tbl',
        'is_active' => false,
    ]);

    Livewire::test(EditDataSource::class, ['record' => $dataSource->getRouteKey()])
        ->assertFormSet([
            'name' => 'My Source',
            'type' => 'mysql',
            'url' => 'conn:tbl',
            'is_active' => false,
        ]);
});

it('updates a data source via the edit form', function () {
    $dataSource = makeDataSource([
        'name' => 'Before',
        'is_active' => false,
    ]);

    Livewire::test(EditDataSource::class, ['record' => $dataSource->getRouteKey()])
        ->fillForm([
            'name' => 'After',
            'type' => 'mysql',
            'url' => 'new_conn:t',
            'is_active' => true,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $dataSource->refresh();

    expect($dataSource->name)->toBe('After')
        ->and($dataSource->type)->toBe('mysql')
        ->and($dataSource->url)->toBe('new_conn:t')
        ->and($dataSource->is_active)->toBeTrue();
});
