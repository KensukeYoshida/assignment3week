<?php 
    session_start();
    require('dbconnect.php');
    $_SESSION['login_member_id']= 1;

    if (empty($erros)) {
      $_SESSION['join']= $_POST; // セッションに保存
      header('Location:login.php'); // 強制的に遷移される
      exit();
    }
    echo '<pre>';
    var_dump($_SESSION['join']);
    echo '</pre>';

    //完了ボタンを押した時
    if (!empty($_POST)) {
      $title = $_SESSION['join']['title'];
      $content = $_SESSION['join']['content'];
      
    }

 ?>