(function() {

    /* return a int random num */
    function getRandomNum(min, max) {
        var range = max - min;
        var rand = Math.random();
        return(min + Math.round(rand * range));
    }
    
    function themeurl(){
        var i=0,got=-1,url,len=document.getElementsByTagName('link').length;
        while(i<=len && got==-1){
            url=document.getElementsByTagName('link')[i].href;
            got=url.indexOf('/style.css');
            i++;
            }
        return url.replace(/style(.*)/,'');//替换掉 url 中的 style.css 等字符
    }
    /* cat class */
    function Cat() {

        /* reset position xy and speed */
        this.reset = function() {
            this.img.width = getRandomNum(100, 200);
            this.x = -this.img.width;
            this.y = getRandomNum(0, window.innerHeight - 100);
            this.img.style.left = this.x + 'px';
            this.img.style.top = this.y + 'px';
            this.speed = getRandomNum(1, 5);
        };

        this.img = document.createElement('img');
        this.img.src = themeurl()+'extend/img/nyancat.gif';
        this.img.style.position = 'fixed';
        this.wait = true; /* ture is not display */
        document.body.appendChild(this.img);
        this.reset();

        /* this should call in loop update callback */
        this.update = function(dt) {
            if (this.wait) {
                if (getRandomNum(0, 180) === 0) { /* about 3 seconds */
                    this.wait = false;
                    this.reset();
                }
            } else {
                this.x += this.speed;
                this.img.style.left = this.x + 'px';
                if (this.x > window.innerWidth + this.img.width) {
                    this.wait = true;
                }
            }
        };

    }

    /* cat array used to manage */
    var cats = [];

    /* load callback */
    function load() {
        /* init cats */
        for (var n = 0; n < 20; n++) {
            cats[n] = new Cat();
        }
        /* play bgm */
        var bgm = document.createElement('audio');
        bgm.autoplay = true;
        bgm.loop = true;
        var src1 = document.createElement('source');
        src1.src = themeurl()+'extend/bgm/nyancat.mp3';
        src1.type = 'audio/mpeg';
        bgm.appendChild(src1);
        var src2 = document.createElement('source');
        src2.src = themeurl()+'extend/bgm/nyancat.ogg';
        src2.type = 'audio/ogg';
        bgm.appendChild(src2);
        document.body.appendChild(bgm);
    }

    /* update callback */
    function update(dt) {
        cats.forEach(function (cat) {
            cat.update(dt);
        });
    }

    /* start loop engine */
    function start() {
        /* make a fps loop frame */
        var fps = 60;
        var lastTime = new Date().getTime();
        var loop = function() {
            var nowTime = new Date().getTime();
            var deltaTime = nowTime - lastTime;
            if (deltaTime - 1000 / fps >= 0) {
                lastTime = nowTime;
                update(deltaTime / 1000);
            }
        };
        /* load callback */
        load();
        /* start loop as soon as possible */
        window.setInterval(loop, 1);
    }
    start();

})();
