var graph;

$(document).ready(function () {

    var d = new Date();
    var n = d.getFullYear();
    pembayaran_chart(n);

});

$("#tahun-pembayaran").change(function () {
    $.ajax({
        type: "POST",
        url: base_url + "administrator/chart_pembayaran",
        data: {
            tahun: $(this).val()
        },
        dataType: "json",
        success: function (response) {
            var ctx = document.getElementById("pembayaran_chart");
            graph.destroy();
            graph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.bulan,
                    datasets: [
                        {
                            label: '# Jumlah Pembayaran',
                            backgroundColor: "#26B99A",
                            data: response.value
                        }
                    ]
                },
            
                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            });
        }
    });
});

function pembayaran_chart(n) {
    $.ajax({
        type: "POST",
        url: base_url + "administrator/chart_pembayaran",
        data: {
            tahun: n
        },
        dataType: "json",
        success: function (response) {
            var ctx = document.getElementById("pembayaran_chart");
            graph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.bulan,
                    datasets: [
                        {
                            label: '# Jumlah Pembayaran',
                            backgroundColor: "#26B99A",
                            data: response.value
                        }, {
                            label: '# of Votes',
                            backgroundColor: "#03586A",
                            data: [200000, 300000, 250000, 400000, 550000, 500000, 650000, 800000]
                          }
                    ]
                },

                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: false
                                }
                            }
                        ]
                    }
                }
            });
        }
    });
}

