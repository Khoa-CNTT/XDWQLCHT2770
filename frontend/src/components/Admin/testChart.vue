<template>
    <Bar
      id="my-chart-id"
      :options="chartOptions"
      :data="chartData"
    />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import baseRequest from '../../core/baseRequest';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: { Bar },
    data() {
        return {
            chartData: {
                labels: ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'],
                datasets: [
                    {
                        label: 'Doanh thu (VND)',
                        backgroundColor: '#132e63',
                        data: Array(12).fill(0)
                    }
                ]
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false, // Đảm bảo biểu đồ không bị lệch tỷ lệ
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Doanh thu (VND)'
                        },
                        ticks: {
                            stepSize: 10000 // Đặt bước cho trục y để dễ nhìn
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.fetchRevenueData();
    },
    methods: {
        async fetchRevenueData() {
            try {
                const response = await baseRequest.get('/admin/dashboard/12thang');
                const revenueData = response.data;

                // Kiểm tra dữ liệu
                if (Array.isArray(revenueData) && revenueData.length === 12) {
                    // Cập nhật toàn bộ chartData để đảm bảo reactive
                    this.chartData = {
                        ...this.chartData,
                        datasets: [
                            {
                                ...this.chartData.datasets[0],
                                data: revenueData
                            }
                        ]
                    };
                } else {
                    console.warn('Dữ liệu không hợp lệ, sử dụng giá trị mặc định 0', revenueData);
                    this.chartData = {
                        ...this.chartData,
                        datasets: [
                            {
                                ...this.chartData.datasets[0],
                                data: Array(12).fill(0)
                            }
                        ]
                    };
                }
            } catch (error) {
                console.error('Lấy dữ liệu doanh thu thất bại', error);
                this.chartData = {
                    ...this.chartData,
                    datasets: [
                        {
                            ...this.chartData.datasets[0],
                            data: Array(12).fill(0)
                        }
                    ]
                };
            }
        }
    }
}
</script>

<style scoped>
#my-chart-id {
    width: 100%;
    height: 400px; /* Chiều cao của biểu đồ */
}
  
</style>