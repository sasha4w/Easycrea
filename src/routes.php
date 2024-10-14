<?php

declare(strict_types=1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
 */

return [

    // afficher le formulaire d'ajout d'un nouvel administrateur
    ['GET', '/administrateurs/ajouter', 'administrateur@create'],
    // enregistrer les données soumises d'un nouvel administrateur
    ['POST', '/administrateurs/ajouter', 'administrateur@create'],


    // afficher le formulaire d'ajout d'un nouvel administrateur
    ['GET', '/administrateurs/ajouter', 'administrateur@create'],
    // enregistrer les données soumises d'un nouvel administrateur
    ['POST', '/administrateurs/ajouter', 'administrateur@create'],

    // afficher le formulaire d'édition un avatar existant
    // à compléter ...

    // enregistrer les modifications sur un avatar existant
    // à compléter ...

    // effacer un avatar
    ['GET', '/administrateur/effacer/{id:\d+}', 'administrateur@delete'],

];
