$( document ).ready(function() {
    checkSingin();
    //getCanvasData();
    //startTimer();
});

var timer;

function startTimer()
{
    timer = setInterval(myGreeting, 5000);
}

function myGreeting()
{
    checkSingin();
}

function checkSingin()
{
    $.get('./check.php', function(data){
        if(data == 200){
            goChat();
        }else{
            getCanvasData();
        }        
    });
}

function getCanvasData(){
    $.get('./auth.php', function(dataURL){
        drawQRCode(dataURL);
    });
}

function drawQRCode(dataURL)
{    
    var canvas = document.getElementById("qrCode");
    var ctx = canvas.getContext('2d');
    var img = new Image;
    img.onload = function(){
        ctx.drawImage(img,0,0);
    };
    img.src = dataURL;

    $('.qrBack').show();
}

function goChat()
{
    location.href = "../chat";
}