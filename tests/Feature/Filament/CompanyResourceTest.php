<?php

use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Models\Resources\Company;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('renders the list page', function () {
    Livewire::test(ListCompanies::class)->assertOk();
});

it('shows existing companies on the list page', function () {
    $company = Company::create(['name' => 'Test Company']);

    Livewire::test(ListCompanies::class)
        ->assertCanSeeTableRecords([$company]);
});
