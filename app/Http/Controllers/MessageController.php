<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Message\RetriveMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class MessageController extends Controller
{
    /**
     * retrive messages between two users.
     */
    public function index(int $receiver_id): View
    {
        $sender_id = Auth::id();
        $messages = (new RetriveMessage())->handle($sender_id, $receiver_id);

        return view('Message.index', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
