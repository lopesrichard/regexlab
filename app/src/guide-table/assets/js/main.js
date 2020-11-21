const tableMain = document.getElementById('table-main');
const tableGreedy = document.getElementById('table-greedy');
const tableReluctant = document.getElementById('table-reluctant');
const tablePossessive = document.getElementById('table-possessive');
const tableMethods = document.getElementById('table-methods');
const tableExamples = document.getElementById('table-examples');

const ajax = new Ajax('api/v1.php');
ajax
  .success(function (response) {
    changeName(response);
    changeTable(response);
    slider.addEventListener('input', function () {
      spanAnimator.zoom(1.2);
      changeName(response);
      changeTable(response);
    });
  })
  .get('json');

const slider = document.getElementById('range-slider');
const input = slider.querySelector('input');
const span = slider.querySelector('span');
const spanAnimator = new Animator(span, 300);

function changeName(options) {
  span.textContent = Object.values(options)[input.value - 1].show;
}

function changeTable(options) {
  changeContentTable(options, tableMethods, 'methods');
  changeContentTable(options, tableExamples, 'examples');
  changeContentTable(options, tableMain, 'main');
  changeContentTable(options, tableGreedy, 'greedy');
  changeContentTable(options, tableReluctant, 'reluctant');
  changeContentTable(options, tablePossessive, 'possessive');
  highlightCode();
}

function changeContentTable(options, table, propertyName) {
  fader = new Fader(0.5);
  table.style = '';
  fader.fade(table, 0, 100, true);
  table.querySelectorAll('td').forEach(function (td, i) {
    td.innerHTML = Object.values(options)[input.value - 1][propertyName][i];
  });
}

setTimeout(function () {
  highlightCode();
}, 100);

function highlightCode() {
  document.querySelectorAll('code').forEach((block) => {
    block.parentNode.parentNode.classList.add('code');
    hljs.highlightBlock(block);
  });
}
