<script src="<?= base_url(); ?>assets/js/app.js"></script>

<!-- datatables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        $("table.table-data").DataTable({
            responsive: true,
            select: true,
            searching: true,
            paging: true,
            pagingType: "full_numbers",
            language: {
                searchPlaceholder: "Cari...",
                paginate: {
                    // first: "First",
                    // last: "Last",
                    // next: "Next",
                    // previous: "Previous",
                },
                lengthMenu: "_MENU_ Data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(filtered from _MAX_ Total data)",
            },
            lengthMenu: [
                [5, 10, 25, 50, 100, 200, -1],
                [5, 10, 25, 50, 100, 200, "All"],
            ],

        });
    });
</script>

<!-- chart -->

<!-- chart data pengambilan sampah -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("grafik-pengambilan-sampah").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart

        var labels = [];
        var data = [];

        <?php foreach ($sampah as $row) : ?>
            labels.push('<?= $row['tanggal'] ?>');
            data.push(<?= $row['count'] ?>);
        <?php endforeach; ?>
        new Chart(document.getElementById("grafik-pengambilan-sampah"), {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Jumlah pengmabilan dalam Kg",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: data
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
</script>

<!-- chart kategori sampah -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var labels = [];
        var data = [];
        var backgroundColors = [];

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        <?php foreach ($kategori_sampah as $row) : ?>
            labels.push('<?= $row->kategori ?>');
            data.push(<?= $row->total_jumlah ?>);
            backgroundColors.push(getRandomColor());
        <?php endforeach; ?>

        var ctx = document.getElementById("chartjs-dashboard-pie").getContext("2d");
        new Chart(ctx, {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
</script>

<!-- datepicker -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByClassName("datetimepicker");

        Array.prototype.forEach.call(elements, function(element) {
            var isFlatpickrActive = false;

            element.addEventListener("click", function() {
                if (isFlatpickrActive) {
                    element._flatpickr.destroy();
                    isFlatpickrActive = false;
                } else {
                    flatpickr(element, {
                        inline: true,
                        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                        nextArrow: "<span title=\"Next month\">&raquo;</span>",
                        defaultDate: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000)
                    });
                    isFlatpickrActive = true;
                }
            });
        });
    });
</script>