var $ = require('jquery');

var $elem = $('[data-chart]'),
    data = $elem.data('graph');

if (typeof $elem !== 'undefined' && typeof data !== 'undefined') {

    var Chart = require('chart.js');
    var Chartjs = Chart.noConflict();

    var ctx = $elem[0].getContext('2d');

    $elem.removeAttr('data-graph');

    var options = {
        scaleLineColor: '#505458',
        scaleFontColor: '#505458',
        responsive: true,
        scaleFontFamily: "'Muli', Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
    };

    var myBarChart = new Chart(ctx).Bar(data, options);
}
