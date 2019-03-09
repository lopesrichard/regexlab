class Clipboard {

    constructor(element) {
        this.element = element;
    }

    copy() {
        var range, selection;
        if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(this.element);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();        
            range = document.createRange();
            range.selectNodeContents(this.element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
        
        try {
            document.execCommand('copy');
            return true;
        }
        catch (err) {
          return false;
        }
    }
}