<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\Attachment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FileMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $attachment = Attachment::find($id);
        if ($attachment != null) {
            if (Auth::user()->role == UserRole::Admin) {
                return $next($request);
            }
            $tickets = $attachment->tickets()->get();
            foreach ($tickets as $ticket){
                if($ticket->transaction->business_id == Auth::id()){
                    return $next($request);
                }
                if ($ticket->technitian_id == Auth::id()){
                    return $next($request);
                }
            }
            $comments = $attachment->comments()->get();
            foreach ($comments as $comment){
                if($comment->author_id == Auth::id()){
                    return $next($request);
                }
                if ($comment->ticket->technitian_id == Auth::id()){
                    return $next($request);
                }
            }
        }
        return redirect()->route('login');
    }
}
