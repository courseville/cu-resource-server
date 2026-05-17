<?php

use App\Filament\Resources\Faculties\Pages\ListFaculties;
use App\Models\Resources\Faculty;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListFaculties::class)->assertOk();
});

it('shows existing faculties on the list page', function () {
    $faculty = Faculty::create(['faccode' => '21', 'name_en' => 'Engineering']);

    Livewire::test(ListFaculties::class)
        ->assertCanSeeTableRecords([$faculty]);
});
