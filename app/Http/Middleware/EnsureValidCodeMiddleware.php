<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidCodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'code' => [
                'required',
                'string',
                'size:13',
                Rule::exists(Code::class, 'code')->whereNull('consumed_at')
            ]
        ]);

        if ($validator->fails()) {
            return redirect(route('login'))
                ->withErrors($validator)
                ->withInput();
        }

        // Fetch corresponding code
        $code = Code::with('host')->firstWhere(['code' => $request->code]);

        // Inject code to container
        app()->instance(Code::class, $code);

        return $next($request);
    }
}
