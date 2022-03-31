<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('analytics.title.analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 mt-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <span class="font-semibold">{{ __('analytics.title.summary') }}</span>
                </div>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryNum') }}</th>
                        <td>{{ $result['entryNum'] }}件</td>
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        @foreach ($result['purchaseProducts'] as $name => $quentity)
                            <th>{{ $name }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryProduct') }}</th>
                        @foreach ($result['purchaseProducts'] as $name => $quentity)
                            <td>{{ $quentity }}個</td>
                        @endforeach
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        @foreach (__('analytics.tableHeader.col.gender') as $key => $gender)
                            <th>{{ $gender }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryGender') }}</th>
                        @foreach (__('analytics.tableHeader.col.gender') as $key => $gender)
                            <td>{{ $result['genderCount'][$gender] }}人</td>
                        @endforeach
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        @foreach (__('analytics.tableHeader.col.age') as $key => $age)
                            <th>{{ $age }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryAge') }}</th>
                        @foreach ($result['ageCount'] as $ages)
                            <td>{{ $ages['ageCount'] }}人</td>
                        @endforeach
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        @foreach (__('analytics.tableHeader.col.eria') as $key => $eria)
                            <th>{{ $eria }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryEria') }}</th>
                        @foreach ($result['prefectureCount'] as $prefectures)
                            <td>{{ $prefectures['prefecture'] . '(' . $prefectures['prefectureCount'] . '件)' }}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

