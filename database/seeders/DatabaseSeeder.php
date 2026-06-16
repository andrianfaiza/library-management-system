<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rack;
use App\Models\Book;
use App\Models\Student;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\BookReturn;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run role & user seeder first
        $this->call([
            RolePermissionSeeder::class
        ]);

        // Fetch users created in RolePermissionSeeder
        $admin = User::where('email', 'admin@gmail.com')->first();
        $staff = User::where('email', 'staff@gmail.com')->first();
        $user  = User::where('email', 'user@gmail.com')->first();

        // Racks
        $rackA = Rack::create([
            'name' => 'Rack A11',
            'location' => 'First Floor - North Wing',
            'capacity' => '100',
        ]);

        $rackB = Rack::create([
            'name' => 'Rack B22',
            'location' => 'Second Floor - East Wing',
            'capacity' => '150',
        ]);

        // Books
        $book1 = Book::create([
            'isbn' => '9781234567890',
            'title' => 'Introduction to Programming',
            'publisher' => 'TechBooks Publishing',
            'publication_year' => '2021',
            'author' => 'John Smith',
            'rack_id' => $rackA->id,
            'quantity' => 10,
        ]);

        $book2 = Book::create([
            'isbn' => '9789876543210',
            'title' => 'Mastering Laravel',
            'publisher' => 'CodePress',
            'publication_year' => '2024',
            'author' => 'Andrian Faiza',
            'rack_id' => $rackB->id,
            'quantity' => 5,
        ]);

        // Students
        $student1 = Student::create([
            'nis' => '2026001',
            'name' => 'Michael Johnson',
            'class' => 'Grade 12',
            'major' => 'Software Engineering',
            'phone_number' => '08123456789',
            'email' => 'michael.johnson@example.com',
        ]);

        $student2 = Student::create([
            'nis' => '2026002',
            'name' => 'Emily Davis',
            'class' => 'Grade 11',
            'major' => 'Computer Networking',
            'phone_number' => '08987654321',
            'email' => 'emily.davis@example.com',
        ]);

        // Loans
        $loan1 = Loan::create([
            'student_id' => $student1->id,
            'user_id' => $admin->id,
            'loan_date' => Carbon::now()->subDays(5),
            'return_date' => Carbon::now()->addDays(2),
            'status' => 'borrowed',
        ]);

        $loan2 = Loan::create([
            'student_id' => $student2->id,
            'user_id' => $staff->id,
            'loan_date' => Carbon::now()->subDays(10),
            'return_date' => Carbon::now()->subDays(2),
            'status' => 'borrowed',
        ]);

        // LoanDetails
        LoanDetail::create([
            'loan_id' => $loan1->id,
            'book_id' => $book1->id,
            'quantity' => 2,
            'status' => 'borrowed',
        ]);

        LoanDetail::create([
            'loan_id' => $loan2->id,
            'book_id' => $book2->id,
            'quantity' => 1,
            'status' => 'borrowed',
        ]);

        // BookReturns
        BookReturn::create([
            'loan_id' => $loan2->id,
            'return_date' => Carbon::now()->toDateString(),
            'fine' => 2000,
            'user_id' => $admin->id,
        ]);
    }
}
