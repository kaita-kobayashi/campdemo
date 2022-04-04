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
                    <span class="font-semibold">{{ __('analytics.title.gender') }}</span>
                </div>
                <div id="chartdiv" class="pie-chart"></div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const gender = @json($result);
    const genderConst = @json(__('analytics.tableHeader.col.gender'));
    const data = new Array;
    for (let i in genderConst) {
        data.push({
            "category": genderConst[i],
            "value": gender[genderConst[i]],
        })
    }
    am4core.ready(function() {
        let chart = am4core.createFromConfig({
                "type": "PieChart3D",
                "data": data,
                "series": [{
                    "type": "PieSeries3D",
                    "dataFields": {
                        "value": "value",
                        "category": "category"
                    }
                }],
                "radius": "60%",
                "legend": {
                    "type": "Legend",
                    "paddingRight": 100,
                    "position": "right"
                },
            },
            document.getElementById('chartdiv')
        );
    });
</script>