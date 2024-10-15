<?php

declare(strict_types=1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
 */

return [



    
    ['GET', '/', '@accueil'],
    // Administrateur  
    ['GET', '/administrateurs', 'administrateur@index'],
    ['GET', '/administrateurs/effacer/{id:\d+}', 'administrateur@delete'],
    // afficher le formulaire d'ajout d'un nouvel adiministrateur
    ['GET', '/adiministrateurs/ajouter', 'administrateur@create'],
    // enregistrer les données soumises d'un nouvel adiministrateur
    ['POST', '/adiministrateurs/ajouter', 'administrateur@create'],
    
    // afficher le formulaire de connexion d'un createur
    ['GET', '/administrateurs/connexion', 'administrateur@login'],
    // enregistrer les données soumises d'un nouvel createur
    ['POST', '/administrateurs/connexion', 'administrateur@login'],
    // déconnecter le créateur
    ['GET', '/administrateurs/deconnexion', 'administrateur@logout'],

    // Créateur  
    ['GET', '/createurs', 'createur@index'],
    ['GET', '/createurs/effacer/{id:\d+}', 'createur@delete'],
    // afficher le formulaire d'ajout d'un nouveau createur
    ['GET', '/createurs/ajouter', 'createur@create'],
    // enregistrer les données soumises d'un nouveau createur
    ['POST', '/createurs/ajouter', 'createur@create'],

    // afficher le formulaire de connexion d'un createur
    ['GET', '/createurs/connexion', 'createur@login'],
    // enregistrer les données soumises d'un nouvel createur
    ['POST', '/createurs/connexion', 'createur@login'],
    // déconnecter le créateur
    ['GET', '/createurs/deconnexion', 'createur@logout'],
    
    // Carte  
    ['GET', '/cartes', 'carte@index'],
    ['GET', '/cartes/effacer/{id:\d+}', 'carte@delete'],
    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/cartes/ajouter', 'carte@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/cartes/ajouter', 'carte@create'],

    // Deck  
    ['GET', '/decks', 'deck@index'],
    ['GET', '/decks/effacer/{id:\d+}', 'deck@delete'],
    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/decks/ajouter', 'deck@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/decks/ajouter', 'deck@create'],



    /////////////////////////////////////////////////////

    // afficher le formulaire d'édition un avatar existant
    ['GET', '/avatars/éditer/{id}', 'avatar@edit'],

    // enregistrer les modifications sur un avatar existant
    ['POST', '/avatars/éditer/{id}', 'avatar@edit'],

    // effacer un avatar
    ['GET', '/avatars/effacer/{id:\d+}', 'avatar@delete'],
    // afficher les parcours
    ['GET', '/parcours', 'parcours@index'],
    
    ['GET', '/parcours/{p}', 'parcours@showParcoursInfo'],
    

];
