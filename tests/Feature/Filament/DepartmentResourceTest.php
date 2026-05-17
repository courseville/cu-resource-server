<?php

use App\Filament\Resources\Departments\Pages\ListDepartments;
use App\Models\Resources\Department;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListDepartments::class)->assertOk();
});

it('shows existing departments on the list page', function () {
    $department = Department::create(['depcode' => '2110', 'name_en' => 'Dept of Comp Eng']);

    Livewire::test(ListDepartments::class)
        ->assertCanSeeTableRecords([$department]);
});
