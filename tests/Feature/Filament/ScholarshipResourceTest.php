<?php

use App\Filament\Resources\Scholarships\Pages\CreateScholarship;
use App\Filament\Resources\Scholarships\Pages\EditScholarship;
use App\Filament\Resources\Scholarships\Pages\ListScholarships;
use App\Models\Resources\Scholarship;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListScholarships::class)->assertOk();
});

it('shows existing scholarships on the list page', function () {
    $scholarship = makeScholarship(['scholarship_name' => 'ทุนทดสอบ A']);

    Livewire::test(ListScholarships::class)
        ->assertCanSeeTableRecords([$scholarship]);
});

it('renders the create page', function () {
    Livewire::test(CreateScholarship::class)->assertOk();
});

it('creates a Scholarship via the form', function () {
    Livewire::test(CreateScholarship::class)
        ->fillForm([
            'job_code' => 'JOB-NEW-1',
            'fcode' => 'F01',
            'scholarship_name' => 'ทุนการศึกษาทดสอบ',
            'name_en' => 'Test Scholarship',
            'description' => 'รายละเอียดทุน',
            'academic_year' => '2026',
            'isactive' => true,
            'require_doc' => true,
            'require_app1' => false,
            'require_app2' => false,
            'can_assign' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $scholarship = Scholarship::firstWhere('job_code', 'JOB-NEW-1');

    expect($scholarship)->not->toBeNull()
        ->and($scholarship->scholarship_name)->toBe('ทุนการศึกษาทดสอบ')
        ->and($scholarship->name_en)->toBe('Test Scholarship')
        ->and($scholarship->academic_year)->toBe(2026)
        ->and($scholarship->isactive)->toBeTrue()
        ->and($scholarship->require_doc)->toBeTrue()
        ->and($scholarship->can_assign)->toBeTrue();
});

it('flags required fields on create when missing', function () {
    Livewire::test(CreateScholarship::class)
        ->fillForm([
            'scholarship_name' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'scholarship_name' => 'required',
        ]);
});

it('renders the edit page with the form pre-filled', function () {
    $scholarship = makeScholarship([
        'scholarship_name' => 'ทุนเดิม',
        'name_en' => 'Existing',
    ]);

    Livewire::test(EditScholarship::class, ['record' => $scholarship->getRouteKey()])
        ->assertFormSet([
            'scholarship_name' => 'ทุนเดิม',
            'name_en' => 'Existing',
        ]);
});

it('updates a scholarship via the edit form', function () {
    $scholarship = makeScholarship([
        'scholarship_name' => 'ทุนเก่า',
        'isactive' => false,
    ]);

    Livewire::test(EditScholarship::class, ['record' => $scholarship->getRouteKey()])
        ->fillForm([
            'scholarship_name' => 'ทุนใหม่',
            'isactive' => true,
            'require_app1' => true,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $scholarship->refresh();

    expect($scholarship->scholarship_name)->toBe('ทุนใหม่')
        ->and($scholarship->isactive)->toBeTrue()
        ->and($scholarship->require_app1)->toBeTrue();
});
