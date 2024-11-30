<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Notification;
use App\Models\SupportTicket;
use App\Models\TicketComment;
use App\Models\User;
use App\Notifications\SupportTicketCreated;
use App\Utils\CategoryTickets;
use App\Utils\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where("user_id", auth()->id())->get();
        return view("store.account.support-ticket.index", compact("tickets"));
    }

    public function create()
    {
        $categories = CategoryTickets::getCategories();
        return view("store.account.support-ticket.create", ["categories" => $categories]);
    }

    public function store(TicketRequest $request)
    {
        DB::beginTransaction();
        $validated = $request->validated();
        try {
            $validated["user_id"] = auth()->id();
            $validated["ticket_number"] = $this->generateTicketNumber();
            $ticket = SupportTicket::create($validated);

            if ($request->has("add_comment")) {
                $attachments = [];
                if ($request->hasFile("attachments")) {
                    $directory = "ticket_attachments/{$ticket->ticket_number}";
                    foreach ($request->file("attachments") as $file) {
                        $path = $file->store($directory, "public");
                        $attachments[] = [
                            "filename" => $file->getClientOriginalName(),
                            "path" => $path,
                            "size" => $file->getSize(),
                            "mime_type" => $file->getClientMimeType()
                        ];
                    }
                }

                TicketComment::create([
                    "ticket_id" => $ticket->id,
                    "user_id" => auth()->id(),
                    "comment" => $request->input("comment"),
                    "attachments" => $attachments,
                    "type_user" => "user"
                ]);
            }

            $admins = User::where("role", "admin")->get();

            foreach ($admins as $admin) {
                Notification::create([
                    "user_id" => $admin->id,
                    "type" => "App\Models\SupportTicket",
                    "message" => "Nuevo ticket de soporte creado: " . $ticket->ticket_number,
                    "reference_id" => $ticket->id
                ]);
            }


            $whatsappService = new WhatsAppService();
            $response =  $whatsappService->sendMessage("50375456642", "Nuevo ticket de soporte creado: " . $ticket->ticket_number);

            if (!$response["success"]) {
                return redirect()->back()->with(
                    "error",
                    "An error occurred while sending the message to WhatsApp. Please try again. Error: " . $response["message"]
                );
            }

            DB::commit();
            return redirect()->route("account.tickets.index")->with("success", "Ticket created successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "An error occurred while creating the ticket. Please try again. Error: " . $e->getMessage());
        }
    }

    private function generateTicketNumber()
    {
        return "TICKET-" . strtoupper(uniqid());
    }

    public function close(string $id)
    {
        DB::beginTransaction();
        try {
            $ticket = SupportTicket::where("user_id", auth()->id())->where("id", $id)->first();
            if (!$ticket) {
                return redirect()->route("account.tickets.index")->with("error", "Ticket not found");
            }
            $ticket->update(["status" => "closed"]);
            DB::commit();
            return redirect()->route("account.tickets.index")->with("success", "Ticket closed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("account.tickets.index")->with("error", "An error occurred while closing the ticket. Please try again. Error: " . $e->getMessage());
        }
    }
}