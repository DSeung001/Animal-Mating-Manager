<x-app-layout>
    @push('styles')
        <link href='{{asset('style/fullcalendar-min.css')}}' rel='stylesheet'/>
        <link href='{{asset('style/fullcalendar-custom.css')}}' rel='stylesheet'/>
        <link href='{{asset('style/highchart-custom.css')}}' rel='stylesheet'/>
        <script src='{{asset('js/fullcalendar-min.js')}}'></script>
    @endpush

    <x-slot name="header">
        대시보드
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 max-w-[1280px]">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-[1280px]">
            <p>부화 예상일</p>
            <div id='calendar' class="mb-6"></div>

            <div class="flex">
                <div id="count-chart-container" class="w-1/2">

                </div>
                <div id="type-chart-container" class="w-1/2">

                </div>
            </div>
        </div>
    </div>



        @push('scripts')
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

            <script>
                let events = {!! json_encode($hatchingScheduled) !!};
                let now = '{{now()}}';
                let allReptileChartCategories = {!! json_encode($allReptileChartCategories) !!};
                let allReptileChart = {!! json_encode($allReptileChart) !!};
                let typeChart = {!! json_encode($typeChart) !!};
            </script>

            <script src="{{asset('js/page/dashboard.js')}}"></script>
        @endpush
</x-app-layout>
