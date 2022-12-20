document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialDate: now,
        editable: false,
        selectable: false,
        businessHours: true,
        dayMaxEvents: true,
        displayEventTime: false,
        events: events,
        titleFormat: function (date) {
            year = date.date.year;
            month = date.date.month + 1;
            return year + "년 " + month + "월";
        },
        height: 600
    });
    calendar.render();
});

Highcharts.chart('count-chart-container', {
    title: {
        text: '현재 개체수 그래프',
        align: 'left'
    },
    yAxis: {
        title: {
            text: '개체수'
        }
    },

    xAxis: {
        categories: allReptileChartCategories
    },

    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: '모든 개체',
        data: allReptileChart
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }
});


Highcharts.chart('type-chart-container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '종류 분포도'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: typeChart
    }]
});
