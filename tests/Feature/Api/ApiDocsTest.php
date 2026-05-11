<?php

it('can access the API documentation UI', function () {
    actAsAdminPanelUser();
    $response = $this->get('/docs/api');

    $response->assertOk();
});

it('can access the OpenAPI specification JSON', function () {
    actAsAdminPanelUser();
    $response = $this->get('/docs/api.json');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/json');

    $json = $response->json();
    // fwrite(STDERR, print_r(array_keys($json['paths']), TRUE));
    expect($json)->toHaveKey('openapi')
        ->and($json)->toHaveKey('paths');

    // Check if at least one of our new export routes is there
    $exportPaths = array_filter(array_keys($json['paths']), fn ($path) => str_contains($path, '/export'));
    expect($exportPaths)->not->toBeEmpty();

    // Check if Personnel index has structure_id parameter
    $personnelIndex = $json['paths']['/api/v1/personnel'] ?? null;
    if ($personnelIndex) {
        $params = array_column($personnelIndex['get']['parameters'] ?? [], 'name');
        expect($params)->toContain('structure_id');
    }
});
