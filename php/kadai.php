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
    var_dump
 

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
                    if ("2100" <= $time && $time <= "0200") { // 日本時間で6時～11時の時間帯のとき 
                    echo "おはようございます、ゲストさん";
                    } elseif ("0201" <= $time && $time <= "0859") { // 日本時間11時〜17時59分の時間帯のとき
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
                    ?>の日記です</div><hr></hr>
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
                    ?>の日記です</div><hr></hr>
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