<?php

declare(strict_types=1); // strict mode

namespace App\Controller;

use App\Helper\HTTP;
use App\Model\Carte;

class CarteController extends Controller
{
    /**
     * Page d'accueil pour lister tous les cartes.
     * @route [get] /
     *
     */
    public function index()
    {
        // récupérer les informations sur les cartes
        $cartes = Carte::getInstance()->findAll();
        // dans les vues TWIG, on peut utiliser la variable cartes
        $this->display('cartes/index.html.twig', compact('cartes'));
    }

    /**
     * Afficher le formulaire de saisie d'un nouvel carte ou traiter les
     * données soumises présentent dans $_POST.
     * @route [get]  /cartes/ajouter
     * @route [post] /cartes/ajouter
     *
     */
    public function create()
    {
        if ($this->isGetMethod()) {
            $this->display('cartes/create.html.twig');
        } else {
            // dd($_POST);
            // 1. préparer le nom du fichier (le nom original est modifié)
            $filename = '';
            // traiter l'éventuelle image de l'carte
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
                $destination = APP_ASSETS_DIRECTORY . 'image' . DS . 'carte' . DS . $filename;
                // placer le fichier dans son dossier cible (le fichier de la zone temporaire est effacé)
                move_uploaded_file($source, $destination);
            }
            // 2. exécuter la requête d'insertion
            Carte::getInstance()->create([
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
    
        // Récupérer l'carte existant
        $carte = Carte::getInstance()->find($id);
    
        if ($this->isGetMethod()) {
            // Passer l'carte à la vue pour préremplir le formulaire
            $this->display('cartes/edit.html.twig', compact('carte'));
        } else {
            // Traiter la requête POST pour la mise à jour
    
            // 1. Préparer le nom du fichier s'il y a une nouvelle image
            $filename = $carte['illustration']; // garder l'image existante par défaut
    
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
                $destination = APP_ASSETS_DIRECTORY . 'image' . DS . 'carte' . DS . $filename;
                // déplacer le fichier dans son dossier cible
                move_uploaded_file($source, $destination);
            }
    
            // 2. Exécuter la requête de mise à jour dans la base de données
            Carte::getInstance()->update($id, [
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
     * Effacer un carte.
     * @route [get] /cartes/effacer/{id}
     *
     */
    public function delete(
        int|string $id
    ) {
            // 1. Forcer l'ID à être un entier si nécessaire
    $id = (int) $id;

    // 2. Récupérer l'carte existant
    $carte = Carte::getInstance()->find($id);

    // 3. Vérifier si l'carte existe
    if (!$carte) {
        // Si l'carte n'existe pas, rediriger ou afficher un message d'erreur
        HTTP::redirect('/');
        return;
    }

    // 4. Supprimer l'image de l'carte s'il en a une
    if (!empty($carte['illustration'])) {
        $imagePath = APP_ASSETS_DIRECTORY . 'image' . DS . 'carte' . DS . $carte['illustration'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Supprimer l'image du serveur
        }
    }

    // 5. Supprimer l'carte de la base de données
    Carte::getInstance()->delete($id);

    // 6. Rediriger vers la page d'accueil après la suppression
    HTTP::redirect('/');
    }
}
