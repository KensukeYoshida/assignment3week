<?php 
  session_start();
  require('dbconnect.php');
  $_SESSION['login_member_id']= 1;

  if (!isset($_SESSION['join'])) {
    header('Location:newdia.php');
    exit();
  }

  echo '<pre>';
  var_dump($_SESSION['join']);
  echo '</pre>';

      // 完了ボタンを押した時
    if (!empty($_POST)) {
      $title= $_SESSION['join']['title'];
      $content= $_SESSION['join']['content'];
      try{

      $sql='INSERT INTO `diary` SET `diary_id`=?, `title`=?, `user_id`=?, `content`=?, `created`=NOW()'; //1
      $data= array(null,$title, $_SESSION['login_member_id'], $content);// 2
      $stmt= $dbh->prepare($sql);//3
      $stmt->execute($data);//4
      // SESSIONの情報を削除
      // unset($_SESSION['join']);

      header('Location:kadai.php');
      exit();
      }catch(PDOException $e){//例外が起きた時
      echo 'SQL文実行時エラー: ' . $e->getMessage();
      exit();
    }
  }



 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
  <meta charset="utf-8">
   <title>新規追加確認</title>
 </head>
 <body>
  <h1>追加内容確認</h1>
    <div>
      [タイトル]<br>
      <?php echo $_SESSION['join']['title']; ?>
    </div>
    <div>
      [日記内容]<br>
      <?php echo $_SESSION['join']['content']; ?>
    </div>
    <form method="POST" action="">
      <input type="submit" value="完了">
      <input type="hidden" name="title" value= "<?php echo $title; ?>">
      <input type="hidden" name="content" value= "<?php echo $content; ?>">
    </form>
 </body>
 </html>