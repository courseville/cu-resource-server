<?php

use App\Filament\Resources\Personnels\Pages\CreatePersonnel;
use App\Filament\Resources\Personnels\Pages\EditPersonnel;
use App\Filament\Resources\Personnels\Pages\ListPersonnels;
use App\Filament\Resources\Personnels\Pages\ViewPersonnel;
use App\Models\Resources\Personnel;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListPersonnels::class)->assertOk();
});

it('shows existing personnel on the list page', function () {
    $personnel = makePersonnel(['first_name_th' => 'อาจารย์']);

    Livewire::test(ListPersonnels::class)
        ->assertCanSeeTableRecords([$personnel]);
});

it('renders the create page', function () {
    Livewire::test(CreatePersonnel::class)->assertOk();
});

it('creates a Personnel via the form', function () {
    Livewire::test(CreatePersonnel::class)
        ->fillForm([
            'personnel_id' => 'PER-001',
            'first_name_th' => 'ดร.สมศักดิ์',
            'last_name_th' => 'ทดสอบ',
            'first_name_en' => 'Somsak',
            'last_name_en' => 'Test',
            'public_email' => 'somsak@example.com',
            'marital_status' => 'โสด',
            'personnel_status' => '3',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $personnel = Personnel::firstWhere('personnel_id', 'PER-001');

    expect($personnel)->not->toBeNull()
        ->and($personnel->first_name_th)->toBe('ดร.สมศักดิ์')
        ->and($personnel->last_name_th)->toBe('ทดสอบ')
        ->and($personnel->public_email)->toBe('somsak@example.com')
        ->and($personnel->marital_status)->toBe('โสด')
        ->and($personnel->personnel_status)->toBe('3');
});

it('flags required fields on create when missing', function () {
    Livewire::test(CreatePersonnel::class)
        ->fillForm([
            'personnel_id' => null,
            'first_name_th' => null,
            'last_name_th' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'personnel_id' => 'required',
            'first_name_th' => 'required',
            'last_name_th' => 'required',
        ]);
});

it('renders the view page for an existing personnel', function () {
    $personnel = makePersonnel();

    Livewire::test(ViewPersonnel::class, ['record' => $personnel->getRouteKey()])
        ->assertOk();
});

it('renders the edit page with the form pre-filled', function () {
    $personnel = makePersonnel([
        'personnel_id' => 'PER-EDIT',
        'first_name_th' => 'สมหญิง',
        'last_name_th' => 'ทดสอบ',
    ]);

    Livewire::test(EditPersonnel::class, ['record' => $personnel->getRouteKey()])
        ->assertFormSet([
            'personnel_id' => 'PER-EDIT',
            'first_name_th' => 'สมหญิง',
            'last_name_th' => 'ทดสอบ',
        ]);
});

it('updates a personnel via the edit form', function () {
    $personnel = makePersonnel([
        'personnel_id' => 'PER-UPDATE',
        'first_name_th' => 'เดิม',
        'last_name_th' => 'ทดสอบ',
    ]);

    Livewire::test(EditPersonnel::class, ['record' => $personnel->getRouteKey()])
        ->fillForm([
            'first_name_th' => 'ใหม่',
            'last_name_th' => 'ปรับปรุง',
            'public_email' => 'updated@example.com',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $personnel->refresh();

    expect($personnel->first_name_th)->toBe('ใหม่')
        ->and($personnel->last_name_th)->toBe('ปรับปรุง')
        ->and($personnel->public_email)->toBe('updated@example.com');
});
