<x-admin.layout>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Published Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Author count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $authorCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tags Most Used</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="tagsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script type="text/javascript">
            const tagsChart = new Chart(document.getElementById('tagsChart'), {
                type: "doughnut",
                data: {
                    labels: {{ Js::from(array_keys($postTagCount)) }},
                    datasets: [
                        {
                            data: {{ Js::from(array_values($postTagCount)) }},
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }
                    ],
                },
                options: {
                    plugins: {
                        legend: {
                            position: "bottom",
                            labels: {
                                pointStyle: 'circle',
                                usePointStyle: true
                            }
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    cutoutPercentage: 80,
                }
            })
        </script>
    </x-slot>
</x-admin.layout>
