<x-app-layout>
    @push('styles')
        <link href='{{asset('style/fullcalendar-min.css')}}' rel='stylesheet'/>
        <link href='{{asset('style/fullcalendar-custom.css')}}' rel='stylesheet'/>
        <link href='{{asset('style/highchart-custom.css')}}' rel='stylesheet'/>
        <script src='{{asset('js/fullcalendar-min.js')}}'></script>
    @endpush

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 max-w-[1280px]">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-[1280px]">
            <p>부화 예상일</p>
            <div id='calendar' class="mb-6"></div>

            <figure class="highcharts-figure ">
                <div id="container"></div>
            </figure>
        </div>
    </div>

        @push('scripts')
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script>
                let events = {!! json_encode($eggs) !!};

                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialDate: '{{now()}}',
                        editable: false,
                        selectable: false,
                        businessHours: true,
                        dayMaxEvents: true,
                        displayEventTime : false,
                        events: events,
                        titleFormat: function (date) {
                            year = date.date.year;
                            month = date.date.month + 1;
                            return year + "년 " + month + "월";
                        },
                        height:600
                    });
                    calendar.render();
                });


                Highcharts.chart('container', {
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
                        categories: {!! json_encode($graphCategories) !!}
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
                        data: {!! json_encode($allReptileList) !!}
                    },{
                        name: '수컷 개체',
                        data: {!! json_encode($maleReptileList) !!}
                    },{
                        name: '암컷 개체',
                        data: {!! json_encode($femaleReptileList) !!}
                    },{
                        name: '미구분 개체',
                        data: {!! json_encode($undefinedReptileList) !!}
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
            </script>
        @endpush
</x-app-layout>
