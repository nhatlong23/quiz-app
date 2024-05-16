<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Kiểm tra việc thêm sinh viên mới.
     *
     * @return void
     */
    public function testCreateStudent()
    {
        $data = [
            'student_code' => 'SV001',
            'name' => 'Nguyễn Văn A',
            'class_id' => 1,
            'birth' => '1990-01-01',
            'gender' => 'male',
            'school_year' => '2024',
            'cccd' => '123456789012',
            'phone' => '0123456789',
            'email' => 'nguyenvana@example.com',
            'password' => 'password',
            'status' => 1,
        ];

        $response = $this->post('/students', $data);

        $this->assertDatabaseHas('students', [
            'student_code' => 'SV001',
            'name' => 'Nguyễn Văn A',
        ]);

        Session::flash('success', 'Thêm sinh viên thành công');

        $response->assertRedirect(route('students.index'));
    }

    public function testUpdateStudent()
    {
        $student = Student::factory()->create();

        $data = [
            'name' => 'Nguyễn Văn B',
            'class_id' => 2,
            'birth' => '1995-05-05',
            'gender' => 'female',
            'cccd' => '987654321012',
            'school_year' => '2023',
            'phone' => '0987654321',
            'email' => 'nguyenvanb@example.com',
            'status' => 1,
        ];

        $response = $this->patch("/students/{$student->id}", $data);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Nguyễn Văn B',
            'class_id' => 2,
            'birth' => '1995-05-05',
            'gender' => 'female',
            'cccd' => '987654321012',
            'school_year' => '2023',
            'phone' => '0987654321',
            'email' => 'nguyenvanb@example.com',
            'status' => 1,
        ]);

        $response->assertRedirect(route('students.index'));
    }
    
    public function testDeleteStudent()
    {
        $student = Student::factory()->create();

        $response = $this->delete("/students/{$student->id}");

        $this->assertDatabaseMissing('students', ['id' => $student->id]);

        $response->assertRedirect(route('students.index'));
    }
}
