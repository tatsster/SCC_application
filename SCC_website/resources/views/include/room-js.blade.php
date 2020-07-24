<script src="../assets/js/real.time.moment.min.js"></script>
<script src="../assets/js/real.time.chart.js"></script>
<script src="../assets/js/chartjs-plugin-streaming.js"></script>
<div id="temperature-label" hidden>@lang("Real-time Temperature")</div>
<div id="temperature-axis" hidden>@lang("Temperature")</div>
<div id="humidity-label" hidden>@lang("Real-time Humidity")</div>
<div id="humidity-axis" hidden>@lang("Humidity")</div>
<div id="heat-index-label" hidden>@lang("Real-time Heat Index")</div>
<div id="heat-index-axis" hidden>@lang("Heat Index")</div>
<script>

    var valueTemperature = 0,
        timeTemperature = 0,
        valueHumidity = 0,
        timeHumidity = 0,
        valueHeatIndex = 0,
        timeHeatIndex = 0;

    var isIE = navigator.userAgent.indexOf('MSIE') !== -1 || navigator.userAgent.indexOf('Trident') !== -1;

    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

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
            // hover: {
            //     mode: 'nearest',
            //     intersect: false
            // },
            // animation: {
            //     duration: 0                    // general animation time
            // },
            // hover: {
            //     animationDuration: 0           // duration of animations when hovering an item
            // },
            // responsiveAnimationDuration: 0,    // animation duration after a resize
            // plugins: {
            //     streaming: {
            //         frameRate: 5               // chart is drawn 5 times every second
            //     }
            // }
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
