<?php 
session_start();
require('dbconnect.php');

// 各入力値を保持する変数を用意
$nick_name = '';
$email     = '';
$password  = '';

// エラー格納用の配列を用意
$errors = array();

//書き直し処理
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
    // パラメータ = URLの最後に?から始まる部分のデータ
    // ?key1=value1&key2=value2&key3=value3...
    // 上記が基本フォーマット、keyとvalueの組み合わせで記述し、&でつなげていく
    echo '<pre>';
    var_dump($_REQUEST);
    echo '</pre>';
    echo $_REQUEST['action'];

    $_POST = $_SESSION ['join'];
    $errors['rewrite'] = true;//書き直しようにエラーを作成
}

// 確認画面へボタンが押されたとき
if (!empty($_POST)) {
    $nick_name = $_POST['nick_name'];
    $email =$POST['email'];
    $password = $_POST['password'];

    // ページ内バリデーション
    if ($nick_name == '') {
     // ニックネームのフォームが空のため、画面にエラーを出力
    $errors['nick_name'] ='blank';//
    //blank部分はどんな文字列でも良い
    }
    if ($email == '') {
        $errors['email'] = 'blank';
    }
    if ($password == '') {
        $errors['password'] = 'blank';
    } elseif (strlen($password) < 4) {
        $errors['password'] = 'length';
    }

    if (empty($errors)) {
        // 画像のバリデーション
        $file_name = $_FILES['picture_path']['name'];
        // name部分は固定、picture_path部分はinputタグのtype="file"のname部分
        if (!empty($file_name)) {
            // 画像が選択されていた場合
            $ext = substr($file_name, -3); // ファイル名から拡張子部分取得
            $ext = strtolower($ext); // 大文字対応
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
                $errors['picture_path'] = 'type';
            }
        } else {
            // 画像が未選択の場合
            $errors['picture_path'] = 'blank';
        }
  }

    // メールアドレスの重複チェック
    if (empty($errors)) {
      // DBのmembersテーブルに入力されたメールアドレスと同じデータがあるかどうか検索し取得
      try {
          $sql = 'SELECT COUNT(*) AS `cnt` FROM `users` WHERE `email`=?';
          $data = array($email);
          $stmt = $dbh->prepare($sql);
          $stmt->execute($data);
          $record = $stmt->fetch(PDO::FETCH_ASSOC);
          // var_dump($record);
          if ($record['cnt'] > 0) {
              // 同じメールアドレスがDB内に存在したため
              $errors['email'] = 'duplicate';
          }
        
          } catch (PDOException $e) {
            echo 'SQL文実行時エラー: ' . $e->message();
        }
    }

    // エラーがなかった場合の処理
    if (empty($errors)) {
        // 画像アップロード処理
        $picture_name = date('YmdHis') . $file_name;
          // 20170308152500shinya.jpg ←画像ファイル名作成
        move_uploaded_file($_FILES['picture_path']['tmp_name'], 
          '../member_picture/' . $picture_name);

        $_SESSION['join'] = $_POST; // joinは何でも良い
        $_SESSION['join']['picture_path'] = $picture_name;
        header('Location: check.php');
        exit();
    }
}

 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Diary</title>
     <!-- Bootstrap -->
      <link href="../css/bootstrap.css" rel="stylesheet">
      <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="../css/form.css" rel="stylesheet">
      <link href="../css/timeline.css" rel="stylesheet">
      <link href="../css/main.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-defalt navbar-fixed-top">
    <div class="navar-header page-scroll">
      <button type ="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html">
        <span class="strong-title">
        <i class = "fa fa-twitter-square"></i>
        Daiary</span></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
  <!-- /.container-fluid -->
</nav>

  <div class ="container">
    <div class "row">
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <legend>会員登録</legend>
        <form method="post" action="" class="form-horizontal" role ="form" enctype="multipart/form-data"></form>
        <!-- ニックネーム -->
        <div class="form-group"></div>
        <label class="col-sm-4 control-label">ニックネーム</label></label>
        <div class="col-sm-8">
           <input type="text" name="nick_name" class="form-control" placeholder="例： Seed kun">
           <?php if(isset($errors['nick_name']) && $errors['nick_name'] == 'blank'): ?><!-- コロン構文 -->
            <p style="color: red; font-size: 10px; margin-top:2px;">ニックネームを入力してください</p>
           <?php endif; ?>
           </div>
        </div>

         <!-- メールアドレス -->
        <div class="form-group">
          <label class="col-sm-4 control-label">メールアドレス</label>
          <div class="col-sm-8">
            <input type="email" name="email" class="form-control" placeholder="例： seed@nex.com">
            <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?> <!-- コロン構文 -->
                <p style="color: red; font-size: 10px; margin-top: 2px;">
                  メールアドレスを入力してください
                </p>
              <?php endif; ?>

             <?php if(isset($errors['email']) && $errors['email'] == 'duplicate'): ?> <!-- コロン構文 -->
               <p style="color: red; font-size: 10px; margin-top: 2px;">
                 指定したメールアドレスは既に登録されています。
               </p>
             <?php endif; ?>
        </div>
      </div>
      <!-- パスワード -->
    <div class="form-group">
      <label class="col-sm-4 control-label">パスワード</label>
      <div class="col-sm-8">
        <input type="password" name="password" class="form-control" placeholder="">
        <?php if(isset($errors['password']) && $errors['password'] == 'blank'): ?> <!-- コロン構文 -->
          <p style="color: red; font-size: 10px; margin-top: 2px;">
            パスワードを入力してください
          </p>
        <?php endif; ?>
        <?php if(isset($errors['password']) && $errors['password'] == 'length'): ?> <!-- コロン構文 -->
          <p style="color: red; font-size: 10px; margin-top: 2px;">
            パスワードは4文字以上で入力してください
          </p>
        <?php endif; ?>
      </div>
    </div>
      <!-- プロフィール写真 -->
      <div class="form-group">
        <label class="col-sm-4 control-label">プロフィール写真</label>
        <div class="col-sm-8">
          <input type="file" name="picture_path" class="form-control">
          <?php if(isset($errors['picture_path']) && $errors['picture_path'] == 'blank'): ?> <!-- コロン構文 -->
            <p style="color: red; font-size: 10px; margin-top: 2px;">
            プロフィール画像を選択してください
            </p>
          <?php endif; ?>

          <?php if(isset($errors['picture_path']) && $errors['picture_path'] == 'type'): ?> <!-- コロン構文 -->
            <p style="color: red; font-size: 10px; margin-top: 2px;">
              プロフィール画像は「.gif」「.jpg」「.png」の画像を指定してください
            </p>
          <?php endif; ?>

          <?php if(!empty($errors)): ?> <!-- コロン構文 -->
            <p style="color: red; font-size: 10px; margin-top: 2px;">
              プロフィール画像を再度指定してください
            </p>
          <?php endif; ?>
        </div>
      </div>

        <input type="submit" class="btn btn-default" value="確認画面へ">
      </form>
    </div>
  </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-3.1.1.js"></script>
    <script src="../js/jquery-migrate-1.4.1.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
 </html>