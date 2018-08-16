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
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>

type ch.xml | sed -e "s/<staDt>.*<\/staDt>/<staDt>2000-01-01 00:00:00<\/staDt>/" | sed -e "s/<endDt>.*<\/endDt>/<endDt>2038-01-01 00:00:00<\/endDt>/" | sed -e "s/\r\n/\n/" | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo ダウンロードするコンテンツのリストを作成します
findstr url1 .\SD\xml\ch.xml | sed -e "s/\s*<url1>//" | sed -e "s/<\/url1>//" > list.txt
echo;

echo コンテンツをダウンロードします
wget -t 3 --no-check-certificate -nc -i list.txt
echo;

echo コンテンツを所定のフォルダに移動します
echo 画像ファイル-----
move *.png .\SD\image\
echo 動画ファイル-----
move *.avi .\SD\down\
echo;

:: 一時ファイルを削除
del /Q list.txt
del /Q ch.xml

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
=======
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
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>

type ch.xml | sed -e "s/<staDt>.*<\/staDt>/<staDt>2000-01-01 00:00:00<\/staDt>/" | sed -e "s/<endDt>.*<\/endDt>/<endDt>2038-01-01 00:00:00<\/endDt>/" | sed -e "s/\r\n/\n/" | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo ダウンロードするコンテンツのリストを作成します
findstr url1 .\SD\xml\ch.xml | sed -e "s/\s*<url1>//" | sed -e "s/<\/url1>//" > list.txt
echo;

echo コンテンツをダウンロードします
wget -t 3 --no-check-certificate -nc -i list.txt
echo;

echo コンテンツを所定のフォルダに移動します
echo 画像ファイル-----
move *.png .\SD\image\
echo 動画ファイル-----
move *.avi .\SD\down\
echo;

:: 一時ファイルを削除
del /Q list.txt
del /Q ch.xml

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
