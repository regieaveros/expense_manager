<template>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="pl-lg-5 ml-lg-5 mb-lg-4 mb-0">
                <table v-if="compute_amounts.length != 0" class="table table-borderless text-md-center text-left">
                    <thead>
                        <tr>
                            <th>Expense Categories</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="compute_amount in this.compute_amounts" :key="compute_amount.id">
                            <td>{{ compute_amount.category_name }}</td>
                            <td>&dollar;{{ compute_amount.total_amount }}</td>
                        </tr>
                    </tbody>
                </table>
                <table v-else class="table table-borderless text-md-center text-left">
                    <thead>
                        <tr>
                            <th>Expense Categories</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NA</td>
                            <td>NA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-7">
            <div class="pr-lg-5 mr-lg-5">
                <canvas id="donutChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['compute_amounts'],
        mounted() {
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            const labels = this.compute_amounts.map(item => item.category_name);
            const data = this.compute_amounts.map(item => item.total_amount);

            const backgroundColors = [
                '#f56954', 
                '#00a65a', 
                '#9beb34', 
                '#34eb6e', 
                '#34ebd6',
                '#3468eb',
                '#0b1c47',
                '#56699c',
                '#7145ad',
                '#69304b',
            ];

            const donutData = {
                labels: labels,
                datasets: [
                    {
                        data: data,
                        backgroundColor: backgroundColors.slice(0, labels.length),
                    }
                ]
            };

            var donutOptions = {
                maintainAspectRatio : false,
                responsive : true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'center',
                        fullSize: true,
                    }
                },
            }

            new Chart(donutChartCanvas, {
                type: 'pie',
                data: donutData,
                options: donutOptions
            });

        }
    }
</script>
