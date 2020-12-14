"use strict";
$(document).ready(function() {
    $(window).on('resize',function() {
        categoryChart();
    });

    categoryChart();

    /*categories chart*/
    function categoryChart() {
        var data = [
            ["January", 20000],
            ["February", 8],
            ["March", 4],
            ["April", 13],
            ["May", 5],
            ["June", 9],
            ["July", 91],
            ["August", 23],
            ["September", 29],
            ["October", 12],
            ["November", 45],
            ["December", 9]
        ];
        /* var d = axios.get('/tenant/analytics/financials');
        console.log(d); */
        $.plot("#placeholder", [data], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.3,
                    align: "center",
                }
            },

            xaxis: {
                mode: "categories",
                tickLength: 0,
                tickColor: '#f5f5f5',
            },
            colors: ["#01C0C8", "#83D6DE"],
            labelBoxBorderColor: "red"

        });
    };


});
