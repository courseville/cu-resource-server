<?php

use App\Filament\Resources\StudentInternships\Pages\CreateStudentInternship;
use App\Filament\Resources\StudentInternships\Pages\EditStudentInternship;
use App\Filament\Resources\StudentInternships\Pages\ListStudentInternships;
use App\Filament\Resources\StudentInternships\Pages\ViewStudentInternship;
use App\Models\Resources\StudentInternship;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListStudentInternships::class)->assertOk();
});

it('shows existing internships on the list page', function () {
    $internship = makeStudentInternship();

    Livewire::test(ListStudentInternships::class)
        ->assertCanSeeTableRecords([$internship]);
});

it('renders the create page', function () {
    Livewire::test(CreateStudentInternship::class)->assertOk();
});

it('creates a StudentInternship via the form', function () {
    $student = makeStudent(['student_id' => 'S-INT-1']);

    Livewire::test(CreateStudentInternship::class)
        ->fillForm([
            'student_id' => $student->student_id,
            'intern_year' => '2026',
            'company' => 'Globex Corp',
            'comp_addr' => '99 Mai St',
            'comp_admin' => 'Jane Doe',
            'comp_tel' => '021234567',
            'flag_comp_status' => 'accept',
            'flag_req_change' => false,
            'status' => 'pending',
            'sup_name' => 'John Sup',
            'sup_position' => 'Manager',
            'sup_phone' => '0812345678',
            'job_description' => 'Backend internship',
            'blacklist' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $internship = StudentInternship::firstWhere('student_id', $student->student_id);

    expect($internship)->not->toBeNull()
        ->and($internship->company)->toBe('Globex Corp')
        ->and((int) $internship->intern_year)->toBe(2026)
        ->and($internship->flag_comp_status)->toBe('accept')
        ->and($internship->status)->toBe('pending')
        ->and($internship->sup_name)->toBe('John Sup')
        ->and($internship->blacklist)->toBeFalse();
});

it('flags missing student on create', function () {
    Livewire::test(CreateStudentInternship::class)
        ->fillForm([
            'student_id' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'student_id' => 'required',
        ]);
});

it('renders the view page for an existing internship', function () {
    $internship = makeStudentInternship(['company' => 'Acme View Co']);

    Livewire::test(ViewStudentInternship::class, ['record' => $internship->getRouteKey()])
        ->assertOk();
});

it('renders the edit page with the form pre-filled', function () {
    $internship = makeStudentInternship([
        'company' => 'Initech',
        'status' => 'pending',
    ]);

    Livewire::test(EditStudentInternship::class, ['record' => $internship->getRouteKey()])
        ->assertFormSet([
            'student_id' => $internship->student_id,
            'company' => 'Initech',
            'status' => 'pending',
        ]);
});

it('updates an internship via the edit form', function () {
    $internship = makeStudentInternship([
        'company' => 'Old Co',
        'status' => 'pending',
        'blacklist' => false,
    ]);

    Livewire::test(EditStudentInternship::class, ['record' => $internship->getRouteKey()])
        ->fillForm([
            'company' => 'New Co',
            'status' => 'finish',
            'blacklist' => true,
            'prac_score' => '85',
            'grade' => 'A',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $internship->refresh();

    expect($internship->company)->toBe('New Co')
        ->and($internship->status)->toBe('finish')
        ->and($internship->blacklist)->toBeTrue()
        ->and((int) $internship->prac_score)->toBe(85)
        ->and($internship->grade)->toBe('A');
});
