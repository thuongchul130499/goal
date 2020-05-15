<template>
    <div class="col-md-3 col-sm-6 col-6 equel-grid">
        <div class="grid">
            <div class="grid-body text-gray">
                <div class="d-flex justify-content-between">
                    <p>30%</p>
                    <p>+06.2%</p>
                </div>
                <p class="text-black">Thành viên mới</p>
                <div class="wrapper w-50 mt-4">
                    <canvas height="45" id="stat-line_1"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import StatsLineOptions from "../../options";
    import { mapGetters, mapState } from 'vuex';
    export default {
        mounted(){
            this.chart();
        },
        computed: {
            ...mapState([
                'getDataUser'
            ])
        },
        methods: {
            chart(){
                console.log(this.getDataUser);
                // let labels = this.getData.map ( e => e.date );
                // console.log(labels)
                // var lineChartCanvas = $("#stat-line_1").get(0).getContext("2d");
                // var gradientStroke = lineChartCanvas.createLinearGradient(100, 60, 30, 0);
                // gradientStroke.addColorStop(0, '#B721FF');
                // gradientStroke.addColorStop(1, '#21D4FD');
                // var lineChart = new Chart(lineChartCanvas, {
                //     type: 'line',
                //     data: {
                //         labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7", "Day 8", "Day 9", "Day 10", "Day 11", "Day 12", "Day 13"],
                //         datasets: [{
                //             label: 'Profit',
                //             data: [100, 6, 9, 7, 8, 6, 8, 5, 7, 8, 6, 7, 100],
                //             borderColor: gradientStroke,
                //             borderWidth: 3,
                //             fill: true
                //         }]
                //     },
                //     options: StatsLineOptions
                // });
            }
        }
    }
</script>
