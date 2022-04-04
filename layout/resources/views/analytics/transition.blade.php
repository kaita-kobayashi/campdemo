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
                    <span class="font-semibold">{{ __('analytics.title.transition') }}</span>
                </div>
                <div id="chartdiv" style="width:100%; height:500px;"></div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const transition = Object.entries(@json($result));
    const data = new Array;
    for (let i = 0; i < transition.length; i++) {
        data.push({
            "category": transition[i][0],
            "value": transition[i][1],
        })
    }
    am4core.ready(function() {
        let chart = am4core.createFromConfig({
                "type": "XYChart",
                "data": data,
                "xAxes": [{
                    "type": "CategoryAxis",
                    "hidden": true,
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
                "yAxes": [{
                    "type": "ValueAxis",
                    "renderer": {
                        "maxLabelPosition": 0.98
                    },
                    "title": {
                        "type": "Label",
                        "text": "応募件数"
                    },
                }],
                "series": [{
                    "type": "LineSeries",
                    "bullets": {
                        "values": [{
                            "type": "CircleBullet",
                            "tooltipText": "{categoryX}\n{valueY}"
                        }],
                        "template": {
                            "type": "Bullet"
                        }
                    },
                    "dataFields": {
                        "valueY": "value",
                        "categoryX": "category"
                    },
                    "sequencedInterpolation": true,
                    "sequencedInterpolationDelay": 100
                }],
                "visible": false,
                "cursor": {
                    "type": "XYCursor"
                }
            },
            document.getElementById('chartdiv')
        );
    });
</script>