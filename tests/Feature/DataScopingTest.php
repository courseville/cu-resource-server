<?php

namespace Tests\Feature;

use App\Models\Resources\Student;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataScopingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_scoped_by_domain()
    {
        // 1. Create domains
        $engDomain = 'ENG';
        $artsDomain = 'ARTS';

        // 2. Create students in different domains
        Student::create(['student_id' => 'S1', 'faccode' => $engDomain]);
        Student::create(['student_id' => 'S2', 'faccode' => $artsDomain]);

        // 3. Create a user with Engineering access
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Faculty Admin', 'description' => 'Test role']);
        $user->roles()->attach($role->id, ['domain' => $engDomain]);

        // 4. Authenticate as the user
        $this->actingAs($user, 'api');
        \Illuminate\Support\Facades\Auth::setUser($user);

        // 5. Verify scoping
        $scopedStudents = Student::all();

        $this->assertCount(1, $scopedStudents);
        $this->assertEquals($engDomain, $scopedStudents->first()->faccode);
    }
}
