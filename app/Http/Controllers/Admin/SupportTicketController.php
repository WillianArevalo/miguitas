<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\SupportTicket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportTicketController extends Controller
{
    public function index()
    {
        $users = User::where("role", "admin")->get();
        $tickets = SupportTicket::with('user', 'assignedTo', 'lastRepliedBy')->get();
        return view('admin.support_tickets.index', ["users" => $users, "tickets" => $tickets]);
    }

    public function show(string $id)
    {
        $ticket = SupportTicket::with('user', 'assignedTo', 'lastRepliedBy', 'comments.user')->findOrFail($id);

        $notifications = Notification::where('reference_id', $id)->get();

        $notifications->each(function ($notification) {
            $notification->update(['read' => true]);
        });

        return view('admin.support_tickets.show', compact("ticket"));
    }

    public function asign(Request $request, string $id)
    {
        $request->validate([
            "assigned_to" => "required|integer"
        ]);

        DB::beginTransaction();
        try {
            $ticket = SupportTicket::findOrFail($id);
            $ticket->update([
                "assigned_to" => $request->assigned_to
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Ticket assigned successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while assigning the ticket. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $ticket = SupportTicket::findOrFail($id);
            $ticket->delete();
            DB::commit();
            return redirect()->route('admin.support-tickets.index')->with('success', 'Ticket deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting the ticket. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function changeStatus(string $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $ticket = SupportTicket::findOrFail($id);
            $date = now();
            switch ($request->status) {
                case 'open':
                    $ticket->update([
                        "status" => $request->status,
                        "opened_at" => $date
                    ]);
                    break;
                case 'closed':
                    $ticket->update([
                        "status" => $request->status,
                        "closed_at" => $date
                    ]);
                    break;


                case 'resolved':
                    $ticket->update([
                        "status" => $request->status,
                        "resolved_at" => $date
                    ]);
                    break;

                case 'reopened':
                    $ticket->update([
                        "status" => $request->status,
                        "reopened_at" => $date
                    ]);
                    break;

                default:
                    $ticket->update([
                        "status" => $request->status
                    ]);
                    break;
            }
            DB::commit();
            return redirect()->back()->with('success', 'Estado del ticket cambiado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(
                'error',
                'Ocurrió un error al cambiar el estado del ticket. Por favor, inténtelo de nuevo.'
            );
        }
    }
}
