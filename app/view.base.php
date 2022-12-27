<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
class ViewBase
{
    function __construct()
    {
    }

    function render($vista)
    {
        require("views/" . $vista . ".view.php");
    }
}
