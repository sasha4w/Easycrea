<?php

namespace App\Controller;

class Controller
{
    protected $twig;
    protected $log;

    public function __construct()
    {
        // référence aux variables globales !!!
        global $twig, $logger;
        // ajouter 3 attributs pour tous les contrôleurs
        $this->twig = $twig;
        $this->log = $logger;
    }

    /**
     * Afficher une vue.
     *
     * @param string $view
     * @param array $datas
     * @return void
     */
    public function display(
        string $view = 'index',
        array $datas = []
    ) {
                // Définition de la base URL dynamique
        $base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/ReignsWebapp/public";

        // Ajouter base_url aux données pour Twig
        $datas['base_url'] = $base_url;
        return $this->twig->display($view, $datas);
    }


    /**
     * Retourner un HTML généré par TWIG.
     *
     * @param string $view
     * @param array $datas
     * @return string
     */
    public function render(
        string $view = 'index',
        array $datas = []
    ): string {
        return $this->twig->render($view, $datas);
    }

    /**
     * Indiquer si la requête est de type AJAX.
     * Le header de la requête doit contenir le paramètre X-Requested-With=XMLHttpRequest
     *
     * @return boolean
     */
    public function isAjaxRequest(): bool
    {
        $headers = getallheaders();
        return isset($headers['X-Requested-With']) && $headers['X-Requested-With'] === 'XMLHttpRequest';
    }

    /**
     * Indiquer si la méthode est GET.
     *
     * @return boolean
     */
    public function isGetMethod(): bool
    {
        return 'GET' === strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Indiquer si la méthode est POST.
     *
     * @return boolean
     */
    public function isPostMethod(): bool
    {
        return 'POST' === strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Retourner une structure JSON.
     *
     * @param array $response
     * @return string
     */
    public function json(array $response): string
    {
        header('Content-Type: application/json');
        return print(json_encode($response));
    }
    public function accueil()
    {
                // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Détruire la session pour réinitialiser les données
        session_destroy();
        $_SESSION = [];

        // dans les vues TWIG, on peut utiliser la variable administrateurs
        $this->display('/index.html.twig');
    }
}
