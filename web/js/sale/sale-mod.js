Vue.use(VueTables.ClientTable)
Vue.use(vuelidate.default)
Vue.component('vue-html-to-paper', VueHtmlToPaper);

const options = {
  name: '_blank',
  specs: ['fullscreen=yes', 'titlebar=yes', 'scrollbars=no'],
  styles: [
    'http://localhost/sisvasgo/web/css/bootstrap.min.css',
    'http://localhost/sisvasgo/web/css/site.css',
  ],
};
Vue.use(VueHtmlToPaper, options);

var saleMod = new Vue({
    el: '#sale-mod',
    data() {
        return {
            id: '',
            baseUrl: '',
            csrf: '',
            items: [],
            clientList: [],
            voucherTypes: [],
            itemDetails: [],
            clientName: '',
            voucherName: '',
            paginate: ['itemDetails'],
            sale: {
                client_id: '',
                voucher_type_id: '',
                voucher_sequence: '',
                voucher_number: '',
                tax: 0
            },
            columns: ['options','item_name', 'item_category', 'item_code', 
            'item_stock','sale_price','item_image'],
            options: {
                headings: {
                    options: 'Opciones',
                    item_name: 'Nombre',
                    item_category: 'Categoría',
                    item_code: 'Codigo',
                    item_stock: 'Stock',
                    sale_price: 'Precio Venta',
                    item_image: 'Imagen'
                },
                sortable: ['item_name','item_category'],
                filterable: ['item_name', 'item_category']
            }
        }
    },
    validations: {
        sale: {
            client_id: {
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
    filters: {
        subtotal(item) {
            const sale_price = Number(item.sale_price)
            const quantity = Number(item.quantity)
            const discount = Number(item.discount) || 0
            return sale_price * quantity - (sale_price * quantity * discount / 100)
        }
    },
    mounted() {
        this.baseUrl = this.$refs.saleapp.dataset.baseUrl
        this.csrf = this.$refs.saleapp.dataset.csrf
        this.id = this.$refs.saleapp.dataset.modelId
        this.getItemsSaleActive()
        this.getClientList()
        this.getVoucherTypes()
        if (this.id) {
            this.getSale()
            setTimeout(() => {
                this.print()
            }, 4000);
        }
    },
    watch: {
        setTax(type) {
            if (type == 2) {
                this.sale.tax = 19 
            } else {
                this.sale.tax = 0
            }
        },
    },
    computed: {
        setTax() {
            return this.sale.voucher_type_id
        },
        calculateTotal() {
            
            let total = [];

            Object.entries(this.itemDetails).forEach(([key, val]) => {
                total.push(val.sale_price * val.quantity - 
                    (val.sale_price * val.quantity 
                    * (val.discount || 0) / 100
                    )) 
            });

            return total.reduce((total, num) =>{ 
                return total + num 
            }, 0)
        },
        validateQuantity() {
            return this.itemDetails.every(item => item.quantity > 0)
        }
    },
    methods: {
        getItemsSaleActive() {
            axios.get(this.baseUrl + '/sale/items-sale-active')
            .then(response => {
                this.items = response.data
            })
        },
        getClientList() {
            axios.get(this.baseUrl + '/person/client-list')
            .then(response => {
                this.clientList = response.data
            })
        },
        getVoucherTypes() {
            axios.get(this.baseUrl + '/deposit/voucher-types')
            .then(response => {
                this.voucherTypes = response.data
            })
        },
        getSale() {
            axios.get(this.baseUrl + `/sale/details-list?id=${this.id}`)
            .then(response => {
                this.itemDetails = response.data.itemDetails
                this.sale = response.data.sale
                this.clientName = response.data.client_name
                this.voucherName = response.data.voucher_name
            })
        },
        existItem(itemId) {
            var index = this.itemDetails.map((el) => {
                return el.item_id
            }).indexOf(parseInt(itemId))
            if (index == -1) {
                return false
            } else {
                return true
            }
        },
        addDetails(item) {
            if (!this.existItem(item.item_id)) {
                var ObjectItem = Object.assign({}, item)
                this.itemDetails.push(ObjectItem)
            } else {
                swal({
                    title: "Ops",
                    text: 'El articulo ya fue seleccionado.',
                    icon: "warning",
                })
            }    
        },
        deleteDetails(index) {
            this.itemDetails.splice(index, 1)
        },
        validateStock(item) {
            var index = this.items.map((el) => {
                return el.item_id
            }).indexOf(parseInt(item.item_id))

            if (item.quantity == '' || item.quantity == 0) {
                swal({
                    title: "Ops",
                    text: 'Porfavor ingrese una cantidad mayor a 0',
                    icon: "warning",
                });
                item.quantity = ''

            } else {
                
                if (item.quantity > this.items[index].item_stock) {
                    swal({
                        title: "Ops",
                        icon: "warning",
                        text: `La cantidad ingresada es mayor que el stock disponible (${this.items[index].item_stock}). \n\n Por favor ingrese de nuevo la cantidad`,
                    })
                    item.quantity = ''
    
                    if (this.items[index].item_stock == 0) {
                        swal({
                            title: "Ops",
                            icon: "warning",
                            text: `El stock disponible esta en (${this.items[index].item_stock}). \n\n Por favor abastecer el producto`,
                        })
                        item.quantity = ''
                    }
                }
            }
            
        },
        print() {
            this.$htmlToPaper('sale-mod');
        },
        saveDetail() {

            this.$v.sale.$touch()

            if (!this.$v.$invalid) {
                
                var sale = Object.assign({}, this.sale)
                var itemDetails = Object.assign({}, this.itemDetails)
    
                const data = {
                    'sale' : sale,
                    'itemsDetails' : itemDetails,
                    'totalSale' : this.calculateTotal,
                    '_csrf': this.csrf
                }
    
                axios.post(this.baseUrl + '/sale/create', Qs.stringify(data), {
                    headers : {
                        'X-Requested-With' : 'XMLHttpRequest',
                        'Content-Type' : 'application/x-www-form-urlencoded' 
                    }
                })
                .then(response => {
                    window.location.href = this.baseUrl + '/sale/index'
                })

            }
        }
    }
});