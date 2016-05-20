

$(function() {

    var data = [{
        label: "Post",
        data: 1
    }, {
        label: "Halaman",
        data: 3
    }, {
        label: "Komentar",
        data: 9
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {

                show: true,
                label: {
                show: true
            }
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});

$(function() {

    var data = [{
        label: "Uploads",
        data: 1
    }, {
        label: "Downloads",
        data: 3
    }];

    var plotObj = $.plot($("#flot-pie-chart2"), data, {
        series: {
            pie: {
                innerRadius: 0.5,
                show: true,
                label: {
                show: true
            }
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});