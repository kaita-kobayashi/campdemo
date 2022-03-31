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
                        <th>商品A</th>
                        <th>商品B</th>
                        <th>商品C</th>
                        <th>商品D</th>
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryProduct') }}</th>
                        <td>12個</td>
                        <td>13個</td>
                        <td>14個</td>
                        <td>15個</td>
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        <th>{{ __('analytics.tableHeader.col.male') }}</th>
                        <th>{{ __('analytics.tableHeader.col.female') }}</th>
                        <th>{{ __('analytics.tableHeader.col.nonBinary') }}</th>
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryGender') }}</th>
                        <td>{{ 9827 }}人</td>
                        <td>{{ 8723 }}人</td>
                        <td>{{ 444 }}人</td>
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        <th>{{ __('analytics.tableHeader.col.10') }}</th>
                        <th>{{ __('analytics.tableHeader.col.20') }}</th>
                        <th>{{ __('analytics.tableHeader.col.30') }}</th>
                        <th>{{ __('analytics.tableHeader.col.40') }}</th>
                        <th>{{ __('analytics.tableHeader.col.50') }}</th>
                        <th>{{ __('analytics.tableHeader.col.60') }}</th>
                        <th>{{ __('analytics.tableHeader.col.overAge') }}</th>
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryAge') }}</th>
                        <td>{{ 9827 }}人</td>
                        <td>{{ 8723 }}人</td>
                        <td>{{ 444 }}人</td>
                        <td>{{ 444 }}人</td>
                        <td>{{ 444 }}人</td>
                        <td>{{ 444 }}人</td>
                        <td>{{ 444 }}人</td>
                    </tr>
                </table>
                <table class="text-left table-auto mt-5 analytics-summay-table">
                    <tr>
                        <th></th>
                        <th>{{ __('analytics.tableHeader.col.1th') }}</th>
                        <th>{{ __('analytics.tableHeader.col.2th') }}</th>
                        <th>{{ __('analytics.tableHeader.col.3th') }}</th>
                        <th>{{ __('analytics.tableHeader.col.4th') }}</th>
                        <th>{{ __('analytics.tableHeader.col.5th') }}</th>
                    </tr>
                    <tr>
                        <th>{{ __('analytics.tableHeader.row.entryEria') }}</th>
                        <td>東京都(234件)</td>
                        <td>神奈川県(84件)</td>
                        <td>秋田県(74件)</td>
                        <td>埼玉県(64件)</td>
                        <td>沖縄県(34件)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

