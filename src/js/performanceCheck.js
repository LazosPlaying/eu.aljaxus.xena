$(document).ready(function() {
    window.countFPS = (function () {
        var lastLoop = (new Date()).getMilliseconds();
        var count = 1;
        var fps = 0;

        return function () {
            var currentLoop = (new Date()).getMilliseconds();
            if (lastLoop > currentLoop) {
                fps = count;
                count = 1;
            } else {
                count += 1;
            }
            lastLoop = currentLoop;
            return fps;
        };
    }());
    let counter = 0;

    var $out = $('#out');
    (function loop() {
        requestAnimationFrame(function () {
            let fpsNow = countFPS();
            if ( fpsNow<=20 ){
                counter ++;
                if (counter >= 5){
                    console.log('FPS WAS LOWER THAN 20 FOR 15 OR MORE CICLES!');
                } else {

                }
                console.log('FPS IS LOW: '+fpsNow);
            } else {
                counter = 0;
            }
            loop();
        });
    }());
});
