<template>
    <div class="col-lg-4 col-md-6 equel-grid">
        <div class="grid">
            <div class="grid-body d-flex flex-column h-100">
                <div class="wrapper">
                    <div class="d-flex justify-content-between">
                        <div class="split-header">
                            <img class="img-ss mt-1 mb-1 mr-2" src="template/images/social-icons/instagram.svg" alt="instagram">
                            <p class="card-title">Lượt theo dõi theo 7 ngày vừa qua</p>
                        </div>
                        <div class="wrapper">
                            <button class="btn action-btn btn-xs component-flat pr-0" type="button">
                                <i class="mdi mdi-access-point text-muted mdi-2x"></i></button>
                            <button class="btn action-btn btn-xs component-flat pr-0" type="button">
                                <i class="mdi mdi-cloud-download-outline text-muted mdi-2x"></i></button>
                        </div>
                    </div>
                </div>
                <div class="mt-auto">
                    <div class="loader user-table" :class="{hide: !loading}"></div>
                    <canvas class="curved-mode" id="followers-bar-chart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Statistical',
        data(){
            return {
                followers: 0,
                loading: true
            }
        },
        mounted() {
            axios.get('/get-statistical').then( e => {
                this.chart(e.data.follower);
                this.loading = false;
                this.$store.commit('setData', e.data);
            });
        },
        methods: {
            chart(data){
                let value = data.sort((a, b) => {
                    return a.followers - b.followers;
                });

                let labels = value.map(e => e.date);
                let datas = value.map ( e => e.followers);

                const [max, min] = [
                    value[value.length - 1].followers, value[0].followers
                ]

                var a = {
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                            }
                        },
                        scales: {
                            responsive: !0,
                            maintainAspectRatio: !0,
                            yAxes: [{
                                display: !0,
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0.03)",
                                    drawBorder: !1
                                },
                                ticks: {
                                    min: 0,
                                    max: max,
                                    stepSize: 0,
                                    fontColor: "#212529",
                                    maxTicksLimit: 3,
                                    callback: function (a, e, r) {
                                        return a + " +"
                                    },
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                display: !1,
                                barPercentage: .3,
                                gridLines: {
                                    display: !1,
                                    drawBorder: !1
                                }
                            }]
                        },
                        legend: {
                            display: !1
                        }
                    },
                    e = document.getElementById("followers-bar-chart");
                new Chart(e, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Follower",
                            data: datas,
                            backgroundColor: [chartColors[0], chartColors[0], chartColors[0], chartColors[0], chartColors[0], chartColors[0]],
                            borderColor: chartColors[0],
                            borderWidth: 0
                        }]
                    },
                    options: a
                })
            }
        }
    }
</script>

<style scoped>

</style>
