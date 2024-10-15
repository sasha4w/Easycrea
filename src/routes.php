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
    ['GET', '/administrateurs/index', 'administrateur@index'],
    ['GET', '/administrateurs/effacer/{id:\d+}', 'administrateur@delete'],
    // afficher le formulaire d'ajout d'un nouvel adiministrateur
    ['GET', '/adiministrateurs/ajouter', 'administrateur@create'],
    // enregistrer les données soumises d'un nouvel adiministrateur
    ['POST', '/adiministrateurs/ajouter', 'administrateur@create'],

    // Créateur  
    ['GET', '/createurs/index', 'createur@index'],
    ['GET', '/createurs/effacer/{id:\d+}', 'createur@delete'],
    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/createurs/ajouter', 'createur@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/createurs/ajouter', 'createur@create'],
    
    // Carte  
    ['GET', '/cartes/index', 'carte@index'],
    ['GET', '/cartes/effacer/{id:\d+}', 'carte@delete'],
    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/cartes/ajouter', 'carte@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/cartes/ajouter', 'carte@create'],

    // Deck  
    ['GET', '/decks/index', 'deck@index'],
    ['GET', '/decks/effacer/{id:\d+}', 'deck@delete'],
    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/decks/ajouter', 'deck@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/decks/ajouter', 'deck@create'],

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
