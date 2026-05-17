<?php

use App\Filament\Resources\Majors\Pages\ListMajors;
use App\Models\Resources\Major;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListMajors::class)->assertOk();
});

it('shows existing majors on the list page', function () {
    $major = Major::create(['majorcode' => '701', 'name_en' => 'Computer Engineering']);

    Livewire::test(ListMajors::class)
        ->assertCanSeeTableRecords([$major]);
});
