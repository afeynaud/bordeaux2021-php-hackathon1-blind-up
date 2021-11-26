const Player = document.getElementById('video-player');
const PlayBtn = document.getElementById('play');
const stopBtn = document.getElementById('stop');
let times = 0, playY;
const playVideo = PlayBtn.addEventListener( 'click' , () => {
    if(times == 0){
        playY = Player.src += '?autoplay=1';
        times = 1;
    }
});

stopBtn.addEventListener( 'click' , () => {
    playY = playY.slice(0, -11);
    Player.src = playY
    times = 0;
});