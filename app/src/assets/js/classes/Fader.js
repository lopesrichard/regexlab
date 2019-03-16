class Fader {

    constructor(time) {
        this.time = time;
    }

    fadeOut(element) {
        this.fade(element, 100, 0, false);
    }

    fadeIn(element) {
        this.fade(element, 0, 100, true);
    }

    fade(element, start, fin, show) {
        var alpha = start;
        var inc = fin >= start ? 2 : -2;
        this.setDisplay(element, show);
        var timer = (this.time * 1000) / 50;
        var self = this;
        var i = setInterval(
            function() {
                if ((inc > 0 && alpha >= fin) || (inc < 0 && alpha <= fin)) {
                    clearInterval(i);
                }
                self.setAlpha(element, alpha);
                alpha += inc;
            }, timer);
        this.setDisplay(element, show);
    }

    setAlpha(targ, alpha) {
        targ.style.filter = "alpha(opacity="+ alpha +")";
        targ.style.opacity = alpha/100;
    }

    setDisplay(element, show) {
        if (show) {
            element.classList.remove('d-none');
        } else {
            setTimeout(function() {
                element.classList.add('d-none');
            }, this.time * 1000);
        }
    }
}