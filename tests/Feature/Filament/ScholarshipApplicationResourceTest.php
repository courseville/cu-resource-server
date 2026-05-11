<?php

use App\Filament\Resources\ScholarshipApplications\Pages\CreateScholarshipApplication;
use App\Filament\Resources\ScholarshipApplications\Pages\EditScholarshipApplication;
use App\Filament\Resources\ScholarshipApplications\Pages\ListScholarshipApplications;
use App\Models\Resources\ScholarshipApplication;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListScholarshipApplications::class)->assertOk();
});

it('shows existing applications on the list page', function () {
    $application = makeScholarshipApplication();

    Livewire::test(ListScholarshipApplications::class)
        ->assertCanSeeTableRecords([$application]);
});

it('renders the create page', function () {
    Livewire::test(CreateScholarshipApplication::class)->assertOk();
});

it('creates a ScholarshipApplication via the form', function () {
    $student = makeStudent(['student_id' => 'S-APP-1']);
    $scholarship = makeScholarship(['job_code' => 'JOB-APP-1']);

    Livewire::test(CreateScholarshipApplication::class)
        ->fillForm([
            'student_id' => $student->student_id,
            'job_code' => $scholarship->job_code,
            'gpa' => '3.50',
            'gpax' => '3.75',
            'reason_for_scholarship' => 'ครอบครัวมีรายได้น้อย',
            'status' => 'pending',
            'confirm' => false,
            'mother_monthly_income' => '12000',
            'father_monthly_income' => '15000',
            'total_family_debt' => '50000',
            'has_house' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $application = ScholarshipApplication::firstWhere('student_id', $student->student_id);

    expect($application)->not->toBeNull()
        ->and($application->job_code)->toBe($scholarship->job_code)
        ->and((float) $application->gpa)->toBe(3.50)
        ->and((float) $application->gpax)->toBe(3.75)
        ->and($application->status)->toBe('pending')
        ->and($application->has_house)->toBeTrue();
});

it('flags missing student on create', function () {
    Livewire::test(CreateScholarshipApplication::class)
        ->fillForm([
            'student_id' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'student_id' => 'required',
        ]);
});

it('renders the edit page with the form pre-filled', function () {
    $application = makeScholarshipApplication([
        'gpa' => '3.20',
        'status' => 'pending',
    ]);

    Livewire::test(EditScholarshipApplication::class, ['record' => $application->getRouteKey()])
        ->assertFormSet([
            'student_id' => $application->student_id,
            'job_code' => $application->job_code,
            'status' => 'pending',
        ]);
});

it('updates an application status and financials via the edit form', function () {
    $application = makeScholarshipApplication([
        'status' => 'pending',
        'confirm' => false,
    ]);

    Livewire::test(EditScholarshipApplication::class, ['record' => $application->getRouteKey()])
        ->fillForm([
            'status' => 'accepted',
            'confirm' => true,
            'gpa' => '3.85',
            'father_occupation' => 'Engineer',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $application->refresh();

    expect($application->status)->toBe('accepted')
        ->and($application->confirm)->toBeTrue()
        ->and((float) $application->gpa)->toBe(3.85)
        ->and($application->father_occupation)->toBe('Engineer');
});
