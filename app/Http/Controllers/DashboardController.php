<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Foundation\Auth\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentLogs = RentLogs::with(['user', 'book'])->get();

        return view('admin-feature.dashboard-admin', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'rentLogs' => $rentLogs]);
    }
}
