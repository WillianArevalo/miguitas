<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SupportTicket;
use App\Models\TicketComment;
use Illuminate\Support\Facades\DB;

class TicketCommentController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            "ticket_id" => "integer|required",
            "comment" => "required|string",
            'attachments' => 'nullable'
        ]);

        try {
            $ticket = SupportTicket::findOrFail($request->ticket_id);
            $attachments = [];
            if ($request->hasFile("attachments")) {
                foreach ($request->file("attachments") as $file) {
                    $path = $file->store("ticket_attachments/{$ticket->ticket_number}", "public");
                    $attachments[] = [
                        "filename" => $file->getClientOriginalName(),
                        "path" => $path,
                        "size" => $file->getSize(),
                        "mime_type" => $file->getClientMimeType(),
                    ];
                }
            }

            $ticket->update([
                "status" => "pending",
                "last_replied_by" => auth()->id(),
                "last_replied_at" => now()
            ]);

            TicketComment::create([
                "ticket_id" => $ticket->id,
                "user_id" => auth()->id(),
                "comment" => $request->input("comment"),
                "attachments" => $attachments,
                "type_user" => "user"
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Comment added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while adding the comment. Please try again. Error: ' . $e->getMessage());
        }
    }
}
