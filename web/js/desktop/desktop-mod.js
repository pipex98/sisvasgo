var desktopMod = new Vue({
    el: '#desktop-mod',
    data() {
        return {
            baseUrl: '',
            totalPurchase: '', // para mostrar el total de las compras
            totalSale: '', // para mostrar el total de las ventas
            datesPurchasesLabels: [], // para mostrar las fechas de las compras
            totalsPurchases: [],
            monthsSalesLabels: [],
            totalsSales: [],
            loadedPurchase: false, // para indicar cuando cargar los graficos de las compras
            loadedSale: false, // para indicar cuando cargar los graficos de las venta
            purchasesChartData: null,
            salesChartData: null,
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      },
                    }]
                }
            }
        }
    },
    mounted() {
        this.baseUrl = this.$refs.desktopapp.dataset.baseUrl
        this.getTotalPurchase()
        this.getTotalSale()
        this.getPurchases()
        this.getSales()
    },
    methods: {
        getPurchases() {
            axios.get(this.baseUrl + '/site/purchases-last-ten-days')
            .then(response => {
                this.datesPurchasesLabels = response.data.datesPurchases
                this.totalsPurchases = response.data.totalsPurchases
                this.loadedPurchase = true 
                this.fillPurchaseData() // mostramos el grafico cuando la data ya esta cargada
            })
        },
        getSales() {
            axios.get(this.baseUrl + '/site/sales-last-twelve-months')
            .then(response => {
                this.monthsSalesLabels = response.data.monthsSales
                this.totalsSales = response.data.totalsSales
                this.loadedSale = true
                this.fillSaleData() // mostramos el grafico cuando la data ya esta cargada
            })
        },
        getTotalPurchase() {
            axios.get(this.baseUrl + '/site/total-purchase-today')
            .then(response => {
                this.totalPurchase = parseInt(response.data.total_purchase)
            })
        },
        getTotalSale() {
            axios.get(this.baseUrl + '/site/total-sale-today')
            .then(response => {
                this.totalSale = parseInt(response.data.total_sale)
            })
        },
        fillPurchaseData() {
            this.purchasesChartData = {
                labels: this.datesPurchasesLabels,
                datasets: [{
                    label: this.datesPurchasesLabels,
                    backgroundColor: '#f87979',
                    data: this.totalsPurchases
                }]
            }
        },
        fillSaleData() {
            this.salesChartData = {
                labels: this.monthsSalesLabels,
                datasets: [{
                    label: this.monthsSalesLabels,
                    backgroundColor: '#f4f4f4',
                    data: this.totalsSales
                }]
            }
        },
    }
})
