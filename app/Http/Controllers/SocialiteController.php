<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        try {
            // Special handling for LinkedIn
            if ($provider === 'linkedin') {
                \Log::info("LinkedIn redirect initiated with client_id: " . config('services.linkedin.client_id'));
                
                // Use a more robust approach for LinkedIn
                return Socialite::driver($provider)
                    ->redirect();
            }
            
            // For other providers, use the default flow
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            // Log the error with more details
            \Log::error("Error in redirectToProvider for {$provider}: " . $e->getMessage());
            \Log::error("Error trace: " . $e->getTraceAsString());
            
            return redirect('/login')->with('error', 'Error connecting to ' . $provider . ': ' . $e->getMessage());
        }
    }

    /**
     * Handle provider callback.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            // Special handling for LinkedIn
            if ($provider === 'linkedin') {
                \Log::info("LinkedIn callback received with client_id: " . config('services.linkedin.client_id'));
                
                // Get the authorization code from the request
                $code = request()->input('code');
                if (!$code) {
                    throw new \Exception('No authorization code provided');
                }
                
                \Log::info("LinkedIn authorization code received: " . substr($code, 0, 10) . '...');
                
                // Get the user
                $socialUser = Socialite::driver($provider)->user();
                
                // Log user data for debugging
                \Log::info("LinkedIn user data: " . json_encode([
                    'id' => $socialUser->getId(),
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                ]));
            } else {
                // For other providers, use the default flow
                $socialUser = Socialite::driver($provider)->user();
            }
            
            // Special handling for Twitter which might not provide email
            $email = $socialUser->getEmail();
            if ($provider === 'twitter' && empty($email)) {
                // For Twitter, use a combination of provider and ID if email is not available
                $twitterId = $socialUser->getId();
                $email = "twitter_{$twitterId}@placeholder.com";
            }
            
            // Find existing user by provider ID first, then by email
            $user = User::where('provider', $provider)
                        ->where('provider_id', $socialUser->getId())
                        ->first();
                        
            if (!$user) {
                $user = User::where('email', $email)->first();
            }
            
            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'email' => $email,
                    'password' => Hash::make(Str::random(16)),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                // Update existing user with provider info if needed
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }
            
            // Log the user in
            Auth::login($user, true);
            
            return redirect()->intended('/');
            
        } catch (Exception $e) {
            // Log the error for debugging with more details
            \Log::error("Social login error with {$provider}: " . $e->getMessage());
            \Log::error("Exception trace: " . $e->getTraceAsString());
            
            if ($provider === 'linkedin') {
                // Log LinkedIn specific configuration for debugging
                \Log::error("LinkedIn configuration: " . json_encode([
                    'client_id' => config('services.linkedin.client_id'),
                    'redirect' => config('services.linkedin.redirect'),
                    'api_version' => config('services.linkedin.api_version'),
                ]));
                
                // Log request details
                \Log::error("LinkedIn callback request: " . json_encode([
                    'code' => request()->input('code') ? 'present' : 'missing',
                    'state' => request()->input('state') ? 'present' : 'missing',
                    'error' => request()->input('error'),
                    'error_description' => request()->input('error_description'),
                ]));
            }
            
            return redirect('/login')->with('error', 'Something went wrong with ' . $provider . ' login: ' . $e->getMessage());
        }
    }
}
