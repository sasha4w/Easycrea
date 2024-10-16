<?php

declare(strict_types=1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Helper\Security;
use App\Model\Deck;
use DateTime;

class DeckController extends Controller
{
    /**
     * Page d'accueil pour lister tous les decks.
     * @route [get] /
     *
     */
    public function index()
    {
        $isLoggedIn = isset($_SESSION['ad_mail_admin']);
        $ad_mail_admin = $isLoggedIn ? $_SESSION['ad_mail_admin'] : null;
        // récupérer les informations sur les decks
        $decks = Deck::getInstance()->findAll();
        // dans les vues TWIG, on peut utiliser la variable decks
        $this->display('decks/index.html.twig', compact('decks', 'isLoggedIn', 'ad_mail_admin'));
    }

    /**
     * Afficher le formulaire de saisie d'un nouvel deck ou traiter les
     * données soumises présentent dans $_POST.
     * @route [get]  /decks/ajouter
     * @route [post] /decks/ajouter
     *
     */
    public function create()
    {
        if ($this->isGetMethod()) {
            $this->display('decks/create.html.twig');
        } else {
            // dd($_POST);
            // 1. préparer le nom du fichier (le nom original est modifié)
            $filename = '';
            // traiter l'éventuelle image de l'deck
            if (!empty($_FILES['illustration']) && $_FILES['illustration']['type'] == 'image/webp') {
                // récupérer le nom et emplacement du fichier dans sa zone temporaire
                $source = $_FILES['illustration']['tmp_name'];
                // récupérer le nom originel du fichier
                $filename = $_FILES['illustration']['name'];
                // ajout d'un suffixe unique
                // récupérer séparément le nom du fichier et son extension
                $filename_name = pathinfo($filename, PATHINFO_FILENAME);
                $filename_extension = pathinfo($filename, PATHINFO_EXTENSION);
                // produire un suffixe unique
                $suffix = uniqid();
                $filename = $filename_name . '_' . $suffix . '.' . $filename_extension;
                // construire le nom et l'emplacement du fichier de destination
                $destination = APP_ASSETS_DIRECTORY . 'image' . DS . 'deck' . DS . $filename;
                // placer le fichier dans son dossier cible (le fichier de la zone temporaire est effacé)
                move_uploaded_file($source, $destination);
            }
            // 2. exécuter la requête d'insertion
            Deck::getInstance()->create([
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'display_name' => trim($_POST['display_name']),
                'illustration' => $filename,
            ]);
            HTTP::redirect('/');
        }
    }
    public function edit(int|string $id)
    {
        // Forcer l'ID à être un entier si nécessaire
        $id = (int)$id;
    
        // Récupérer l'deck existant
        $deck = Deck::getInstance()->find($id);
    
        if ($this->isGetMethod()) {
            // Passer l'deck à la vue pour préremplir le formulaire
            $this->display('decks/edit.html.twig', compact('deck'));
        } else {
            // Traiter la requête POST pour la mise à jour
    
            // 1. Préparer le nom du fichier s'il y a une nouvelle image
            $filename = $deck['illustration']; // garder l'image existante par défaut
    
            // Vérifier si une nouvelle image a été envoyée
            if (!empty($_FILES['illustration']) && $_FILES['illustration']['type'] == 'image/webp') {
                // récupérer le nom et emplacement du fichier dans sa zone temporaire
                $source = $_FILES['illustration']['tmp_name'];
                // récupérer le nom originel du fichier
                $filename = $_FILES['illustration']['name'];
                // ajout d'un suffixe unique
                $filename_name = pathinfo($filename, PATHINFO_FILENAME);
                $filename_extension = pathinfo($filename, PATHINFO_EXTENSION);
                $suffix = uniqid();
                $filename = $filename_name . '_' . $suffix . '.' . $filename_extension;
                // construire le nom et l'emplacement du fichier de destination
                $destination = APP_ASSETS_DIRECTORY . 'image' . DS . 'deck' . DS . $filename;
                // déplacer le fichier dans son dossier cible
                move_uploaded_file($source, $destination);
            }
    
            // 2. Exécuter la requête de mise à jour dans la base de données
            Deck::getInstance()->update($id, [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'display_name' => trim($_POST['display_name']),
                'illustration' => $filename, // utilise soit l'image existante, soit la nouvelle
            ]);
    
            // 3. Rediriger vers la page d'accueil après la mise à jour
            HTTP::redirect('/');
        }
    }
    
    /**
     * Effacer un deck.
     * @route [get] /decks/effacer/{id}
     *
     */
    public function delete(
        int|string $id
    ) {
            // 1. Forcer l'ID à être un entier si nécessaire
    $id = (int) $id;

    // 2. Récupérer l'deck existant
    $deck = Deck::getInstance()->find($id);

    // 3. Vérifier si l'deck existe
    if (!$deck) {
        // Si l'deck n'existe pas, rediriger ou afficher un message d'erreur
        HTTP::redirect('/');
        return;
    }

    // 4. Supprimer l'image de l'deck s'il en a une
    if (!empty($deck['illustration'])) {
        $imagePath = APP_ASSETS_DIRECTORY . 'image' . DS . 'deck' . DS . $deck['illustration'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Supprimer l'image du serveur
        }
    }

    // 5. Supprimer l'deck de la base de données
    Deck::getInstance()->delete($id);

    // 6. Rediriger vers la page d'accueil après la suppression
    HTTP::redirect('/');
    }
}
