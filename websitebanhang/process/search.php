<?php
    session_start();

    if ($_POST['searchStore'] != ""){
        $_SESSION['searchStore'] = $_POST['searchStore'];
        header("location:../store.php");
    }
    else if ($_POST['searchAdmin'] != ""){
        $_SESSION['searchAdmin'] = $_POST['searchAdmin'];
        header("location:../adminItem.php");
    }
    else
    {
        $_SESSION['search'] = $_POST['search'];
        header("location:../Home.php");
    }

    if ($_POST['btn-delete'] != ""){
        unset($_SESSION['searchAdmin']);
        unset($_SESSION['search']);
        header('location:../adminItem.php');
    }

    if ($_POST['btn-del'] != ""){
        unset($_SESSION['searchStore']);
        if ($_GET['option'] == 'store'){
            header('location: ../store.php');
        }
    }
?>

