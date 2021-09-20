Vue.use(VueTables.ClientTable)
Vue.use(vuelidate.default)

var depositMod = new Vue({
    el: '#deposit-mod',
    data() {
        return {
            baseUrl: '',
            csrf: '',
            id: '',
            items: [],
            voucherTypes: [],
            supplierList: [],
            itemDetails: [],
            paginate: ['itemDetails'],
            supplierName: '',
            voucherName: '',
            deposit: {
                supplier_id: '',
                voucher_type_id: '',
                voucher_sequence: '',
                voucher_number: '',
                tax: 0,
            },
            columns: ['options','name', 'category', 'code', 'stock', 'image'],
            options: {
                headings: {
                    options: 'Opciones',
                    name: 'Nombre',
                    category: 'Categoría',
                    code: 'Codigo',
                    stock: 'Stock',
                    image: 'Imagen'
                },
                sortable: ['name','category'],
                filterable: ['name', 'category']
            },
        }
    },
    validations: {
        deposit : {
            supplier_id: {
                required: validators.required
            },
            voucher_type_id: {
                required: validators.required
            },
            voucher_sequence: {
                required: validators.required
            },
            voucher_number: {
                required: validators.required
            },
        }
    },
    mounted(){
        this.baseUrl = this.$refs.depositapp.dataset.baseUrl
        this.csrf = this.$refs.depositapp.dataset.csrf
        this.id = this.$refs.depositapp.dataset.modelId
        this.getItems()
        this.getVoucherTypes()
        this.getSupplierList()
        if (this.id) {
            this.getDeposit()
        }
    },
    watch: {
        setTax(type) {
            if (type == 2) {
                this.deposit.tax = 19
            } else {
                this.deposit.tax = 0
            }
        },
    },
    filters: {
        subtotal(item, tax) {
            const quantity = Number(item.quantity)
            const purchase_price = Number(item.purchase_price)                        
            return quantity * purchase_price + (purchase_price * tax / 100)
        }
    },
    computed: {
        setTax() {
            return this.deposit.voucher_type_id
        },
        calculateTotal() {
            
            let total = [];

            Object.entries(this.itemDetails).forEach(([key, val]) => {
                total.push(val.quantity * val.purchase_price + (val.purchase_price * this.deposit.tax / 100)) 
            });

            return total.reduce((total, num) =>{ 
                return total + num 
            }, 0)
        },
        validatePricesQuantity() {
            return this.itemDetails.every( item => 
                item.quantity > 0 
                && item.purchase_price > 0 
                && item.sale_price > 0
            )
        }
    },
    methods: {
        getItems() {
            axios.get(this.baseUrl + '/item/items-list')
            .then(response => {
                this.items = response.data
            })
        },
        getVoucherTypes() {
            axios.get(this.baseUrl + '/deposit/voucher-types')
            .then(response => {
                this.voucherTypes = response.data
            })
        },
        getSupplierList() {
            axios.get(this.baseUrl + '/person/supplier-list')
            .then(response => {
                this.supplierList = response.data
            })
        },
        getDeposit() {
            axios.get(this.baseUrl + `/deposit/details-list?id=${this.id}`,)
            .then(response => {
                this.itemDetails = response.data.itemDetails
                this.deposit = response.data.deposit
                this.supplierName = response.data.supplier_name
                this.voucherName = response.data.voucher_name
            })
        },
        existItem(itemId) {
            var index = this.itemDetails.map((el) => {
                return el.id
            }).indexOf(parseInt(itemId))
            if (index == -1) {
                return false
            } else {
                return true
            }
        },
        validateQuantity(item){
            if (item.quantity == '' || item.quantity == 0) {
                swal({
                    title: "Ops",
                    text: 'Porfavor ingrese una cantidad mayor a 0',
                    icon: "warning",
                });
                item.quantity = ''
            }
        },
        addDetails(item) {
            if (!this.existItem(item.id)) {
                var ObjectItem = Object.assign({}, item)
                this.itemDetails.push(ObjectItem)
            } else {
                swal({
                    title: "Ops",
                    text: 'El articulo ya fue seleccionado.',
                    icon: "warning",
                });
            }            
        },
        deleteDetails(index) {
            this.itemDetails.splice(index, 1)
        },
        subtotal() {
            return 1
        },
        saveDetail() {

            this.$v.deposit.$touch()

            if (!this.$v.$invalid) {

                var deposit = Object.assign({}, this.deposit)
                var itemsDetails = Object.assign({}, this.itemDetails)
    
                const data = {
                    'deposit': deposit,
                    'itemsDetails': itemsDetails,
                    'totalPurchase': this.calculateTotal,
                    '_csrf': this.csrf
                }
                
                axios.post(this.baseUrl + '/deposit/create', Qs.stringify(data), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-type': 'application/x-www-form-urlencoded'
                    },
                })
                .then(response => {
                    window.location.href = this.baseUrl + '/deposit/index';
                })
                
            }
        }
    }
});