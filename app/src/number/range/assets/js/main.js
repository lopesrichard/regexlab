const from   = document.getElementById('from');
const to     = document.getElementById('to');
const result = document.getElementById('result');
const copy   = document.getElementById('btn-copy');


[from, to].forEach(input => {
    ['keyup', 'blur'].forEach(event => {
        input.addEventListener(event, function() {
            setResult();
        });
    });
});

function setResult() {
    if (from.value.length <= 0 || to.value.length <= 0)
        return false;

    if (parseInt(from.value) > parseInt(to.value))
        return false;

    const ajax = new Ajax(`https://regex-lab.herokuapp.com/number/range/api/v1.php/${from.value}/${to.value}`);
    ajax.success(function(response) {
        if (!response || response.status != 'true') {
            document.getElementById('result').innerHTML = '';
            return false;
        }
        response.regex = response.regex.replace(/([\(\)])/g, "<span style=\"color: blueviolet;\">$1</span>");
        response.regex = response.regex.replace(/(\|)/g, "<span style=\"color: red;\">$1</span>");
        document.getElementById('result').innerHTML = response.regex;
    }).get('json');
}

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