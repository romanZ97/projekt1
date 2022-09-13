<?php

if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}

if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}


