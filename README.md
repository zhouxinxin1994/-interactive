本项目初期是从https://github.com/xinzizi77/--Interactive_video_platform 项目二次开发而来的。初期所在公司需要制作有互动效果的课件，国内其它网站制作这种互动视频有相应的门槛，所以自己在工作之外开发了这个平台，希望这个项目能够继续下去。

数据库的设置文件在config.php里；

demo的地址是http://http://www.zjxcode.tk/

测试的账号和密码

账号：test  密码：123456。

本程序在windows下制作，用的是WAMP，所以如果用WAMP的话基本上把文件放入WWW再稍作配置就可以用了。

windows下的配置信息

1.windows环境下的安装环境WAMP PHP7.2  apche 2.4  mysql5.7.

2.php.ini中的配置   

upload_max=150M     

post_max=1500M.

3.ffmpeg 环境变量配置 Composer安装   命令 composer require php-ffmpeg/php-ffmpeg。

也可以直接安装用cmd来执行ffmpeg，本demo使用的是cmd方式来执行ffmpeg，因为ffmpeg较大，

所以请大家去ffmpeg官网下载ffmpeg.exe,ffplay.exe,ffprobe.exe和文件。

linux下的配置信息

安装相对应版本的lamp， PHP7.2  apche 2.4  mysql5.7，这个过程就就不叙述了。

里面还有些bug，如果有需求，会继续维护。

作者联系方式 email: 1191285552@qq.com





