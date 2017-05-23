<?php 
  session_start();
  require('dbconnect.php');
  $_SESSION['login_member_id']=1;

  $title = '';
  $content = '';

  $errors =array();
  // 送信ボタンをおしたとき
  if (!empty($_POST)) {
    $title= $_POST['title'];
    $content = $_POST['content'];
  // エラーバリデーション
    if ($title=='') {
      $errors['title']='blank';
    }
     if ($content=='') {
      $errors['content']='blank';
    }
  // エラーがなければ
    if (empty($erros)) {
      $_SESSION['join']= $_POST; // セッションに保存
      header('Location:check_diary.php'); // 強制的に遷移される
      exit();
    }
  }
 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
  <meta charset="utf-8">
   <title></title>
 </head>
 <body>
   <h1>新規日記追加</h1>
   <form method="POST" action="">
     <div>
     タイトル<br>
     <input type="text" name="title" value="<?php echo $title;?>" style="width: 100px;">
     </div>

     <div>
     日記内容<br>
     <textarea name="content" value="<?php echo $content; ?>" cols="40" rows="5"> </textarea>
     </div>
     <input type="submit" value="送信">
   </form>
 </body>
 </html>