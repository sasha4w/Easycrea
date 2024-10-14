<?php

declare(strict_types=1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
 */

return [



    // afficher le formulaire d'ajout d'un nouvel avatar
    ['GET', '/avatars/ajouter', 'avatar@create'],
    // enregistrer les données soumises d'un nouvel avatar
    ['POST', '/avatars/ajouter', 'avatar@create'],

    // afficher le formulaire d'édition un avatar existant
    ['GET', '/avatars/éditer/{id}', 'avatar@edit'],

    // enregistrer les modifications sur un avatar existant
    ['POST', '/avatars/éditer/{id}', 'avatar@edit'],

    // effacer un avatar
    ['GET', '/avatars/effacer/{id:\d+}', 'avatar@delete'],

    // afficher les étudiants
    ['GET', '/administrateurs', 'administrateur@index'],
    ['GET', '/', 'administrateur@index'],

    // afficher les parcours
    ['GET', '/parcours', 'parcours@index'],

    ['GET', '/parcours/{p}', 'parcours@showParcoursInfo'],

    ['GET', '/administrateur/effacer/{id:\d+}', 'administrateur@delete'],

];
