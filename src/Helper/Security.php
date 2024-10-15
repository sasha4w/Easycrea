<?php

namespace App\Helper;

class Security
{
    /**
     * Générer un token CSRF et le stocker dans la session.
     *
     * @return string
     */
    public static function generateCsrfToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    /**
     * Vérifier si le token CSRF soumis est valide.
     *
     * @param string $token
     * @return bool
     */
    public static function verifyCsrfToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Gérer un token CSRF invalide.
     */
    public static function handleInvalidCsrfToken()
    {
        die("Erreur : token CSRF invalide.");
    }
}
