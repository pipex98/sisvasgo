Vue.use(VueTables.ClientTable)

var purchasesDateMod = new Vue({
    el: '#purchases-date-mod',
    data() {
        return {
            baseUrl: '',
            csrf: '',
            startDate: '',
            endDate: '',
            deposits: [],
            columns: ['date','user','supplier','voucher','number','total_purchase','tax','state'],
            options: {
                headings: {
                    date: 'Fecha',
                    user: 'Usuario',
                    supplier: 'Proveedor',
                    voucher: 'Comprobante',
                    number: 'Numero',
                    total_purchase: 'Total Compra',
                    tax: 'Impuesto',
                    state: 'Estado'
                },
                sortable: ['date'],
                filterable: ['date','user'],
            },
        }
    },
    mounted() {
        this.baseUrl = this.$refs.purchasesdateapp.dataset.baseUrl
        this.csrf = this.$refs.purchasesdateapp.dataset.csrf
        this.setDatesInputs()
    },
    watch: {
        getDeposit(dates) {
            this.sendDates(dates)
        }
    },
    computed: {
        getDeposit() {
            return [this.startDate, this.endDate]   
        }
    },
    methods: {
        setDatesInputs() {
            this.startDate = moment().format('YYYY-MM-DD')
            this.endDate = moment().format('YYYY-MM-DD')
        },
        sendDates(dates) {
            const data = {
                'startDate': dates[0],
                'endDate': dates[1],
                '_csrf' : this.csrf
            }

            axios.post(this.baseUrl + '/reports/purchases-date', Qs.stringify(data), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => {
                this.deposits = response.data.purchases
            })
        }
    }
})