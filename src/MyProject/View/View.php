<?php

    namespace MyProject\View;

    class View {
        private $templatesPath;

        public function __construct(string $templatesPath) {
            $this->templatesPath = $templatesPath;
        }

        public function renderHtml(string $templateName, array $vars = [], int $code = 200) {

            http_response_code($code); //задаем когд ответа (404, 200 ...)

            extract($vars); //Функция extract извлекает массив в переменные. То есть она делает следующее: в неё передаётся массив ['key1' => 1, 'key2' => 2], а после её вызова у нас имеются переменные $key1 = 1 и $key2 = 2.


            // В тот момент, когда мы подключаем файл c HTML-кодом, либо пишем в PHP-коде echo, либо совершаем какой-либо другой вывод данных, эти данные начинают сразу передаваться в поток вывода. И если что-то пойдёт не так, мы не сможем вернуть этот вывод и вывести вместо него какую-нибудь ошибку. Но в PHP есть возможность весь этот поток вывода положить во временный буфер вывода. Выглядит его использование следующим образом:
            ob_start();
            include $this->templatesPath . '/' . $templateName;
            $buffer = ob_get_contents();
            ob_end_clean();

            $error = '';

            if (!empty($error)) {
                echo $error;
            } else {
                echo $buffer;
            }
        }
    }