class Ajax {

    constructor(url) {
        this.xhttp = new XMLHttpRequest();
        this.url = url;

        this.onSuccess = function() {};
        this.onError   = function() {};
        this.doBefore  = function() {};
        this.doAfter   = function() {};
    }

    get(responseType) {
        this.prepare('GET', responseType);
        this.xhttp.send();
    }

    post(responseType, data) {
        data = this.mapDataToSend(data);
        this.prepare('POST', responseType);
        this.xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhttp.send(data);
    }

    before(handler) {
        this.doBefore = handler;
        return this;
    }

    after(handler) {
        this.doAfter = handler;
        return this;
    }

    prepare(method, responseType) {
        this.xhttp.responseType = responseType;
        this.doBefore();
        this.xhttp.open(method, this.url, true);
        var self = this;
        this.xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                self.doAfter();
                this.status == 200 ? self.onSuccess(this.response) : self.onError(this.response);
            }
        };
    }

    mapDataToSend(data) {
        var params = '';
        for(var param in data) {
            params += param + '=' + data[param] + '&';
        }
        return params.slice(0, -1);
    }

    success(handler) {
        this.onSuccess = handler;
        return this;
    }

    error(handler) {
        this.onError = handler;
        return this;
    }
}