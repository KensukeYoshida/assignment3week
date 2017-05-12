 <?php 
if (date("Hi") >= "0600" && date("Hi") <= "1100") : 
?>
  <!-- 06:00～11:00 に表示させたい文字列-->
  おはようございます、ゲストさん
 
<?php elseif (date("Hi") >= "1101" && date("Hi") <= "1759") : ?>
  <!--21:00～03:59 に表示させたい文字列-->
  こんにちは、ゲストさん
  <?php echo "こんにちは、ゲストさん"; ?>

  <?php elseif (date("Hi") >= "1800" && date("Hi") <= "0559") : ?>
  <!--21:00～03:59 に表示させたい文字列-->
  <?php echo "文字列"; ?>
 
<?php else : ?>
  <!--上記時間以外に表示させたい文字列-->
  <?php echo "文字列"; ?>
 
<?php endif; ?>
  <?php echo "文字列"; ?>
 

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
        <div class="row">
            <div class="col-md-4 content-margin-top box">
              <div>
                <?php
                    $time = intval(date('Hi'));
                    if ("0600" <= $time && $time <= "1100") { // 6時～11時の時間帯のとき 
                    echo "おはようございます、ゲストさん";
                    } elseif ("1101" <= $time && $time <= "1759") { // 12時〜20時の時間帯のとき
                    echo "こんにちわ、ゲストさん";
                    } else{ // 18時〜5時59分の時間帯のとき 
                    echo "こんばんは、ゲストさん";
                    }
                    ?>
                </div><hr></hr>
                <div>2016年10月の日記</div><hr></hr>
                <div>2016年9月の日記</div><hr></hr>
                <div>2016年8月の日記</div><hr></hr>
            </div>
          <div class="col-md-8 content-margin-top2 box">
            <div class="msg">
            <a href="" >こんにちは</a>
            <p class="day">2016年10月10日</p>
            </div>
            <div class="msg">
            こんにちは <br>
            <p class="day">2016年10月10日</p>
            </div>
            <div class="msg">
            こんにちは
            <p class="day">2016年10月10日</p>
            </div>
            <div class="msg">
            こんにちは
            <p class="day">2016年10月10日</p>
            </div>
            <div class="msg">
            こんにちは
            <p class="day">2016年10月10日</p>
            </div>
            <div class="msg">
            こんにちは
            <p class="day">2016年10月10日</p>
            </div>
          </div>
        </div>
    </div>

      <div id="footer">
        <footer>Copywrite@kensuke yoshida</footer>
      </div>
    </div>  
  </body>
  </html>