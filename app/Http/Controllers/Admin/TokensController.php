<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    public function showTokens(Request $request) {
        $tokens = ApiToken::where('invalidated', false);
        $order = $request->query('order');
        if ($order == 'order_date') {
            $tokens = $tokens->orderBy('expiration_date', 'desc');
        } else if ($order == 'order_uses') {
            $tokens = $tokens->orderBy('times_used', 'desc');
        }
        $tokens = $tokens->paginate(5)->withQueryString();
        return view('dashboard.pages.tokens',
            ['tokens' => $tokens]);
    }

    public function invalidateToken(Request $request, $id) {
        $token = ApiToken::findOrFail($id);
        if (!$token) {
            return redirect()->back()->with('error', 'Token not found');
        }
        $token->invalidated = true;
        $token->save();
        return redirect()->back()->with('success', 'Token invalidated successfully');
    }
}
