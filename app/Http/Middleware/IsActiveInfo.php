<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;

class IsActiveInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $childId = $request->route('child_id');
        $cat = Category::find($childId);
        if ($cat->is_active === 'false') {
            return abort(404);
        }

        return $next($request);
    }
}
