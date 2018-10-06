var graph;

$(document).ready(function () {

    var d = new Date();
    var n = d.getFullYear();
    penjualan_chart(n);
    produk_chart(n);

});

$("#tahun-penjualan").change(function () {
    $.ajax({
        type: "POST",
        url: base_url + "panel/chart_penjualan",
        data: {
            tahun: $(this).val()
        },
        dataType: "json",
        success: function (response) {
            var ctx = document.getElementById("penjualan_chart");
            graph.destroy();
            graph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.bulan,
                    datasets: [
                        {
                            label: '# Jumlah penjualan',
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

function produk_chart(n) {
    $.ajax({
        type: "POST",
        url: base_url + "panel/chart_produk",
        data: {
            tahun: n
        },
        dataType: "json",
        success: function (response) {
            console.log(response.tabel);
            
            var chart_doughnut_settings = {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: response.label,
                    datasets: [
                        {
                            data: response.value,
                            backgroundColor: response.bc,
                            hoverBackgroundColor: response.hc
                        }
                    ]
                },
                options: {
                    legend: true,
                    responsive: false
                }
            }

            $('.produk-chart').each(function () {

                var chart_element = $(this);
                var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

            });
            $(".tile_info").html(response.tabel);
        }
    });

}

function penjualan_chart(n) {
    $.ajax({
        type: "POST",
        url: base_url + "panel/chart_penjualan",
        data: {
            tahun: n
        },
        dataType: "json",
        success: function (response) {
            var ctx = document.getElementById("penjualan_chart");
            graph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.bulan,
                    datasets: [
                        {
                            label: '# Jumlah penjualan',
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

$("#tahun-produk").change(function () {
    $.ajax({
        type: "POST",
        url: base_url + "panel/chart_produk",
        data: {
            tahun: $(this).val()
        },
        dataType: "json",
        success: function (response) {
            console.log(response.tabel);
            
            var chart_doughnut_settings = {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: response.label,
                    datasets: [
                        {
                            data: response.value,
                            backgroundColor: response.bc,
                            hoverBackgroundColor: response.hc
                        }
                    ]
                },
                options: {
                    legend: true,
                    responsive: false
                }
            }

            $('.produk-chart').each(function () {

                var chart_element = $(this);
                var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

            });
            $(".tile_info").html(response.tabel);
        }
    });
})