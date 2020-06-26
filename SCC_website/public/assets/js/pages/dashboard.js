/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // jvectormap data
  // var visitorsData = {
  //   'US': 398, //USA
  //   'SA': 400, //Saudi Arabia
  //   'CA': 1000, //Canada
  //   'DE': 500, //Germany
  //   'FR': 760, //France
  //   'CN': 300, //China
  //   'AU': 700, //Australia
  //   'BR': 600, //Brazil
  //   'IN': 800, //India
  //   'GB': 320, //Great Britain
  //   'RU': 3000 //Russia
  // }
  // // World map by jvectormap
  // $('#world-map').vectorMap({
  //   map              : 'usa_en',
  //   backgroundColor  : 'transparent',
  //   regionStyle      : {
  //     initial: {
  //       fill            : 'rgba(255, 255, 255, 0.7)',
  //       'fill-opacity'  : 1,
  //       stroke          : 'rgba(0,0,0,.2)',
  //       'stroke-width'  : 1,
  //       'stroke-opacity': 1
  //     }
  //   },
  //   series           : {
  //     regions: [{
  //       values           : visitorsData,
  //       scale            : ['#ffffff', '#0154ad'],
  //       normalizeFunction: 'polynomial'
  //     }]
  //   },
  //   onRegionLabelShow: function (e, el, code) {
  //     if (typeof visitorsData[code] != 'undefined')
  //       el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
  //   }
  // })

  // Sparkline charts
  // var sparkline1 = new Sparkline($("#sparkline-1")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});
  // var sparkline2 = new Sparkline($("#sparkline-2")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});
  // var sparkline3 = new Sparkline($("#sparkline-3")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});
  //
  // sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);
  // sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);
  // sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var stackBarChartData = {
        labels  : ['4/5/2020', '5/5/2020', '6/5/2020', '7/5/2020', '8/5/2020', '9/5/2020', '10/5/2020'],
        datasets: [
            // {
            //     label               : 'Temperature',
            //     backgroundColor     : 'rgba(220, 53, 69, 0.9)',
            //     borderColor         : 'rgba(220, 53, 69, 0.8)',
            //     pointRadius          : false,
            //     pointColor          : '#3b8bba',
            //     pointStrokeColor    : 'rgba(60,141,188,1)',
            //     pointHighlightFill  : '#fff',
            //     pointHighlightStroke: 'rgba(60,141,188,1)',
            //     data                : [28, 38, 40, 24, 36, 37, 30]
            // },
            {
                label               : 'Total Hours Usage',
                backgroundColor     : 'rgba(40, 167, 69, 0.9)',
                borderColor         : 'rgba(40, 167, 69, 0.8)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [75, 80, 40, 32, 44, 55, 60]
            },
        ]
    }

    var areaChartData = {
        labels  : ['4/5/2020', '5/5/2020', '6/5/2020', '7/5/2020', '8/5/2020', '9/5/2020', '10/5/2020'],
        datasets: [
            // {
            //     label               : 'Temperature',
            //     backgroundColor     : 'rgba(220, 53, 69, 0.9)',
            //     borderColor         : 'rgba(220, 53, 69, 0.8)',
            //     pointRadius          : false,
            //     pointColor          : '#3b8bba',
            //     pointStrokeColor    : 'rgba(60,141,188,1)',
            //     pointHighlightFill  : '#fff',
            //     pointHighlightStroke: 'rgba(60,141,188,1)',
            //     data                : [28, 38, 40, 24, 36, 37, 30]
            // },
            {
                label               : 'Humidity',
                backgroundColor     : 'rgba(23, 162, 184, 0.9)',
                borderColor         : 'rgba(23, 162, 184, 0.8)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [50, 30, 24, 40, 44, 45, 50]
            },
        ]
    }

    var lineChartData = {
        labels  : ['5/5/2020', '6/5/2020', '7/5/2020', '8/5/2020', '9/5/2020', '10/5/2020', '11/5/2020'],
        datasets: [
            {
                label               : 'Temperature',
                backgroundColor     : 'rgba(220, 53, 69, 0.9)',
                borderColor         : 'rgba(220, 53, 69, 0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [28, 38, 40, 24, 36, 37, 34]
            },
            // {
            //     label               : 'Humidity',
            //     backgroundColor     : 'rgba(23, 162, 184, 0.9)',
            //     borderColor         : 'rgba(23, 162, 184, 0.8)',
            //     pointRadius         : false,
            //     pointColor          : 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor    : '#c1c7d1',
            //     pointHighlightFill  : '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data                : [50, 30, 24, 40, 44, 45, 50]
            // },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines : {
                    display : false,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, lineChartData)
    lineChartData.datasets[0].fill = false;
    // lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
        labels: [
            "FAN100",
            "LIGHT200",
            "AIRC300",
            "FAN101",
            "LIGHT201",
            "AIRC301",
        ],
        datasets: [
            {
                data: [700,500,400,600,300,100],
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
        ]
    }
    var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    // var pieData        = donutData;
    // var pieOptions     = {
    //     maintainAspectRatio : false,
    //     responsive : true,
    // }
    // //Create pie or douhnut chart
    // // You can switch between pie and douhnut using the method below.
    // var pieChart = new Chart(pieChartCanvas, {
    //     type: 'pie',
    //     data: pieData,
    //     options: pieOptions
    // })

    //-------------
    //- BAR CHART -
    //-------------
    // var barChartCanvas = $('#barChart').get(0).getContext('2d')
    // var barChartData = jQuery.extend(true, {}, barChartData)
    // var temp0 = barChartData.datasets[0]
    // // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp0
    // // barChartData.datasets[1] = temp0

    // var barChartOptions = {
    //     responsive              : true,
    //     maintainAspectRatio     : false,
    //     datasetFill             : false
    // }
    //
    // var barChart = new Chart(barChartCanvas, {
    //     type: 'bar',
    //     data: barChartData,
    //     options: barChartOptions
    // })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, stackBarChartData)

    var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    })




    $(function () {
        /*
         * Flot Interactive Chart
         * -----------------------
         */
        // We use an inline data source in the example, usually data would
        // be fetched from a server
        var data        = [],
            data2        = [],
            totalPoints = 50,
            totalMorePoints = 100

        function getTemperaturData() {

            if (data.length > 0) {
                data = data.slice(1)
            }

            // Do a random walk
            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y    = prev + Math.random() * 10 - 5

                if (y < 0) {
                    y = 0
                } else if (y > 40) {
                    y = 40
                } else if (y < 24) {
                    y = 24
                }

                data.push(y)
            }

            // Zip the generated y values with the x values
            var res = []
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]])
            }

            return res

            // $.ajax({
            //     url: "get-real-time-temp",
            //     type: "POST",
            //     data: {_token: "{{csrf_token()}}", time_update_temp: temp, time_update_humid: humid, time_update_heat_index: heat_index },
            //     async: false,
            //     success: function (data) {
            //         message_json = JSON.parse(data.split("GMT")[1]);
            //         $(document).ready(function() {
            //             $("#success-alert").click();
            //         });
            //     }
            // })
        }

        function getMoreRandomData() {

            if (data2.length > 0) {
                data2 = data2.slice(1)
            }

            // Do a random walk
            while (data2.length < totalMorePoints) {

                var prev = data2.length > 0 ? data2[data2.length - 1] : 50,
                    y    = prev + Math.random() * 10 - 5

                if (y < 0) {
                    y = 0
                } else if (y > 100) {
                    y = 100
                } else if (y < 30) {
                    y = 30
                }

                data2.push(y)
            }

            // Zip the generated y values with the x values
            var res = []
            for (var i = 0; i < data2.length; ++i) {
                res.push([i, data2[i]])
            }

            return res
        }

        var interactive_plot = $.plot('#interactive', [
                {
                    data: getTemperaturData(),
                }
            ],
            {
                grid: {
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                series: {
                    color: '#3c8dbc',
                    lines: {
                        lineWidth: 2,
                        show: true,
                        fill: true,
                    },
                },
                yaxis: {
                    min: 0,
                    max: 50,
                    show: true
                },
                xaxis: {
                    show: true
                }
            }
        )

        var interactive_plot2 = $.plot('#interactive2', [
                {
                    data: getMoreRandomData(),
                }
            ],
            {
                grid: {
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                series: {
                    color: '#3c8dbc',
                    lines: {
                        lineWidth: 2,
                        show: true,
                        fill: true,
                    },
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    show: true
                },
                xaxis: {
                    show: true
                }
            }
        )

        var updateInterval = 500 //Fetch data ever x milliseconds
        var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
        var realtime2       = 'on'
        function update() {

            interactive_plot.setData([getTemperaturData()])

            // Since the axes don't change, we don't need to call plot.setupGrid()
            interactive_plot.draw()
            if (realtime === 'on') {
                setTimeout(update, updateInterval)
            }
        }

        function update2() {

            interactive_plot2.setData([getMoreRandomData()])

            // Since the axes don't change, we don't need to call plot.setupGrid()
            interactive_plot2.draw()
            if (realtime2 === 'on') {
                setTimeout(update2, updateInterval)
            }
        }

        //INITIALIZE REALTIME DATA FETCHING
        if (realtime === 'on') {
            update()
        }
        if (realtime2 === 'on') {
            update2()
        }
        //REALTIME TOGGLE
        $('#realtime .btn').click(function () {
            if ($(this).data('toggle') === 'on') {
                realtime = 'on'
            }
            else {
                realtime = 'off'
            }
            update()
        })

        //REALTIME TOGGLE
        $('#realtime2 .btn').click(function () {
            if ($(this).data('toggle') === 'on') {
                realtime2 = 'on'
            }
            else {
                realtime2 = 'off'
            }
            update2()
        })
        /*
         * END INTERACTIVE CHART
         */


        /*
         * LINE CHART
         * ----------
         */
        //LINE randomly generated data

        // var sin = [],
        //     cos = []
        // for (var i = 0; i < 14; i += 0.5) {
        //     sin.push([i, Math.sin(i)])
        //     cos.push([i, Math.cos(i)])
        // }
        // var line_data1 = {
        //     data : sin,
        //     color: '#3c8dbc'
        // }
        // var line_data2 = {
        //     data : cos,
        //     color: '#00c0ef'
        // }
        // $.plot('#line-chart', [line_data1, line_data2], {
        //     grid  : {
        //         hoverable  : true,
        //         borderColor: '#f3f3f3',
        //         borderWidth: 1,
        //         tickColor  : '#f3f3f3'
        //     },
        //     series: {
        //         shadowSize: 0,
        //         lines     : {
        //             show: true
        //         },
        //         points    : {
        //             show: true
        //         }
        //     },
        //     lines : {
        //         fill : false,
        //         color: ['#3c8dbc', '#f56954']
        //     },
        //     yaxis : {
        //         show: true
        //     },
        //     xaxis : {
        //         show: true
        //     }
        // })
        // //Initialize tooltip on hover
        // $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        //     position: 'absolute',
        //     display : 'none',
        //     opacity : 0.8
        // }).appendTo('body')
        // $('#line-chart').bind('plothover', function (event, pos, item) {
        //
        //     if (item) {
        //         var x = item.datapoint[0].toFixed(2),
        //             y = item.datapoint[1].toFixed(2)
        //
        //         $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
        //             .css({
        //                 top : item.pageY + 5,
        //                 left: item.pageX + 5
        //             })
        //             .fadeIn(200)
        //     } else {
        //         $('#line-chart-tooltip').hide()
        //     }
        //
        // })
        // /* END LINE CHART */
        //
        // /*
        //  * FULL WIDTH STATIC AREA CHART
        //  * -----------------
        //  */
        // var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
        //     [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
        //     [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
        // $.plot('#area-chart', [areaData], {
        //     grid  : {
        //         borderWidth: 0
        //     },
        //     series: {
        //         shadowSize: 0, // Drawing is faster without shadows
        //         color     : '#00c0ef',
        //         lines : {
        //             fill: true //Converts the line chart to area chart
        //         },
        //     },
        //     yaxis : {
        //         show: false
        //     },
        //     xaxis : {
        //         show: false
        //     }
        // })

        /* END AREA CHART */

        /*
         * BAR CHART
         * ---------
         */

        // var bar_data = {
        //     data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
        //     bars: { show: true }
        // }
        // $.plot('#bar-chart', [bar_data], {
        //     grid  : {
        //         borderWidth: 1,
        //         borderColor: '#f3f3f3',
        //         tickColor  : '#f3f3f3'
        //     },
        //     series: {
        //         bars: {
        //             show: true, barWidth: 0.5, align: 'center',
        //         },
        //     },
        //     colors: ['#3c8dbc'],
        //     xaxis : {
        //         ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
        //     }
        // })
        /* END BAR CHART */

        /*
         * DONUT CHART
         * -----------
         */

        // var donutData = [
        //     {
        //         label: 'Series2',
        //         data : 30,
        //         color: '#3c8dbc'
        //     },
        //     {
        //         label: 'Series3',
        //         data : 20,
        //         color: '#0073b7'
        //     },
        //     {
        //         label: 'Series4',
        //         data : 50,
        //         color: '#00c0ef'
        //     }
        // ]
        // $.plot('#donut-chart', donutData, {
        //     series: {
        //         pie: {
        //             show       : true,
        //             radius     : 1,
        //             innerRadius: 0.5,
        //             label      : {
        //                 show     : true,
        //                 radius   : 2 / 3,
        //                 formatter: labelFormatter,
        //                 threshold: 0.1
        //             }
        //
        //         }
        //     },
        //     legend: {
        //         show: false
        //     }
        // })
        /*
         * END DONUT CHART
         */

    })

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
    }










    /* Chart.js Charts */
  // Sales chart
  // var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
  // //$('#revenue-chart').get(0).getContext('2d');
  //
  // var salesChartData = {
  //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  //   datasets: [
  //     {
  //       label               : 'Digital Goods',
  //       backgroundColor     : 'rgba(60,141,188,0.9)',
  //       borderColor         : 'rgba(60,141,188,0.8)',
  //       pointRadius          : false,
  //       pointColor          : '#3b8bba',
  //       pointStrokeColor    : 'rgba(60,141,188,1)',
  //       pointHighlightFill  : '#fff',
  //       pointHighlightStroke: 'rgba(60,141,188,1)',
  //       data                : [28, 48, 40, 19, 86, 27, 90]
  //     },
  //     {
  //       label               : 'Electronics',
  //       backgroundColor     : 'rgba(210, 214, 222, 1)',
  //       borderColor         : 'rgba(210, 214, 222, 1)',
  //       pointRadius         : false,
  //       pointColor          : 'rgba(210, 214, 222, 1)',
  //       pointStrokeColor    : '#c1c7d1',
  //       pointHighlightFill  : '#fff',
  //       pointHighlightStroke: 'rgba(220,220,220,1)',
  //       data                : [65, 59, 80, 81, 56, 55, 40]
  //     },
  //   ]
  // }
  //
  // var salesChartOptions = {
  //   maintainAspectRatio : false,
  //   responsive : true,
  //   legend: {
  //     display: false
  //   },
  //   scales: {
  //     xAxes: [{
  //       gridLines : {
  //         display : false,
  //       }
  //     }],
  //     yAxes: [{
  //       gridLines : {
  //         display : false,
  //       }
  //     }]
  //   }
  // }
  //
  // // This will get the first returned node in the jQuery collection.
  // var salesChart = new Chart(salesChartCanvas, {
  //     type: 'line',
  //     data: salesChartData,
  //     options: salesChartOptions
  //   }
  // )
  //
  // // Donut Chart
  // var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
  // var pieData        = {
  //   labels: [
  //       'Instore Sales',
  //       'Download Sales',
  //       'Mail-Order Sales',
  //   ],
  //   datasets: [
  //     {
  //       data: [30,12,20],
  //       backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
  //     }
  //   ]
  // }
  // var pieOptions = {
  //   legend: {
  //     display: false
  //   },
  //   maintainAspectRatio : false,
  //   responsive : true,
  // }
  // //Create pie or douhnut chart
  // // You can switch between pie and douhnut using the method below.
  // var pieChart = new Chart(pieChartCanvas, {
  //   type: 'doughnut',
  //   data: pieData,
  //   options: pieOptions
  // });
  //
  // // Sales graph chart
  // var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
  // //$('#revenue-chart').get(0).getContext('2d');
  //
  // var salesGraphChartData = {
  //   labels  : ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
  //   datasets: [
  //     {
  //       label               : 'Digital Goods',
  //       fill                : false,
  //       borderWidth         : 2,
  //       lineTension         : 0,
  //       spanGaps : true,
  //       borderColor         : '#efefef',
  //       pointRadius         : 3,
  //       pointHoverRadius    : 7,
  //       pointColor          : '#efefef',
  //       pointBackgroundColor: '#efefef',
  //       data                : [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
  //     }
  //   ]
  // }
  //
  // var salesGraphChartOptions = {
  //   maintainAspectRatio : false,
  //   responsive : true,
  //   legend: {
  //     display: false,
  //   },
  //   scales: {
  //     xAxes: [{
  //       ticks : {
  //         fontColor: '#efefef',
  //       },
  //       gridLines : {
  //         display : false,
  //         color: '#efefef',
  //         drawBorder: false,
  //       }
  //     }],
  //     yAxes: [{
  //       ticks : {
  //         stepSize: 5000,
  //         fontColor: '#efefef',
  //       },
  //       gridLines : {
  //         display : true,
  //         color: '#efefef',
  //         drawBorder: false,
  //       }
  //     }]
  //   }
  // }
  //
  // // This will get the first returned node in the jQuery collection.
  // var salesGraphChart = new Chart(salesGraphChartCanvas, {
  //     type: 'line',
  //     data: salesGraphChartData,
  //     options: salesGraphChartOptions
  //   }
  // )

})
