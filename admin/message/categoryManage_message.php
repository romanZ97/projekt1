<?php

if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['remove']))
{
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}

if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if(isset($_SESSION['no-category-found']))
{
    echo $_SESSION['no-category-found'];
    unset($_SESSION['no-category-found']);
}

if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

if(isset($_SESSION['failed-remove']))
{
    echo $_SESSION['failed-remove'];
    unset($_SESSION['failed-remove']);
}

