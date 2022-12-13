<x-app-layout>
    @push('styles')
        <link href='{{asset('style/fullcalendar-min.css')}}' rel='stylesheet'/>
        <script src='{{asset('js/fullcalendar-min.js')}}'></script>

        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialDate: '2020-09-12',
                    editable: true,
                    selectable: true,
                    businessHours: true,
                    dayMaxEvents: true, // allow "more" link when too many events
                    events: [
                        {
                            title: 'Test',
                            url: 'http://google.com/',
                            start: '2020-09-22'
                        },
                        {
                            title: 'Test',
                            url: 'http://google.com/',
                            start: '2020-09-28'
                        },
                        {
                            title: 'Test',
                            url: 'http://google.com/',
                            start: '2020-09-28'
                        }
                    ]
                });

                calendar.render();
            });

        </script>
        <style>

            body {
                margin: 40px 10px;
                padding: 0;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                font-size: 14px;
            }

            #calendar {
                max-width: 1100px;
                margin: 0 auto;
            }

        </style>
        </head>
    @endpush

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
        <div id='calendar' class="bg-white overflow-hidden shadow-xl sm:rounded-lg"></div>
    </div>
</x-app-layout>
