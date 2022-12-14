<x-app-layout>
    @push('styles')
        <link href='{{asset('style/fullcalendar-min.css')}}' rel='stylesheet'/>
        <link href='{{asset('style/fullcalendar-custom.css')}}' rel='stylesheet'/>
        <script src='{{asset('js/fullcalendar-min.js')}}'></script>
    @endpush

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 max-w-[1280px]">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-[1280px]">
            <p class="">
                부화 예상일
            </p>
            <div id='calendar'>

            </div>
        </div>
    </div>

        @push('scripts')
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
            </script>
        @endpush
</x-app-layout>
