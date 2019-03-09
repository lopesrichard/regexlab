const html = document.querySelector('html');
const body = document.querySelector('body');
const form = document.getElementById('date-regex-form');

const load = document.createElement('div');
load.classList.add('lds-ripple');
load.innerHTML = '<div></div><div></div>';

form.addEventListener('input', function() {
    sendForm(this);
});

function setLoading() {
    html.appendChild(load);
    body.classList.add('loading');
}

function removeLoading() {
    load.remove();
    body.classList.remove('loading');
}

function sendForm(form) {
    cleanErrors();
    let formData = new FormData(form);
    if (receivedAll(formData) && validateRange(formData)) {
        let ajax = new Ajax('https://regex-lab.herokuapp.com/date/creator/api/v1.php');
        ajax.before(function(){
            setLoading();
        }).after(function(){
            removeLoading();
        }).success(function(response) {
            showResult(response);
        }).error(function(response) {
            //console.log(response);
        }).post('json', formData);
    }
}

function showResult(response) {
    if (!response || response.status != 'true') {
        document.getElementById('result').innerHTML = '';
        return false;
    }
    response.regex = response.regex.replace(/</g, "&lt");
    response.regex = response.regex.replace(/>/g, "&gt");
    response.regex = response.regex.replace(/([\(\)])/g, "<span style=\"color: blueviolet;\">$1</span>");
    response.regex = response.regex.replace(/(\|)/g, "<span style=\"color: red;\">$1</span>");
    document.getElementById('result').innerHTML = response.regex;
}

function receivedAll(form) {
    return form.get('separator') && form.get('format') && form.get('from') && form.get('to');
}

function addError(id) {
    document.getElementById(id).classList.add('is-invalid');
}

function removeError(id) {
    document.getElementById(id).classList.remove('is-invalid');
}

function cleanErrors() {
    removeError('from');
    removeError('to');
}

function validateRange(form) {
    let invalid = document.getElementById('invalid-range');
    invalid.textContent = "Invalid Range";

    let from = form.get('from');
    let to = form.get('to');

    if (from > to) {
        addError('from');
        addError('to');
        return false;
    }

    return displayError(invalid, 'from', from) && displayError(invalid, 'to', to);
}

function displayError(errorField, id, value) {
    if (value < 1900 || value > 2900) {
        if (value < 10000) {
            errorField.textContent = `Do you really want a regex for ${value} years?`;
        } else if (value < 1000000000) {
            errorField.textContent = 'Hey stop messing with me =(';
        } else if (value < 10000000000000000000) {
            errorField.textContent = 'OMG You are insane';
        } else if (value < 1000000000000000000000000000000000000){
            errorField.textContent = 'Stooooooooooooop!';
        } else {
            errorField.textContent = 'Dead =X';
        }
        addError(id);
        return false;
    }
    return true;
}

const result = document.getElementById('result');
const copy   = document.getElementById('btn-copy');

//Temporary use of JQuery just for bootstrap tooltip, but I will find soon another alternative
$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    copy.addEventListener('click', function() {
        $clip = new Clipboard(result);
        if ($clip.copy()) {
            $(this).attr('data-original-title', "done :)").tooltip('show');
        }
    });
    
    copy.addEventListener('mouseout', function() {
        $(this).attr('data-original-title', "copy");
    });
});