<?php

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }

    /**
 * @param string $msg string to output
 * @author WikiEditor
 * @copyright 2016 Wikipedia
 * @return string unchanged
 */
    function sum($a, $b) {
        return $a + $b;
    }

    echo sum(5, 3);

    $sumReflector = new \ReflectionFunction('sum');

    echo $sumReflector->getFileName() . '<br>';

    echo $sumReflector->getStartLine() . '<br>';
    echo $sumReflector->getEndLine() . '<br>';

    echo $sumReflector->getDocComment() . '<br>';

    vardump($sumReflector);

