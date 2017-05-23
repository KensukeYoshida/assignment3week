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
        $sql = 'SELECT*FROM `diary` WHERE `user_id`=?';
        $data = array($_SESSION['login_member_id']); // ここにはいった数字がWHEREの条件
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data); // objectからarrayに
        
        // echo $record['title'];
        //var_dump($record);

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
        <div id="c-box">
          <?php while($records = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <div class="msg">
              <a href="" ><?php echo $records['title']; ?></a>
              <p class="day"><?php echo $records['created']; ?></p>
              </div>
          <?php endwhile; ?>
        </div>
       </div>
      </div>
     <div id="footer">
        <footer>Copywrite@kensuke yoshida</footer>    
      </div>
  </body>
  </html>