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
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>

type ch.xml | sed -e "s/<staDt>.*<\/staDt>/<staDt>2000-01-01 00:00:00<\/staDt>/" | sed -e "s/<endDt>.*<\/endDt>/<endDt>2038-01-01 00:00:00<\/endDt>/" | sed -e "s/\r\n/\n/" | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo �_�E�����[�h����R���e���c�̃��X�g���쐬���܂�
findstr url1 .\SD\xml\ch.xml | sed -e "s/\s*<url1>//" | sed -e "s/<\/url1>//" > list.txt
echo;

echo �R���e���c���_�E�����[�h���܂�
wget -t 3 --no-check-certificate -nc -i list.txt
echo;

echo �R���e���c������̃t�H���_�Ɉړ����܂�
echo �摜�t�@�C��-----
move *.png .\SD\image\
echo ����t�@�C��-----
move *.avi .\SD\down\
echo;

:: �ꎞ�t�@�C�����폜
del /Q list.txt
del /Q ch.xml

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
=======
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
wget -O ch.xml -t 3 --no-check-certificate <?php echo $url ?>

type ch.xml | sed -e "s/<staDt>.*<\/staDt>/<staDt>2000-01-01 00:00:00<\/staDt>/" | sed -e "s/<endDt>.*<\/endDt>/<endDt>2038-01-01 00:00:00<\/endDt>/" | sed -e "s/\r\n/\n/" | tr -d "\r" > .\SD\xml\ch.xml
echo;

echo �_�E�����[�h����R���e���c�̃��X�g���쐬���܂�
findstr url1 .\SD\xml\ch.xml | sed -e "s/\s*<url1>//" | sed -e "s/<\/url1>//" > list.txt
echo;

echo �R���e���c���_�E�����[�h���܂�
wget -t 3 --no-check-certificate -nc -i list.txt
echo;

echo �R���e���c������̃t�H���_�Ɉړ����܂�
echo �摜�t�@�C��-----
move *.png .\SD\image\
echo ����t�@�C��-----
move *.avi .\SD\down\
echo;

:: �ꎞ�t�@�C�����폜
del /Q list.txt
del /Q ch.xml

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
