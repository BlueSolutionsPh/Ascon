@echo off

echo --------------------------------------------------------
echo 食堂サイネージ
echo 　　スタンドアロン用プレイリストダウンロードプログラム
echo 　　株式会社アスコン　　　　　　　　　　　　2012.03.28
echo --------------------------------------------------------
echo;

:: ツールへパスを通す
PATH=.\bin;%SystemRoot%\system32;%SystemRoot%;%SystemRoot%\System32\Wbem;

call settings.bat

echo 旧コンテンツを削除します
del /Q .\SD\image\*
del /Q .\SD\down\*
del /Q .\SD\xml\*
echo;

echo プレイリストをダウンロードします
<?php if(DIGEST_AUTH_ENABLED === true): ?>
wget -O ch.xml -t 3 --http-user=<?php echo DIGEST_AUTH_USER ?> --http-passwd=<?php echo DIGEST_AUTH_PASSWD ?> --no-check-certificate <?php echo $url ?>
<?php else: ?>
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>
<?php endif ?>

type ch.xml | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo ダウンロードするコンテンツのリストを作成します
findstr url1 .\SD\xml\ch.xml > list_tmp.txt
cscript.exe .\bin\replace.vbs
cscript.exe .\bin\createMoviePngList.vbs
echo;

echo コンテンツをダウンロードします
<?php if(DIGEST_AUTH_ENABLED === true): ?>
wget -t 3 --http-user=<?php echo DIGEST_AUTH_USER ?> --http-passwd=<?php echo DIGEST_AUTH_PASSWD ?> --no-check-certificate -nc -i list.txt
<?php else: ?>
wget -t 3 --no-check-certificate -nc -i list.txt
<?php endif ?>

echo;

echo コンテンツを所定のフォルダに移動します
echo 動画静止画混在用　画像ファイル-----
call moviepng_list.bat
echo 画像ファイル-----
move *.png .\SD\image\
echo 動画ファイル-----
move *.avi .\SD\down\
move *.mp4 .\SD\down\
move *.mov .\SD\down\
move *.wmv .\SD\down\
move *.aac .\SD\down\
move *.mp3 .\SD\down\
move *.swf .\SD\down\
echo;

:: 一時ファイルを削除
del /Q list.txt
del /Q list_tmp.txt
del /Q ch.xml
del /Q moviepng_list.bat

echo --------------------------------------------------------
echo SDフォルダ以下に下記のように配置しました。
echo; 
tree /F SD
echo;

echo --------------------------------------------------------
echo 処理終了しました。
echo コンテンツが正しくダウンロードできているか確認の上
echo スタンドアロン用SDカードにコピーしてください。

pause

@echo on
