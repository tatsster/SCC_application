<div id="temperature-label" hidden>@lang("Real-time Temperature")</div>
<div id="temperature-axis" hidden>@lang("Temperature")</div>
<div id="humidity-label" hidden>@lang("Real-time Humidity")</div>
<div id="humidity-axis" hidden>@lang("Humidity")</div>
<div id="heat-index-label" hidden>@lang("Real-time Heat Index")</div>
<div id="heat-index-axis" hidden>@lang("Heat Index")</div>
<div id="device-hours-usage-label" hidden>@lang("Hours Usage")</div>
<div id="device-electrical-consumption-label" hidden>@lang("Electrical Consumption")</div>
<div id="device-hours-axis" hidden>@lang("Hours Usage")</div>
<div id="device-consumption-axis" hidden>@lang("KWH")</div>
<script src="../assets/js/2.13.0.moment.min.js"></script>
<script src="../assets/js/2.9.3.Chart.bundle.min.js"></script>
<script src="../assets/js/real.time.moment.min.js"></script>
<script src="../assets/js/real.time.chart.js"></script>
<script src="../assets/js/hammer.js"></script>
<script src="../assets/js/chartjs-plugin-zoom.js"></script>
<script>

    var chartColors = {
        red: 'rgba(255, 99, 132, 0.5)',
        orange: 'rgba(255, 159, 64, 0.5)',
        yellow: 'rgba(255, 205, 86, 0.5)',
        green: 'rgba(75, 192, 192, 0.5)',
        blue: 'rgba(54, 162, 235, 0.5)',
        purple: 'rgba(153, 102, 255, 0.5)',
        grey: 'rgba(201, 203, 207, 0.5)'
    };

    /* Static Chart */

    var timeFormat = "DD/MM/YYYY HH:mm:ss";
    // function randomScalingFactor() {
    //     return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
    // }
    // function randomColorFactor() {
    //     return Math.round(Math.random() * 255);
    // }
    // function randomColor(opacity) {
    //     return (
    //         "rgba(" +
    //         randomColorFactor() +
    //         "," +
    //         randomColorFactor() +
    //         "," +
    //         randomColorFactor() +
    //         "," +
    //         (opacity || ".3") +
    //         ")"
    //     );
    // }
    // function newDate(days) {
    //     return moment()
    //         .add(days, "d")
    //         .toDate();
    // }
    // function newDateString(days) {
    //     return moment()
    //         .add(days, "d")
    //         .format(timeFormat);
    // }
    // function newTimestamp(days) {
    //     return moment()
    //         .add(days, "d")
    //         .unix();
    // }
    function resetZoomTemperature() {
        window.myLineTemperature.resetZoom();
    }

    var configStaticTemperature = {
        type: "line",
        data: {
            datasets: [{
                label: $("#temperature-label").text(),
                backgroundColor: chartColors.red,
                borderColor: chartColors.red,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [
                    {
                        type: "time",
                        time: {
                            format: timeFormat,
                            parser: !1,
                            format: !1,
                            unit: !1,
                            round: !1,
                            displayFormat: !1,
                            isoWeekday: !1,
                            minUnit: "millisecond",
                            displayFormats: {
                                millisecond: "HH:mm:ss.SSS ",
                                second: "HH:mm:ss ",
                                minute: "HH:mm",
                                hour: "HH",
                                day: "DD/MM",
                                week: "ll",
                                month: "DD/MM/YYYY",
                                quarter: "[Q]Q - YYYY",
                                year: "YYYY"
                            }
                        },
                        scaleLabel: {
                            display: false,
                            labelString: ""
                        },
                        ticks: {
                            maxRotation: 0
                        }
                    }
                ],
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: $("#temperature-axis").text()
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            },
            plugins: {
                streaming: false,
            },
        }
    };

    configStaticTemperature.data.datasets.forEach(function(dataset) {

        dataset.data = staticTemperatureData;

    });

    $("#chart-all-records-temperature").ready(function() {
        var ctx = document.getElementById("chart-all-records-temperature").getContext("2d");
        window.myLineTemperature = new Chart(ctx, configStaticTemperature);
    });

    /* Humidity */

    function resetZoomHumidity() {
        window.myLineHumidity.resetZoom();
    }

    var configStaticHumidity = {
        type: "line",
        data: {
            datasets: [{
                label: $("#humidity-label").text(),
                backgroundColor: chartColors.blue,
                borderColor: chartColors.blue,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [
                    {
                        type: "time",
                        time: {
                            format: timeFormat,
                            parser: !1,
                            format: !1,
                            unit: !1,
                            round: !1,
                            displayFormat: !1,
                            isoWeekday: !1,
                            minUnit: "millisecond",
                            displayFormats: {
                                millisecond: "HH:mm:ss.SSS ",
                                second: "HH:mm:ss ",
                                minute: "HH:mm",
                                hour: "HH",
                                day: "DD/MM",
                                week: "ll",
                                month: "DD/MM/YYYY",
                                quarter: "[Q]Q - YYYY",
                                year: "YYYY"
                            }
                        },
                        scaleLabel: {
                            display: false,
                            labelString: ""
                        },
                        ticks: {
                            maxRotation: 0
                        }
                    }
                ],
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: $("#humidity-axis").text()
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            },
            plugins: {
                streaming: false,
            },
        }
    };

    configStaticHumidity.data.datasets.forEach(function(dataset) {

        dataset.data = staticHumidityData;

    });

    $("#chart-all-records-humidity").ready(function() {
        var ctx = document.getElementById("chart-all-records-humidity").getContext("2d");
        window.myLineHumidity = new Chart(ctx, configStaticHumidity);
    });

    /* Heat Index */

    function resetZoomHeatIndex() {
        window.myLineHeatIndex.resetZoom();
    }

    var configStaticHeatIndex = {
        type: "line",
        data: {
            datasets: [{
                label: $("#heat-index-label").text(),
                backgroundColor: chartColors.orange,
                borderColor: chartColors.orange,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [
                    {
                        type: "time",
                        time: {
                            format: timeFormat,
                            parser: !1,
                            format: !1,
                            unit: !1,
                            round: !1,
                            displayFormat: !1,
                            isoWeekday: !1,
                            minUnit: "millisecond",
                            displayFormats: {
                                millisecond: "HH:mm:ss.SSS ",
                                second: "HH:mm:ss ",
                                minute: "HH:mm",
                                hour: "HH",
                                day: "DD/MM",
                                week: "ll",
                                month: "DD/MM/YYYY",
                                quarter: "[Q]Q - YYYY",
                                year: "YYYY"
                            }
                        },
                        scaleLabel: {
                            display: false,
                            labelString: ""
                        },
                        ticks: {
                            maxRotation: 0
                        }
                    }
                ],
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: $("#heat-index-axis").text()
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            },
            plugins: {
                streaming: false,
            },
        }
    };

    configStaticHeatIndex.data.datasets.forEach(function(dataset) {

        dataset.data = staticHeatIndexData;

    });

    $("#chart-all-records-heat-index").ready(function() {
        var ctx = document.getElementById("chart-all-records-heat-index").getContext("2d");
        window.myLineHeatIndex = new Chart(ctx, configStaticHeatIndex);
    });

    /* Device */

    function resetZoomDeviceHours() {
        window.myLineDeviceHours.resetZoom();
    }

    function resetZoomDeviceConsumption() {
        window.myLineDeviceConsumption.resetZoom();
    }

    var configStaticDeviceHours = {
        type: "line",
        data: {
            datasets: [{
                label: $("#device-hours-usage-label").text(),
                backgroundColor: chartColors.green,
                borderColor: chartColors.green,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [
                    {
                        type: "time",
                        time: {
                            format: timeFormat,
                            parser: !1,
                            format: !1,
                            unit: !1,
                            round: !1,
                            displayFormat: !1,
                            isoWeekday: !1,
                            minUnit: "millisecond",
                            displayFormats: {
                                millisecond: "HH:mm:ss.SSS ",
                                second: "HH:mm:ss ",
                                minute: "HH:mm",
                                hour: "HH",
                                day: "DD/MM",
                                week: "ll",
                                month: "DD/MM/YYYY",
                                quarter: "[Q]Q - YYYY",
                                year: "YYYY"
                            }
                        },
                        scaleLabel: {
                            display: false,
                            labelString: ""
                        },
                        ticks: {
                            maxRotation: 0
                        }
                    }
                ],
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: $("#device-hours-axis").text()
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            },
            plugins: {
                streaming: false,
            },
        }
    };

    configStaticDeviceHours.data.datasets.forEach(function(dataset) {

        dataset.data = staticDeviceHours;

    });

    $("#chart-all-records-device-hours").ready(function() {
        var ctx = document.getElementById("chart-all-records-device-hours").getContext("2d");
        window.myLineDeviceHours = new Chart(ctx, configStaticDeviceHours);
    });

    var configStaticDeviceConsumption = {
        type: "line",
        data: {
            datasets: [{
                label: $("#device-electrical-consumption-label").text(),
                backgroundColor: chartColors.yellow,
                borderColor: chartColors.yellow,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [
                    {
                        type: "time",
                        time: {
                            format: timeFormat,
                            parser: !1,
                            format: !1,
                            unit: !1,
                            round: !1,
                            displayFormat: !1,
                            isoWeekday: !1,
                            minUnit: "millisecond",
                            displayFormats: {
                                millisecond: "HH:mm:ss.SSS ",
                                second: "HH:mm:ss ",
                                minute: "HH:mm",
                                hour: "HH",
                                day: "DD/MM",
                                week: "ll",
                                month: "DD/MM/YYYY",
                                quarter: "[Q]Q - YYYY",
                                year: "YYYY"
                            }
                        },
                        scaleLabel: {
                            display: false,
                            labelString: ""
                        },
                        ticks: {
                            maxRotation: 0
                        }
                    }
                ],
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: $("#device-consumption-axis").text()
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            },
            plugins: {
                streaming: false,
            },
        }
    };

    configStaticDeviceConsumption.data.datasets.forEach(function(dataset) {

        dataset.data = staticDeviceConsumption;

    });

    $("#chart-all-records-device-consumption").ready(function() {
        var ctx = document.getElementById("chart-all-records-device-consumption").getContext("2d");
        window.myLineDeviceConsumption = new Chart(ctx, configStaticDeviceConsumption);
    });

    var timeDevice = $('#newest-timestamp-device').val();

    function updateNewDeviceData(){

        $.ajax({
            url: "update-device-real-time",
            type: "POST",
            data: {_token: "{{csrf_token()}}", device_id: "{{ session("1752051_current_device")["device_id"] }}" },
            async: false,
            success: function (data) {
                // alert(data.split(";"));
                // return data.split(",");
                var finalData = data.split(",");

                if (timeDevice != finalData[6]){

                    timeDevice = finalData[6];

                    var date = moment(parseInt(finalData[6]) * 1000);

                    if (finalData[2] === "1") {

                        var insertHtml = '<tr> <td class="text-center"></td> <td>' + finalData[0] + '</td> <td>' + finalData[1] + '</td> <td> <input id="on-toggle' + finalData[6] + '" type="checkbox" checked data-bootstrap-switch-disabled data-off-color="danger" data-on-color="success"> </td> <td>' + finalData[3] + '</td> <td> --- </td> <td> --- </td> <td>' + date.format("DD/MM/YYYY HH:mm:ss") + '</td> <td class="project-actions text-left"> </td> </tr>';

                    }

                    else {

                        var insertHtml = '<tr> <td class="text-center"></td> <td>' + finalData[0] + '</td> <td>' + finalData[1] + '</td> <td>  <input id="off-toggle' + finalData[6] + '" type="checkbox" data-bootstrap-switch-disabled data-off-color="danger" data-on-color="success"> </td> <td>' + finalData[3] + '</td> <td>' + finalData[4] + '</td> <td>' + finalData[5] + '</td> <td>' + date.format("DD/MM/YYYY HH:mm:ss") + '</td> <td class="project-actions text-left"> </td> </tr>';

                    }

                    $('#device-tbody').prepend(insertHtml);

                    $("#on-toggle" + finalData[6]).bootstrapSwitch('toggleDisabled',true,true);

                    $("#off-toggle" + finalData[6]).bootstrapSwitch('toggleDisabled',true,true);

                    $(".bootstrap-switch-success").text('@lang("ON")');

                    $(".bootstrap-switch-danger").text('@lang("OFF")');

                }
            }
        })

    }

    setInterval(function(){
        updateNewDeviceData();
        }, 1000
    );

</script>
<script src="../assets/js/chartjs-plugin-streaming.js"></script>
<script>

    var valueTemperature = 0,
        timeTemperature = $('#newest-timestamp-sensor').val(),
        valueHumidity = 0,
        timeHumidity = $('#newest-timestamp-sensor').val(),
        valueHeatIndex = 0,
        timeHeatIndex = $('#newest-timestamp-sensor').val();

    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    var isIE = navigator.userAgent.indexOf('MSIE') !== -1 || navigator.userAgent.indexOf('Trident') !== -1;

    // function randomScalingFactor() {
    //     return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
    // }

    /* Temperature */

    function getRealTimeTemperature(chart){

        var tempTime = 0,
            tempValue = 0;

        $.ajax({
            url: "get-sensor-real-time",
            type: "POST",
            data: {_token: "{{csrf_token()}}", sensor_id: "{{ session("1752051_current_sensor")["sensor_id"] }}", sensor_real_time_type: 0 },
            async: false,
            success: function (data) {
                // alert(data.split(";"));
                // return data.split(",");
                var finalData = data.split(",");

                tempTime= parseInt(finalData[0]);
                tempValue = parseFloat(finalData[1]).toFixed(1);

                // alert(tempValue);
            }
        })

        if (timeTemperature != tempTime){
            timeTemperature = tempTime;
            valueTemperature = tempValue;
            chart.config.data.datasets.forEach(function(dataset) {
                dataset.data.push({
                    x: timeTemperature * 1000,
                    y: valueTemperature
                });
            });

            $.ajax({
                url: "update-sensor-real-time",
                type: "POST",
                data: {_token: "{{csrf_token()}}", sensor_id: "{{ session("1752051_current_sensor")["sensor_id"] }}" },
                async: false,
                success: function (data) {
                    // alert(data.split(";"));
                    // return data.split(",");
                    var finalData = data.split(",");

                    var date = moment(finalData[5] * 1000);

                    var insertHtml = '<tr> <td class="text-center"></td> <td>' + finalData[0] + '</td><td>' + finalData[1] + '</td><td>' + finalData[2] + '</td><td>' + finalData[3] + '</td><td>' + finalData[4] + '</td><td>' + date.format("DD/MM/YYYY HH:mm:ss") + '</td> <td class="project-actions text-left"> </td> </tr>';

                    $('#sensor-tbody').prepend(insertHtml);
                }
            })
        }

    }

    var color = Chart.helpers.color;
    var configTemperature = {
        type: 'line',
        data: {
            datasets: [{
                label: $("#temperature-label").text(),
                backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
                borderColor: chartColors.red,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            title: {
                display: false,
                text: ''
            },
            scales: {
                xAxes: [{
                    type: 'realtime',
                    realtime: {
                        // pause: true,
                        duration: 20000,
                        refresh: 1000,
                        delay: 5000,
                        onRefresh: getRealTimeTemperature
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: $("#temperature-axis").text()
                    }
                }]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            }
        }
    };

    $("#chart-real-time-temperature").ready(function() {
        var ctx = document.getElementById('chart-real-time-temperature').getContext('2d');
        window.myChart = new Chart(ctx, configTemperature);
    });

    document.getElementById('duration-temperature').addEventListener(isIE ? 'change' : 'input', function() {
        configTemperature.options.scales.xAxes[0].realtime.duration = +this.value;
        window.myChart.update({duration: 0});
        // document.getElementById('durationValue').innerHTML = this.value;
    });

    document.getElementById('pause-temperature').addEventListener('change', function() {
        configTemperature.options.scales.xAxes[0].realtime.pause = this.checked;
        window.myChart.update({duration: 0});
        // document.getElementById('pauseValue').innerHTML = this.checked;
    });

    /* Humidity */

    function getRealTimeHumidity(chart){

        var tempTime = 0,
            tempValue = 0;

        $.ajax({
            url: "get-sensor-real-time",
            type: "POST",
            data: {_token: "{{csrf_token()}}", sensor_id: "{{ session("1752051_current_sensor")["sensor_id"] }}", sensor_real_time_type: 1 },
            async: false,
            success: function (data) {
                // alert(data.split(";"));
                // return data.split(",");
                var finalData = data.split(",");

                tempTime = parseInt(finalData[0]);
                tempValue = parseFloat(finalData[1]).toFixed(1);

            }
        })

        if (timeHumidity != tempTime){
            timeHumidity = tempTime;
            valueHumidity = tempValue;
            chart.config.data.datasets.forEach(function(dataset) {
                dataset.data.push({
                    x: timeHumidity * 1000,
                    y: valueHumidity
                });
            });
        }

    }

    var configHumidity = {
        type: 'line',
        data: {
            datasets: [{
                label: $("#humidity-label").text(),
                backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
                borderColor: chartColors.blue,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            title: {
                display: false,
                text: ''
            },
            scales: {
                xAxes: [{
                    type: 'realtime',
                    realtime: {
                        // pause: true,
                        duration: 20000,
                        refresh: 1000,
                        delay: 5000,
                        onRefresh: getRealTimeHumidity
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: $("#humidity-axis").text()
                    }
                }]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            }
        }
    };

    $("#chart-real-time-humidity").ready(function() {
        var ctx = document.getElementById('chart-real-time-humidity').getContext('2d');
        window.myChart = new Chart(ctx, configHumidity);
    });

    document.getElementById('duration-humidity').addEventListener(isIE ? 'change' : 'input', function() {
        configHumidity.options.scales.xAxes[0].realtime.duration = +this.value;
        window.myChart.update({duration: 0});
        // document.getElementById('durationValue').innerHTML = this.value;
    });

    document.getElementById('pause-humidity').addEventListener('change', function() {
        configHumidity.options.scales.xAxes[0].realtime.pause = this.checked;
        window.myChart.update({duration: 0});
        // document.getElementById('pauseValue').innerHTML = this.checked;
    });

    /* Heat Index */

    function getRealTimeHeatIndex(chart){

        var tempTime = 0,
            tempValue = 0;

        $.ajax({
            url: "get-sensor-real-time",
            type: "POST",
            data: {_token: "{{csrf_token()}}", sensor_id: "{{ session("1752051_current_sensor")["sensor_id"] }}", sensor_real_time_type: 2 },
            async: false,
            success: function (data) {
                // alert(data.split(";"));
                // return data.split(",");
                var finalData = data.split(",");

                tempTime= parseInt(finalData[0]);
                tempValue = parseFloat(finalData[1]).toFixed(1);

                // alert(tempValue);
            }
        })

        if (timeHeatIndex != tempTime){
            timeHeatIndex = tempTime;
            valueHeatIndex = tempValue;
            chart.config.data.datasets.forEach(function(dataset) {
                dataset.data.push({
                    x: timeHeatIndex * 1000,
                    y: valueHeatIndex
                });
            });
        }

    }

    var configHeatIndex = {
        type: 'line',
        data: {
            datasets: [{
                label: $("#heat-index-label").text(),
                backgroundColor: color(chartColors.orange).alpha(0.5).rgbString(),
                borderColor: chartColors.orange,
                fill: true,
                cubicInterpolationMode: 'monotone',
                data: []
            }]
        },
        options: {
            title: {
                display: false,
                text: ''
            },
            scales: {
                xAxes: [{
                    type: 'realtime',
                    realtime: {
                        // pause: true,
                        duration: 20000,
                        refresh: 1000,
                        delay: 5000,
                        onRefresh: getRealTimeHeatIndex
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: $("#heat-index-axis").text()
                    }
                }]
            },
            tooltips: {
                mode: 'nearest',
                intersect: false,
                callbacks: {
                    title: function(t, d) {
                        var date = moment(t[0].xLabel);
                        return date.format("DD/MM/YYYY HH:mm:ss");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            pan: {
                enabled: true,    // Enable panning
                mode: 'x',        // Allow panning in the x direction
                rangeMin: {
                    x: null       // Min value of the delay option
                },
                rangeMax: {
                    x: null       // Max value of the delay option
                }
            },
            zoom: {
                enabled: true,    // Enable zooming
                mode: 'x',        // Allow zooming in the x direction
                rangeMin: {
                    x: null       // Min value of the duration option
                },
                rangeMax: {
                    x: null       // Max value of the duration option
                }
            }
        }
    };

    $("#chart-real-time-heat-index").ready(function() {
        var ctx = document.getElementById('chart-real-time-heat-index').getContext('2d');
        window.myChart = new Chart(ctx, configHeatIndex);
    });

    document.getElementById('duration-heat-index').addEventListener(isIE ? 'change' : 'input', function() {
        configHeatIndex.options.scales.xAxes[0].realtime.duration = +this.value;
        window.myChart.update({duration: 0});
        // document.getElementById('durationValue').innerHTML = this.value;
    });

    document.getElementById('pause-heat-index').addEventListener('change', function() {
        configHeatIndex.options.scales.xAxes[0].realtime.pause = this.checked;
        window.myChart.update({duration: 0});
        // document.getElementById('pauseValue').innerHTML = this.checked;
    });

</script>
