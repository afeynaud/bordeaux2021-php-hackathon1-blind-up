<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)


/* return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'game' => ['GameController', 'showGameDatas'],
    'game/tout-afficher'     => ['GameController', 'showAll', ['id'],],
    'addSong' => ['GameController', 'add'],
];*/
  
  return [
    ''                       => ['UserController', 'connect',],
    'profil'                 => ['UserController', 'profil',],
    'user/inscription'       => ['UserController', 'add',],
    'user/profil'            => ['UserController', 'index', ['id']],
    'deconnecter'            => ['UserController', 'logout'],
    'game/tout-afficher'     => ['GameController', 'showAll', ['id'],],
    'game'                   => ['GameController', 'showGameDatas',['id']],
    'game/answer-validation' => ['GameController', 'answerValidation'],
    'addSong'                => ['GameController', 'add'],
    'game/tout-afficher'     => ['GameController', 'showAll', ['id'],],
    'classement'             => ['LeaderboardController', 'index',],
  ];
