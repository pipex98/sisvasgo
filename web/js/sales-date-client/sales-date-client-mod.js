Vue.use(VueTables.ClientTable)

var salesDateClientMod = new Vue({
    el: '#sales-date-client-mod',
    data() {
        return {
            baseUrl: '',
            csrf: '',
            startDate: '',
            endDate: '',
            clientId: '',
            clientList: '',
            sales: [],
            columns: ['date','user','client','voucher','number','total_sale','tax','state'],
            options: {
                headings: {
                    date: 'Fecha',
                    user: 'Usuario',
                    supplier: 'Cliente',
                    voucher: 'Comprobante',
                    number: 'Numero',
                    total_sale: 'Total Venta',
                    tax: 'Impuesto',
                    state: 'Estado'
                },
                sortable: ['date'],
                filterable: ['date','user'],
            },
        }
    },
    mounted() {
        this.baseUrl = this.$refs.salesdatesclientapp.dataset.baseUrl
        this.csrf = this.$refs.salesdatesclientapp.dataset.csrf
        this.setDatesInputs()
        this.getClientList()
    },
    watch: {
        getDeposit(dates) {
            this.sendDates(dates)
        }
    },
    computed: {
        getDeposit() {
            return [this.startDate, this.endDate, this.clientId]   
        }
    },
    methods: {
        getClientList() {
            axios.get(this.baseUrl + '/reports/client-list')
            .then(response => {
                this.clientList = response.data
            })
        },
        setDatesInputs() {
            this.startDate = moment().format('YYYY-MM-DD')
            this.endDate = moment().format('YYYY-MM-DD')
        },
        sendDates(dates) {
            const data = {
                'startDate': dates[0],
                'endDate': dates[1],
                'clientId': dates[2],
                '_csrf' : this.csrf
            }

            axios.post(this.baseUrl + '/reports/sales-date-client', Qs.stringify(data), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => {
                this.sales = response.data.sales
            })
        }
    }
})