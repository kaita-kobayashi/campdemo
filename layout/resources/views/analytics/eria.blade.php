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
                    <span class="font-semibold">{{ __('analytics.title.eria') }}</span>
                </div>
                <div id="chartdiv" class="xy-chart"></div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const eria = Object.entries(@json($result));
    const data = new Array;
    for (let i = 0; i < eria.length; i++) {
        data.push({
            "category": eria[i][0],
            "value": eria[i][1],
        })
    }
    data.reverse();
    am4core.ready(function() {
        let chart = am4core.createFromConfig({
                "type": "XYChart3D",
                "data": data,
                "xAxes": [{
                    "type": "ValueAxis",
                    "renderer": {
                        "maxLabelPosition": 0.98
                    }
                }],
                "yAxes": [{
                    "type": "CategoryAxis",
                    "dataFields": {
                        "category": "category"
                    },
                    "renderer": {
                        "grid": {
                            "template": {
                                "type": "Grid",
                                "location": 0
                            }
                        },
                        "minGridDistance": 20
                    }
                }],
                "series": [{
                    "type": "ColumnSeries3D",
                    "columns": {
                        "template": {
                            "type": "Column3D",
                            "strokeOpacity": 0,
                            "tooltipText": "{categoryY}\n{valueX}",
                            "tooltipPosition": "pointer"
                        }
                    },
                    "dataFields": {
                        "valueX": "value",
                        "categoryY": "category"
                    },
                    "sequencedInterpolation": true,
                    "sequencedInterpolationDelay": 100
                }],
            },
            document.getElementById('chartdiv')
        );
    });
</script>