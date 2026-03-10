<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Allow only "active" accounts.
     *
     * Inactive includes:
     * - unverified email (email_verified_at is null)
     * - suspended (suspended_at not null, or is_suspended true)
     * - explicit status fields (status/account_status) in known inactive values
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect('/');
        }

        if (!$this->isAccountActive($user)) {
            return redirect()
                ->route('account.inactive')
                ->with('error', 'Your account is not active.');
        }

        return $next($request);
    }

    private function isAccountActive(object $user): bool
    {
        $emailVerifiedAt = $this->getAttribute($user, 'email_verified_at');

        // Unverified email (Laravel default)
        if ($emailVerifiedAt === null) {
            return false;
        }

        // Suspension flags (common patterns)
        if ($this->getAttribute($user, 'suspended_at') !== null) {
            return false;
        }

        if ((bool) $this->getAttribute($user, 'is_suspended') === true) {
            return false;
        }

        // Status string fields (common patterns)
        foreach (['status', 'account_status'] as $field) {
            $value = $this->getAttribute($user, $field);
            if (!is_string($value)) {
                continue;
            }

            $normalized = strtolower(trim($value));
            if (in_array($normalized, ['inactive', 'suspended', 'incomplete', 'unverified', 'pending'], true)) {
                return false;
            }
        }

        return true;
    }

    private function getAttribute(object $user, string $key): mixed
    {
        if (method_exists($user, 'getAttribute')) {
            return $user->getAttribute($key);
        }

        return $user->{$key} ?? null;
    }
}

