@echo off

echo --------------------------------------------------------
echo �H���T�C�l�[�W
echo �@�@�X�^���h�A�����p�v���C���X�g�_�E�����[�h�v���O����
echo �@�@������ЃA�X�R���@�@�@�@�@�@�@�@�@�@�@�@2012.03.28
echo --------------------------------------------------------
echo;

:: �c�[���փp�X��ʂ�
PATH=.\bin;%SystemRoot%\system32;%SystemRoot%;%SystemRoot%\System32\Wbem;

call settings.bat

echo ���R���e���c���폜���܂�
del /Q .\SD\image\*
del /Q .\SD\down\*
del /Q .\SD\xml\*
echo;

echo �v���C���X�g���_�E�����[�h���܂�
<?php if(DIGEST_AUTH_ENABLED === true): ?>
wget -O ch.xml -t 3 --http-user=<?php echo DIGEST_AUTH_USER ?> --http-passwd=<?php echo DIGEST_AUTH_PASSWD ?> --no-check-certificate <?php echo $url ?>
<?php else: ?>
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>
<?php endif ?>

type ch.xml | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo �_�E�����[�h����R���e���c�̃��X�g���쐬���܂�
findstr url1 .\SD\xml\ch.xml > list_tmp.txt
cscript.exe .\bin\replace.vbs
cscript.exe .\bin\createMoviePngList.vbs
echo;

echo �R���e���c���_�E�����[�h���܂�
<?php if(DIGEST_AUTH_ENABLED === true): ?>
wget -t 3 --http-user=<?php echo DIGEST_AUTH_USER ?> --http-passwd=<?php echo DIGEST_AUTH_PASSWD ?> --no-check-certificate -nc -i list.txt
<?php else: ?>
wget -t 3 --no-check-certificate -nc -i list.txt
<?php endif ?>

echo;

echo �R���e���c������̃t�H���_�Ɉړ����܂�
echo ����Î~�捬�ݗp�@�摜�t�@�C��-----
call moviepng_list.bat
echo �摜�t�@�C��-----
move *.png .\SD\image\
echo ����t�@�C��-----
move *.avi .\SD\down\
move *.mp4 .\SD\down\
move *.mov .\SD\down\
move *.wmv .\SD\down\
move *.aac .\SD\down\
move *.mp3 .\SD\down\
move *.swf .\SD\down\
echo;

:: �ꎞ�t�@�C�����폜
del /Q list.txt
del /Q list_tmp.txt
del /Q ch.xml
del /Q moviepng_list.bat

echo --------------------------------------------------------
echo SD�t�H���_�ȉ��ɉ��L�̂悤�ɔz�u���܂����B
echo; 
tree /F SD
echo;

echo --------------------------------------------------------
echo �����I�����܂����B
echo �R���e���c���������_�E�����[�h�ł��Ă��邩�m�F�̏�
echo �X�^���h�A�����pSD�J�[�h�ɃR�s�[���Ă��������B

pause

@echo on
