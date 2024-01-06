<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();

        return view('admin-feature.books.rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->status != 'in stock') {
            Session::flash('message', 'Book is being borrowed');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        }

        $count = RentLogs::where('user_id', $request->user_id)->whereNull('actual_return_date')->count();

        if ($count >= 3) {
            Session::flash('message', 'Cannot rent, user has reached the limit of lending books');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        }

        DB::beginTransaction();

        try {
            RentLogs::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'rent_date' => Carbon::now()->toDateString(),
                'return_date' => Carbon::now()->addDays(3)->toDateString(),
            ]);

            $book->status = "not available";
            $book->save();

            DB::commit();

            Session::flash('message', 'The book was successfully borrowed');
            Session::flash('alert-class', 'alert-success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('message', 'Error occurred while borrowing the book');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('book-rent');
    }

    public function returnBook()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();

        return view('admin-feature.books.return', compact('users', 'books'));
    }
    public function saveReturnBook(Request $request)
    {
        // dd($request->book_id);
        $rent = RentLogs::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->whereNull('actual_return_date');

        $countData = $rent->count();
        $rentData = $rent->first();

        if ($countData == 1) {
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            // Update status buku dari not available menjadi available
            $book = Book::find($request->book_id);
            if ($book) {
                $book->status = 'in stock';
                $book->save();
            }

            Session::flash('message', 'The book is returned successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Error occurred while returning the book');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('book-return');
    }

}
