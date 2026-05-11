<?php

use App\Filament\Resources\Students\Pages\CreateStudent;
use App\Filament\Resources\Students\Pages\EditStudent;
use App\Filament\Resources\Students\Pages\ListStudents;
use App\Filament\Resources\Students\Pages\ViewStudent;
use App\Models\Resources\Student;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListStudents::class)->assertOk();
});

it('shows existing students on the list page', function () {
    $student = makeStudent(['first_name_th' => 'มานี']);

    Livewire::test(ListStudents::class)
        ->assertCanSeeTableRecords([$student]);
});

it('renders the create page', function () {
    Livewire::test(CreateStudent::class)->assertOk();
});

it('creates a Student via the form', function () {
    Livewire::test(CreateStudent::class)
        ->fillForm([
            'student_id' => '6512345678',
            'title_th' => 'นาย',
            'first_name_th' => 'ทดสอบ',
            'last_name_th' => 'นักศึกษา',
            'first_name_en' => 'Test',
            'last_name_en' => 'Student',
            'citizen_id' => '1234567890123',
            'email' => 'test.student@example.com',
            'fac_name' => 'Engineering',
            'start_acad_year' => '2026',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $student = Student::firstWhere('student_id', '6512345678');

    expect($student)->not->toBeNull()
        ->and($student->first_name_th)->toBe('ทดสอบ')
        ->and($student->last_name_th)->toBe('นักศึกษา')
        ->and($student->citizen_id)->toBe('1234567890123')
        ->and($student->email)->toBe('test.student@example.com')
        ->and($student->fac_name)->toBe('Engineering')
        ->and($student->start_acad_year)->toBe('2026');
});

it('flags required fields on create when missing', function () {
    Livewire::test(CreateStudent::class)
        ->fillForm([
            'student_id' => null,
            'first_name_th' => null,
            'last_name_th' => null,
            'citizen_id' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'student_id' => 'required',
            'first_name_th' => 'required',
            'last_name_th' => 'required',
            'citizen_id' => 'required',
        ]);
});

it('renders the view page for an existing student', function () {
    $student = makeStudent();

    Livewire::test(ViewStudent::class, ['record' => $student->getRouteKey()])
        ->assertOk();
});

it('renders the edit page with the form pre-filled', function () {
    $student = makeStudent([
        'student_id' => '6500000001',
        'first_name_th' => 'มาลี',
        'last_name_th' => 'ทดสอบ',
    ]);

    Livewire::test(EditStudent::class, ['record' => $student->getRouteKey()])
        ->assertFormSet([
            'student_id' => '6500000001',
            'first_name_th' => 'มาลี',
            'last_name_th' => 'ทดสอบ',
        ]);
});

it('updates a student via the edit form', function () {
    $student = makeStudent([
        'student_id' => '6500000002',
        'first_name_th' => 'เก่า',
        'last_name_th' => 'ทดสอบ',
        'citizen_id' => '0000000000000',
    ]);

    Livewire::test(EditStudent::class, ['record' => $student->getRouteKey()])
        ->fillForm([
            'first_name_th' => 'ใหม่',
            'last_name_th' => 'ปรับปรุง',
            'fac_name' => 'Science',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $student->refresh();

    expect($student->first_name_th)->toBe('ใหม่')
        ->and($student->last_name_th)->toBe('ปรับปรุง')
        ->and($student->fac_name)->toBe('Science');
});
