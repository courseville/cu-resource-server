<?php

use App\Filament\Imports\Resources\PersonnelImporter;
use App\Filament\Resources\Personnels\Pages\ListPersonnels;
use App\Models\Resources\Personnel;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    actAsAdminPanelUser();
});

it('shows the import action on the list page', function () {
    Livewire::test(ListPersonnels::class)
        ->assertActionVisible('import');
});

it('downloads the example CSV file from the import modal', function () {
    Livewire::test(ListPersonnels::class)
        ->callAction(['import', 'downloadExample'])
        ->assertFileDownloaded('personnel-importer-example');
});

it('imports personnel from a CSV based on the example file', function () {
    Storage::fake('local');

    // Already in the DB
    $existing = makePersonnel([
        'personnel_id' => 'PER-IMPORT-EXISTING',
        'first_name_th' => 'เดิม',
        'last_name_th' => 'ทดสอบ',
    ]);

    $columns = PersonnelImporter::getColumns();

    $rows = [
        [
            'personnel_id' => 'PER-IMPORT-001',
            'first_name_th' => 'สมชาย',
            'last_name_th' => 'นำเข้า',
            'first_name_en' => 'Somchai',
            'last_name_en' => 'Import',
            'public_email' => 'somchai.import@university.com',
            'private_email' => 'somchai.import@example.com',
            'marital_status' => 'โสด',
            'personnel_status' => '3',
        ],
        [
            'personnel_id' => 'PER-IMPORT-002',
            'first_name_th' => 'สมหญิง',
            'last_name_th' => 'นำเข้า',
            'first_name_en' => 'Somying',
            'last_name_en' => 'Import',
            'public_email' => 'somying.import@university.com',
            'private_email' => 'somying.import@example.com',
        ],
        [
            'personnel_id' => 'PER-IMPORT-EXISTING',
            'first_name_th' => 'ใหม่',
            'last_name_th' => 'ปรับปรุง',
            'public_email' => 'existing@university.com',
            'private_email' => 'existing@example.com',
        ],
    ];

    // Build the CSV: header row = same headers as the example file, then the data rows.
    $stream = fopen('php://temp', 'r+');

    fputcsv($stream, array_map(fn($column) => $column->getExampleHeader(), $columns), ',', '"', '');

    foreach ($rows as $row) {
        fputcsv($stream, array_map(fn($column) => $row[$column->getName()] ?? '', $columns), ',', '"', '');
    }

    rewind($stream);
    $csv = stream_get_contents($stream);
    fclose($stream);

    $file = UploadedFile::fake()->createWithContent('personnel.csv', $csv);

    // Map every importer column to the header used in the example file.
    $columnMap = collect($columns)
        ->mapWithKeys(fn($column) => [$column->getName() => $column->getExampleHeader()])
        ->all();

    Livewire::test(ListPersonnels::class)
        ->callAction('import', data: [
            'file' => $file,
            'columnMap' => $columnMap,
        ])
        ->assertHasNoActionErrors()
        ->assertNotified();

    // Import bookkeeping (needs QUEUE_CONNECTION=sync in the test env)
    $import = Import::query()->latest('id')->first();

    // dump([
    //     'queue'       => config('queue.default'),
    //     'counts'      => $import->only(['total_rows', 'processed_rows', 'successful_rows']),
    //     'failed_rows' => $import->failedRows()->get(['data', 'validation_error'])->toArray(),
    //     'personnel'   => Personnel::count(),
    // ]);

    expect($import)->not->toBeNull()
        ->and($import->importer)->toBe(PersonnelImporter::class)
        ->and($import->total_rows)->toBe(3)
        ->and($import->successful_rows)->toBe(3)
        ->and($import->getFailedRowsCount())->toBe(0);

    // New rows are in the DB
    $first = Personnel::firstWhere('personnel_id', 'PER-IMPORT-001');

    expect($first)->not->toBeNull()
        ->and($first->first_name_th)->toBe('สมชาย')
        ->and($first->last_name_th)->toBe('นำเข้า')
        ->and($first->first_name_en)->toBe('Somchai')
        ->and($first->public_email)->toBe('somchai.import@university.com')
        ->and($first->private_email)->toBe('somchai.import@example.com')
        ->and($first->marital_status)->toBe('โสด')
        ->and($first->personnel_status)->toBe('3');

    $second = Personnel::firstWhere('personnel_id', 'PER-IMPORT-002');

    expect($second)->not->toBeNull()
        ->and($second->first_name_th)->toBe('สมหญิง')
        ->and($second->public_email)->toBe('somying.import@university.com')
        ->and($second->private_email)->toBe('somying.import@example.com');

    // Existing row was updated in place, not duplicated
    expect(Personnel::where('personnel_id', 'PER-IMPORT-EXISTING')->count())->toBe(1);

    $existing->refresh();

    expect($existing->first_name_th)->toBe('ใหม่')
        ->and($existing->last_name_th)->toBe('ปรับปรุง');
});
