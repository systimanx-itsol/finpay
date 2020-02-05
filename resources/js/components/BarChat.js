
import { Bar, mixins } from "vue-chartjs";

// Vue.component('BarChart', {
export default {
    extends: Bar,
    props: ["data", "options"],
    data: function () {
        return {
            datacollection: {
                labels: [],
                datasets: [

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return '$' + tooltipItems.yLabel;
                        }

                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                height: 200
            }
        }
    },
    mounted() {
        // this.chartData is created in the mixin
        this.getdetails();

    },
    methods: {
        getdetails() {
            let url = "/getDashboard";
            axios.get(url).then(response => {
                if (response) {
                    this.datacollection.labels = response.data.month;


                    this.datacollection.datasets = [


                        {
                            label: 'Data One',
                            backgroundColor: '#F87979',
                            pointBackgroundColor: 'white',
                            borderWidth: 1,
                            pointBorderColor: '#249EBF',
                            data: response.data.total,
                        }
                    ];

                    console.log(response.data.total, 'datacollectiondatacollectiondatacollection');
                    this.renderChart(this.datacollection, this.options)
                }
            });
        }
    }
}