<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function userTickets(string $userId)
    {
        // Paginate tickets with 5 per page
        $tickets = SupportTicket::where('user_id', $userId)
            ->select('id', 'ticket', 'subject', 'status', 'priority', 'last_reply', 'created_at')
            ->paginate(5); // Limit to 5 tickets per page

        // Transform the ticket data
        $tickets->getCollection()->transform(function ($ticket) {
            // Map status to readable values
            $statusMap = [
                0 => 'Open',
                1 => 'Answered',
                2 => 'Replied',
                3 => 'Closed',
            ];
            $ticket->status = $statusMap[$ticket->status] ?? 'Unknown';

            // Map priority to readable values
            $priorityMap = [
                1 => 'Low',
                2 => 'Medium',
                3 => 'High',
            ];
            $ticket->priority = $priorityMap[$ticket->priority] ?? 'Unknown';

            // Handle last_reply field, fallback to created_at if null
            $ticket->last_reply = $ticket->last_reply ?? $ticket->created_at;

            $ticket->last_reply = \Carbon\Carbon::parse($ticket->last_reply)->diffForHumans();

            return $ticket;
        });

        // Return the paginated result as JSON
        return response()->json([
            'success' => true,
            'message' => 'Tickets retrieved successfully.',
            'tickets' => $tickets->items(), // Items per page
            'current_page' => $tickets->currentPage(),
            'last_page' => $tickets->lastPage(),
            'total' => $tickets->total(),
        ]);
    }

    public function singleTicket(string $ticketId)
    {
        // Retrieve the support ticket with associated support messages and attachments
        $supportTicket = SupportTicket::where('ticket', $ticketId)
            ->select('id', 'name', 'ticket', 'subject', 'status', 'priority', 'last_reply', 'created_at')
            ->with(['supportMessage' => function ($query) {
                $query->select('id', 'admin_id', 'message', 'created_at', 'support_ticket_id')
                    ->with(['attachments' => function ($subQuery) {
                        $subQuery->select('id', 'support_message_id', 'attachment')
                            ->addSelect(DB::raw("CONCAT('http://egovision.shop/assets/support/', attachment) as attachment")); // Add prefix to attachment
                    }]);
            }])
            ->first();

        // Check if the support ticket exists
        if (!$supportTicket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        // Map status and priority
        $statusMap = [
            0 => 'Open',
            1 => 'Answered',
            2 => 'Replied',
            3 => 'Closed',
        ];
        $supportTicket->status = $statusMap[$supportTicket->status] ?? 'Unknown';

        $priorityMap = [
            1 => 'Low',
            2 => 'Medium',
            3 => 'High',
        ];
        $supportTicket->priority = $priorityMap[$supportTicket->priority] ?? 'Unknown';

        // Transform support messages to include attachments with prefixed URLs
        if ($supportTicket->supportMessage) {
            $supportTicket->supportMessage->transform(function ($message) {
                // Format created_at as a normal date
                $message->created_at = \Carbon\Carbon::parse($message->created_at)->format('d M, Y');

                return $message;
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Support ticket retrieved successfully.',
            'supportTicket' => $supportTicket,
        ]);
    }


    public function contactSubmit(Request $request, string $userId)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust max size and allowed types as needed
            ]);
    
            // Generate a new support ticket number
            $random = getNumber();
    
            // Create a new support ticket
            $ticket = new SupportTicket();
            $ticket->user_id = $userId ?? 0;
            $ticket->name = $validatedData['name'];
            $ticket->email = $validatedData['email'];
            $ticket->priority = $request->priority;
            $ticket->ticket = $random;
            $ticket->subject = $validatedData['subject'];
            $ticket->last_reply = Carbon::now();
            $ticket->status = Status::TICKET_OPEN;
            $ticket->save();
    
            // Create an admin notification for the new ticket
            $adminNotification = new AdminNotification();
            $adminNotification->user_id = $userId ? $userId : 0;
            $adminNotification->title = 'A new support ticket has opened';
            $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
            $adminNotification->save();
    
            // Create a new support message associated with the ticket
            $message = new SupportMessage();
            $message->support_ticket_id = $ticket->id;
            $message->message = $validatedData['message'];
            $message->save();
    
            if ($request->hasFile('attachment')) {

                $attachmentPath = 'assets/support';
                $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                $request->file('attachment')->move(public_path($attachmentPath), $fileName);
                

                $attachment = new SupportAttachment();
                $attachment->support_message_id = $message->id;
                $attachment->attachment = $fileName;
                $attachment->save();
            }
    
            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully!',
                'ticket' => [
                    'ticket_number' => $ticket->ticket,
                    'subject' => $ticket->subject,
                    'status' => $ticket->status,
                    'priority' => $ticket->priority,
                ]
            ], 201); // HTTP status 201 for created
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $e->validator->errors()
            ], 422); // HTTP status 422 for unprocessable entity
    
        } catch (\Exception $e) {
            // Return a general error message
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the ticket. Please try again later.',
                'error' => $e->getMessage()
            ], 500); // HTTP status 500 for server error
        }
    }
    
}
