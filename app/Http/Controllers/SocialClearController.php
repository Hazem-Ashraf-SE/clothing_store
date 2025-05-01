<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SocialClearController extends Controller
{
    /**
     * Clear social login data for a specific provider or all providers
     *
     * @param string|null $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearSocialData($provider = null)
    {
        try {
            if ($provider) {
                // Clear data for a specific provider
                $count = User::where('provider', $provider)->update([
                    'provider' => null,
                    'provider_id' => null,
                    'avatar' => null
                ]);
                
                return redirect()->back()->with('success', "Cleared {$count} {$provider} login connections.");
            } else {
                // Clear all social login data
                $count = User::whereNotNull('provider')->update([
                    'provider' => null,
                    'provider_id' => null,
                    'avatar' => null
                ]);
                
                return redirect()->back()->with('success', "Cleared {$count} social login connections.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error clearing social data: ' . $e->getMessage());
        }
    }
}
