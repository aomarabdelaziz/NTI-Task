<?php

namespace App\Http\Middleware;

use App\Models\Todo;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckExpiredDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route()->parameters();
        $end_date = Todo::firstWhere('id',$id)->end_date;
        $now  = date('Y-m-d');

        if($now >= $end_date) {
            session()->flash('error' , 'You cannot delete this task, the task date is expired');
            return redirect()->route('todos.index');
        }

        return $next($request);
    }
}
