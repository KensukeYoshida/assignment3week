 <?php
    session_start();
    require('dbconnect.php');
    $_SESSION['login_member_id'] = 1;


    // // １．データベースに接続する
    // $dsn = 'mysql:dbname=phpkiso;host=localhost';
    // $user = 'root';
    // $password='';
    // $dbh = new PDO($dsn, $user, $password);
    // $dbh->query('SET NAMES utf8');

    // // ２．SQL文を実行する
    // $sql = '';
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();

    // // ３．データベースを切断する
    // $dbh = null;

    // $time = intval(date('Hi'));
    // if ("0600" <= $time && $time <= "1100") { // 6時～11時の時間帯のとき 
    // echo "おはようございます、ゲストさん";
    // } elseif ("1101" <= $time && $time <= "1759") { // 12時〜20時の時間帯のとき
    // echo "こんにちわ、ゲストさん";
    // } else{ // 18時〜5時59分の時間帯のとき 
    // echo "こんばんは、ゲストさん";
    // }

    // echo '<br>';

     //タイトルと日付の表示 
        $sql = 'SELECT*FROM `diary` WHERE `user_id`=? ORDER BY `created` DESC';
        $data = array($_SESSION['login_member_id']); // ここにはいった数字がWHEREの条件
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data); // objectからarrayに 

          if(!empty($_POST)){
            $sql= 'DELETE FROM `diary` WHERE `diary_id`=?';
            $data2 = array($_POST['diary_id']);
            $stmt2 = $dbh->prepare($sql);
            $stmt2->execute($data2); // objectからarrayに
            header('Location:kadai.php') ;
            exit();
          }


        
        // echo $record['title'];
        //var_dump($record);


       // $sql = 'DELETE FROM `diary` WHERE`diary_id`=?';
       // $data = array();
       // $stmt = $dbh->prepare($sql);
       // $stmt->execute($data2); // ()内に指定した配列とSQL文がリンクする
       // $stmt = $dbh->prepare($sql);//準備
       // $stmt-> execute($data); //()内に指定した配列とSQL文がリンクする

?>

 

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>kadai</title>
    <link href="../css/kadai.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    
  </head>
  <body>
    <div id="header">
      <header>NexSeed Diary</header>
    </div>
    <div class="container">
      <div id="all-box">
        <div id="b-box">
          <div id="history">
            <div id="guest">
              <?php
                  $time = intval(date('Hi'));
                  if ("2100" <= $time && $time <= "0200") { // 日本時間で6時～11時の時間帯のとき 
                  echo "おはようございます、ゲストさん";
                  } elseif ("0201" <=  $time && $time <= "0859") { // 日本時間11時〜17時59分の時間帯のとき
                  echo "こんにちわ、ゲストさん";
                  } else{ // 日本時間 18時〜5時59分の時間帯のとき 
                  echo "こんばんは、ゲストさん";
                  }
              ?>
            </div><hr></hr>
              <div>
                <?php echo
                    date("Y年m月",mktime(
                    0,//時
                    0,//分
                    0,//秒
                    date("m"),
                    date("d"),
                    date("Y")
                    ));
                ?>の日記です
              </div><hr></hr>
              <div> 
                  <?php echo
                      date("Y年m月",mktime(
                      0,//時
                      0,//分
                      0,//秒
                      date("m") -1,
                      date("d"),
                      date("Y")
                      ));
                  ?>の日記です
              </div><hr></hr>
              <div> 
                  <?php echo
                      date("Y年m月",mktime(
                      0,//時
                      0,//分
                      0,//秒
                      date("m")-2,
                      date("d"),
                      date("Y")
                      ));
                  ?>の日記です
              </div><hr></hr>
            </div>
            <div><a type="submit" href="newdiary.php">新規日記追加</a></div>
          </div>
        <!-- <form> -->
        <div id="c-box">
          <?php while($records = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <div class="msg">
              <a href="" ><?php echo $records['title']; ?></a>
              <p class="day"><?php echo $records['created']; ?></p>
              <form method="POST" action="" onsubmit="return submitChk()">
                <input id="submit_button" type="submit" value="削除" style="color: red;">
                <!-- <input type="submit" value="削除"> -->
                <input type="hidden" name="diary_id" value="<?php  echo $records['diary_id']; ?>">
              </form>
              </div>
          <?php endwhile; ?>

          
        </div>
        <!-- </form> -->
       </div>
      </div>
     <div id="footer">
        <footer>Copywrite@kensuke yoshida</footer>    
      </div>

      <script type="text/javascript">

        // * 確認ダイアログの返り値によりフォーム送信
        // */
        function submitChk () {
            /* 確認ダイアログ表示 */
            var flag = confirm ( "本当に削除してもいいですか?\n\n削除されない方はキャンセルボタンを押してください");
            /* send_flg が TRUEなら送信、FALSEなら送信しない */
            return flag;
        }
        </script>
  </body>
  </html>

  <!-- <form method="POST" action="">
    <input type="botton" name= "diary_id" value="削除">
  </form> -->