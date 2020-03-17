<template>
 <div class="container">
     <div class="row">
        <div class="col-lg-12 text-center">
            <h2>ТОВАРЫ</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><strong>Список товаров</strong></div>
                <div class="panel-body text-center">  
                    <table class="table" id="products-tbl">
                        <thead>
                            <tr>
                                <th class="text-center col-md-2">ID товара</th>
                                <th class="text-center col-md-5">Наименование товара</th>
                                <th class="text-center col-md-3">Поставщик</th>
                                <th class="text-center col-md-2">Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products" :key="product.id">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td>{{product.vendor.name}}</td>
                                <td @click="selectEditor(index, product.id, product.price)">
                                    <div class="input-group" v-show="product.id == editingPriceId">
                                        <span class="input-group-addon inline-control" @click.stop="editingPriceId = 0" aria-hidden="true">&times;</span>
                                        <input class="form-control" :ref="'editor'+index" type="text" v-model="editingPriceValue" />
                                        <span class="input-group-addon inline-control" @click.stop="savePriceValue(index, product.id)" aria-hidden="true">&or;</span>
                                    </div>
                                    <div v-show="product.id != editingPriceId">{{product.price}}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul v-if="page_count > 1" class="pagination">
                        <li v-bind:class="{'disabled': (current_page == 1)}"><a @click.stop="toPage(current_page-1)">&laquo;</a></li>
                        <li v-bind:class="{'active': (current_page == n)}" v-for="n in page_count" :key="n"> <a @click.stop="toPage(n)">{{n}}</a></li>
                        <li v-bind:class="{'disabled': (current_page == page_count)}"><a @click.stop="toPage(current_page+1)">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
 </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                products: [],
                page_count: 0,
                current_page: 1,
                editingPriceId: 0,
                editingPriceValue: 0
            }
        },
        methods: {
            async savePriceValue(index, id) {
                //console.log(id)
                try {
                    await axios.put(`/products/update/${id}`, {'price': this.editingPriceValue})
                    this.products[index].price = this.editingPriceValue
                    this.editingPriceId = 0
                } catch (e) {
                    console.error(e)
                    alert('Не удалось сохранить данные!')
                }
            },
            selectEditor(index, id, price){
                this.editingPriceId =  id
                this.editingPriceValue = price
                
                this.$nextTick(function () {
                    this.$refs['editor'+index][0].focus()
                })
            },
            toPage(n){
                if (n > this.page_count || n < 1) return
                (async () => {
                try {
                    if (n > this.page_count) n = page_count
                    if (n < 1) n = 1
                    await this.getProductList(n)  
                    this.current_page = n  
                } catch (e) {
                    console.log(e)
                }
            })()      
            },
            async getProductList(page) {
                try {
                    const response = await axios.get(`/products/page/${page}`);
                    this.products = [];
                    this.products = response.data.products
                    this.page_count = response.data.page_count
                    //console.log(response);
                } catch (e) {
                    console.error(e)
                    alert('Ошибка при загрузке данных с сервера!')
                }
            },
            is_empty(value) {
                return ( value === "" || value === 0 || value === null || value === false || value === undefined || ( Array.isArray(value) && value.length === 0 ) || (Object.keys(value).length === 0 && value.constructor === Object));
            },
            
        },
        
        mounted() {
            (async () => {
                try {
                    await this.getProductList(this.current_page)    
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').attributes.content.value
                    //console.log(axios.defaults.headers.common['X-CSRF-TOKEN'])
                } catch (e) {
                    console.log(e)
                }
            })()    
        }
    }
</script>

<style>
.pagination a {
    cursor: pointer;
}  
#products-tbl tr{
    height: 55px;
}
.inline-control:hover {
    background-color: #c7e7f7;
    cursor: pointer;
}
</style>