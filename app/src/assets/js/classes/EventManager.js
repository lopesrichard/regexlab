class EventManager {

    constructor(element) {
        this.element = element;
    }

    hover(onMouseEnter, onMouseLeave) {
        this.element.addEventListener('mouseenter', function() {
            onMouseEnter();
        });
    
        this.element.addEventListener('mouseleave', function() {
            onMouseLeave();
        });
    }
}