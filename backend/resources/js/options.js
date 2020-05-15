const StatsLineOptions = {
    scales: {
        responsive: false,
        maintainAspectRatio: true,
        yAxes: [{
            display: false
        }],
        xAxes: [{
            display: false
        }]
    },
    legend: {
        display: false
    },
    elements: {
        point: {
            radius: 0
        }
    },
    stepsize: 100
}

export default StatsLineOptions;
