<?php

namespace Tests\Unit;

use App\Models\Resources\ScholarshipApplication;
use App\Transformers\DataTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataTransformerTest extends TestCase
{
    use RefreshDatabase;

    public function test_apply_formatting_preserves_null_when_no_rules()
    {
        // Formatting is an empty JSON array
        $formatting = '[]';
        $value = null;
        
        $method = new \ReflectionMethod(DataTransformer::class, 'applyFormatting');
        $method->setAccessible(true);
        $result = $method->invoke(null, $value, 'any_field', $formatting);

        $this->assertNull($result, 'null value should remain null when formatting is []');
    }

    public function test_transform_converts_empty_strings_to_null()
    {
        $data = [
            'remote_debt' => '',
            'remote_reason' => 'Some reason',
        ];

        $mapping = [
            'total_family_debt' => [
                'mapping' => 'remote_debt',
                'formatting' => '[]',
            ],
            'reason_for_scholarship' => [
                'mapping' => 'remote_reason',
                'formatting' => null,
            ],
        ];

        $model = new ScholarshipApplication();
        
        $result = DataTransformer::transform($data, $model, $mapping);

        $this->assertArrayHasKey('total_family_debt', $result);
        $this->assertNull($result['total_family_debt'], 'Empty string should be converted to null');
        $this->assertEquals('Some reason', $result['reason_for_scholarship']);
    }

    public function test_transform_preserves_null_values()
    {
        $data = [
            'remote_debt' => null,
        ];

        $mapping = [
            'total_family_debt' => [
                'mapping' => 'remote_debt',
                'formatting' => '[]',
            ],
        ];

        $model = new ScholarshipApplication();
        
        $result = DataTransformer::transform($data, $model, $mapping);

        $this->assertArrayHasKey('total_family_debt', $result);
        $this->assertNull($result['total_family_debt'], 'Null value should remain null');
    }
}
