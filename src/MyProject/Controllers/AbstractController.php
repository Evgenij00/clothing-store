<?php

    namespace MyProject\Controllers;

    use MyProject\Services\UsersAuthService;
    use MyProject\View\View;

    class AbstractController {

        protected $view;
        protected $user;

        public function __construct() {

            $this->user = UsersAuthService::getUserByToken(); //находим юзера по токену
            $this->view = new View(__DIR__ . '/../../../templates');
            $this->view->setVar('user', $this->user); //записываем юзера в качестве доп параметров во view
            
        }

    }