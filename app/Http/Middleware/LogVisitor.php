<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin/*')) {
            $existingVisitor = Visitor::where('ip_address', $request->ip())->first();

            if ($existingVisitor) {
                $existingVisitor->update([
                    'user_agent' => $request->header('User-Agent'),
                    'last_activity' => now('Asia/Ho_Chi_Minh'),
                    'students_id' => Auth::guard('students')->user() ? Auth::guard('students')->id() : null,
                    'created_at' => now('Asia/Ho_Chi_Minh'),
                ]);
            } else {
                Visitor::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'last_activity' => now('Asia/Ho_Chi_Minh'),
                    'students_id' => Auth::guard('students')->user() ? Auth::guard('students')->id() : null,
                    'created_at' => now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }

        return $next($request);
    }
}
