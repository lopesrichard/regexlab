const tableMain       = document.getElementById('table-main');
const tableGreedy     = document.getElementById('table-greedy');
const tableReluctant  = document.getElementById('table-reluctant');
const tablePossessive = document.getElementById('table-possessive');
const tableMethods    = document.getElementById('table-methods');

const tables  = [tableMethods, tableMain, tableGreedy, tableReluctant, tablePossessive];
tables.forEach(table => {
    const animator = new Animator(table, 500);
    const evt      = new EventManager(table);
    evt.hover(() => animator.zoomIn(1.2), () => animator.zoomOut(1.2));
});

const options = {
    php: {
        show: 'PHP (PCRE)',
        main: ['\\', '^', '$', '.', '[ ]', '[^]', '\\b', '|', '( )', '\\1'],
        greedy: ['?', '*', '+', '{x, y}', '{x, }', '{, y}'],
        reluctant: ['??', '*?', '+?', '{x, y}?', '{x, }?', '{, y}?'],
        possessive: ['?+', '*+', '++', '{x, y}+', '{x, }+', '{, y}+'],
        methods: ['preg_match | preg_match_all', 'preg_replace', 'preg_split', '\'\' (inside simple quotes)', 'By Default'],
    },
    java: {
        show: 'Java',
        main: ['\\\\', '^', '$', '.', '[ ]', '[^]', '\\\\b', '|', '( )', '\\\\1'],
        greedy: ['?', '*', '+', '{x, y}', '{x, }', '{, y}'],
        reluctant: ['??', '*?', '+?', '{x, y}?', '{x, }?', '{, y}?'],
        possessive: ['?+', '*+', '++', '{x, y}+', '{x, }+', '{, y}+'],
        methods: ['Matcher.matches | Matcher.find', 'Matcher.replaceFirst | Matcher.replaceAll', 'Pattern.split', 'Doesn\'t have'],
    },
};

const slider       = document.getElementById('range-slider');
const input        = slider.querySelector('input');
const span         = slider.querySelector('span');
const spanAnimator = new Animator(span, 300);

changeName();
changeTable();

slider.addEventListener('input', function() {
    spanAnimator.zoom(1.2);
    changeName();
    changeTable();
});

function changeName() {
    span.textContent = Object.values(options)[input.value - 1].show;
}

function changeTable() {
    changeContentTable(tableMethods, 'methods');
    changeContentTable(tableMain, 'main');
    changeContentTable(tableGreedy, 'greedy');
    changeContentTable(tableReluctant, 'reluctant');
    changeContentTable(tablePossessive, 'possessive');
}

function changeContentTable(table, propertyName) {
    fader = new Fader(0.5);
    table.style = '';
    fader.fade(table, 0, 100, true);
    table.querySelectorAll('td').forEach(function(td, i) {
        td.textContent = Object.values(options)[input.value - 1][propertyName][i];
    });
}