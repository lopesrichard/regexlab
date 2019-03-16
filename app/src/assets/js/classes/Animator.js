class Animator {

    constructor(element, time) {
        this.element = element;
        this.time = time;
    }

    zoom(scale) {
        this.element.style.transition = this.time / 1000 + 's';
        this.element.style.transform = `scale(${scale})`;
        var self = this;
        setTimeout(function() {
            self.element.style.transform = 'scale(1.0)';
        }, this.time);
    }

    zoomIn(scale) {
        this.element.style.transition = this.time / 1000 + 's';
        this.element.style.transform = `scale(${scale})`;
    }

    zoomOut() {
        this.element.style.transition = this.time / 1000 + 's';
        this.element.style.transform = `scale(1.0)`;
    }
}