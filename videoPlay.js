/******************* jQuery ***********************/
$(function () {
    var play = $(".glyphicon-play");
    var pause = $(".glyphicon-pause");
    var full = $(".glyphicon-resize-full");
    var exitFull = $(".glyphicon-resize-small");
    var soundUp = $(".glyphicon-volume-up");
    var soundDown = $(".glyphicon-volume-down");
    var muted = $(".glyphicon-volume-off");
    var soundProgress=$(".sound-progress");



    $(".video-box").mousemove(function () {
        $("#controller").fadeIn(400);
    }).mouseleave(function () {
        $("#controller").fadeOut(400);
    });


    /*点击视频暂停/播放*/
    /*此处右问题，点击视频处仅一次有效*/
    // $("#film,#pauseImg,#playImg").click(function () {
    //     if(pause.show()){ //播放状态
    //         $("#pauseImg").fadeIn(500);
    //         playPause();
    //         pause.hide();
    //         play.show();
    //     }else{ //暂停状态
    //         pause.show();
    //         play.hide();
    //     }
    // });


    /*切换显示图标*/
    play.click(function () {//播放状态
        $(this).hide();
        pause.show();
        // flag=true;
    });
    pause.click(function () {//暂停状态
        $(this).hide();
        play.show();
        // flag=false;
    });

    full.click(function () {
        $(this).hide();
        exitFull.show();
    });
    exitFull.click(function () {
        $(this).hide();
        full.show();
    });

    soundUp.click(function () {
        $(this).hide();
        muted.show();
    });
    soundDown.click(function () {
        $(this).hide();
        muted.show();
    });
    muted.click(function () {
        $(this).hide();
        soundNow.style.width = last;
        last === "100%" ? soundUp.show() : soundDown.show();
    });



    /*显示音乐进度条*/
    $(".sound-group").mouseover(function () {
        soundProgress.stop().show(400);
    }).mouseout(function () {
        soundProgress.stop().hide(400);

    });

    /*点击音量进度条*/
    soundProgress.click(function (event) {
        muted.hide();
        last === "100%" ? soundUp.show() : soundDown.show();
        myVideo.muted = false;
        let soundWidth = event.pageX - this.getBoundingClientRect().left;
        soundWidth = soundWidth < 0 ? 0 : soundWidth;
        soundWidth = soundWidth > this.offsetWidth ? this.offsetWidth : soundWidth;
        let p = soundWidth / this.offsetWidth;
        soundNow.style.width = p.toFixed(2) * 100 + '%';
        last = p.toFixed(2) * 100 + '%';
        myVideo.volume = p;

        $(".show-sound-now").stop().show().text(soundNow.style.width).delay(1000).hide(0);

        if (soundNow.style.width === "0%") {
            soundUp.hide();
            soundDown.hide();
            muted.show();
        } else if (soundNow.style.width === "100%") {
            muted.hide();
            soundDown.hide();
            soundUp.show();
        } else {
            soundUp.hide();
            muted.hide();
            soundDown.show();
        }
    });

    /*点击倍速*/
    $(".rate").click(function () {
        $(".rate-dashboard").show().children("li").click(function(){
            $(this).css("color","#007ffe").siblings().css("color","#eee");
            var t=$(this).text();
            $(".rate").text(t);
            $(this).parent().hide();
        });
    });

});


/******* 视频进度条 ********/
    // const 定义的变量不可以修改，而且必须初始化
const video = document.getElementById('film');
const start = document.querySelector('.start');
const end = document.querySelector('.end');
const progressBar = document.querySelector('.progress-bar');
const now = document.querySelector('.now');

// let 声明的变量只在该花括号内有效（块级作用域），要声明才可用
function conversion(value) {
    let minute = Math.floor(value / 60);
    minute = minute.toString().length === 1 ? ('0' + minute) : minute;
    let second = Math.round(value % 60);
    second = second.toString().length === 1 ? ('0' + second) : second;
    return `${minute}:${second}`
}

video.onloadedmetadata = function () {
    end.innerHTML = conversion(video.duration);
    start.innerHTML = conversion(video.currentTime);
};

progressBar.addEventListener('click', function (event) {
    //getBoundingClientRect();
    // 这个方法返回一个矩形对象，包含四个属性：left、top、right和bottom。分别表示元素各边与页面上边和左边的距离。
    let coordStart = this.getBoundingClientRect().left;
    let coordEnd = event.pageX;
    let p = (coordEnd - coordStart) / this.offsetWidth;
    now.style.width = p.toFixed(3) * 100 + '%';

    video.currentTime = p * video.duration;
    video.play()
});

setInterval(() => {
    start.innerHTML = conversion(video.currentTime);
    now.style.width = video.currentTime / video.duration.toFixed(3) * 100 + '%'
}, 1000)
