const html = document.querySelector('html');
const body = document.querySelector('body');

const fonts  = {
    flower: 'Indie Flower', courier: 'Courier', roboto: 'Roboto', slabo: 'Slabo',
    times: 'Times New Roman', ubuntu: 'Ubuntu',
};
const select = document.getElementById('fonts');
select.innerHTML = setOptions();

function setOptions() {
    let options = '';
    for (let font in fonts) {
        options += `<option value="${font}">${fonts[font]}</option>`;
    }
    return options;
}

select.addEventListener('input', function() {
    for (let font in fonts) {
        body.classList.remove(font);
    }
    body.classList.add(select.value);
});