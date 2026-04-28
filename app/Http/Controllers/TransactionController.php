<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource Data Not Found",
            ], 204);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resources",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        // validator & cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        // generate order number | unique
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // ambil user yang sedang login & cek user login
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'messages' => 'Unauthorized!'
            ], 401);
        }
        // mencari data buku dari request
        $book = Book::find($request->book_id);

        // cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'messages' => 'Stock barang tidak cukup!'
            ], 400);
        }

        // hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;

        // kurangi stok buku 
        $book->stock -= $request->quantity;
        $book->save();

        // simpan data transaksi
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transactions
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail Transaction',
            'data' => $transaction
        ], 200);
    }

    public function update(string $id, Request $request)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'messages' => 'Unauthorized!'
            ], 401);
        }

        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'messages' => 'Stock barang tidak cukup!'
            ], 400);
        }

        $totalAmount = $book->price * $request->quantity;

        $transaction->update([
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ], 200);
    }


    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ]);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete Successfuly',
        ], 200);
    }
}
