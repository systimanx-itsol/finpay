<template>
   <section class="hero is-fullheight is-default is-bold">
      <layout-header></layout-header>
      <form id="app" @submit.prevent="handleSubmit">
         <div class="container breadcrums1">
            <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Products</h6>
            <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
               <ul>
                  <li class="is-size-7">
                     <a class="has-text-grey" href="#">Pages</a>
                  </li>
                  <li class="is-size-7">
                     <a class="has-text-grey" href="#">Products</a>
                  </li>
                  <li class="is-size-7 is-active">
                     <a class="" href="#" aria-current="page">Product</a>
                  </li>
               </ul>
            </nav>
         </div>
         <section class="container forms-sec has-background-white	box">
            <div class="columns is-multiline is-mobile">
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Category <span class="has-text-danger	">*</span></label>
                  <div class="field has-addons">
                     <div class="control is-expanded">
                        <div class="select is-fullwidth">
                           <select id="category_id" name="category_id"  v-model="product.category_id" v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has('category_id') }">
                              <option v-for="cat in category" :key="cat.id"  v-bind:value="cat.id">
                                 {{cat.name}} 
                              </option>
                           </select>
                           <span v-show="errors.has('category_id')" class="invalid-feedback">{{category_idError}}</span>
                        </div>
                     </div>
                  </div>
                  </p>
               </div>
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Product Name <span class="has-text-danger">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input id="product_name" class="input" name="product_name" v-model="product.product_name" type="text" placeholder=" Product Name "  v-validate="'required'"
                           :class="{ 'is-invalid': submitted && errors.has('product_name') }" >
                     </p>
                     <span v-show="errors.has('product_name')" class="invalid-feedback">{{product_nameError}}</span>
                  </div>
                  </p>
               </div>
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Display Name 
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input id="display_name" class="input" name="display_name" disabled v-model="product.display_name" type="text"  placeholder=" Display Name" >
                     </p>
                  </div>
                  </p>
               </div>
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Tax Rate <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field has-addons">
                     <div class="control is-expanded">
                        <div class="select is-fullwidth">
                           <select id="tax_rate_id" name="tax_rate_id"  v-model="product.tax_rate_id"  v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has(' tax_rate_id') }">
                              <option disabled value="selected" selected="selected"></option>
                              <option v-for="tax_rate in tax" :key="tax_rate.id" v-bind:value="tax_rate.id">
                                 {{tax_rate.percentage}}
                              </option>
                           </select>
                           <span v-show="errors.has('tax_rate_id')" class="invalid-feedback">{{tax_rate_idError}}</span>
                        </div>
                     </div>
                  </div>
                  </p>
               </div>
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Short Description
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <textarea id="description" placeholder="Description" name="description" class="textarea is-small is-shadowless" v-model="product.description"  v-validate="'required'"
                           :class="{ 'is-invalid': submitted && errors.has('description') }" ></textarea>                              
                     </p>
                     <span v-show="errors.has('description')" class="invalid-feedback">{{descriptionError}}</span>
                  </div>
                  </p>
                  <!-- <p class="bd-notification is-info">
                     <label>Slug 
                     </label>
                     <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input  id="slug" class="input" name="slug" type="text" placeholder="Slug" v-model="product.slug" >
                     </p>
                     </div>
                     </p> -->
               </div>
               <div class="column is-3 is-12-mobile">
                  <p class="bd-notification is-info">
                     <label>Status <span class="has-text-danger">*</span>
                     </label>
                  <div class="field has-addons">
                     <div class="control is-expanded">
                        <div class="select is-fullwidth">
                           <select id="status" name="status"  v-model="product.status" :default="0" v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has(' status') }">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                           </select>
                           <span v-show="errors.has('status')" class="invalid-feedback">{{statusError}}</span>
                        </div>
                     </div>
                  </div>
                  </p>
                  <div  class="has-text-right	 is-full">
                     <div id="button">
                        <button type="button" class="button is-dark  is-small delete-row"  style="margin-left:75%;" @click="addCurrent(index)" :disabled="this.editMode==true">Add a row</button>
                     </div>
                  </div>
               </div>
            </div>
            <div v-if="editMode === true" class="columns addandremove"  v-for="(el,index) in arr" :key="index" >
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Price
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input class="input" id="price" type="text" v-validate="'required'" v-model="el.price" name="price" placeholder="Price">
                     </p>
                  </div>
                  </p>
                  <span v-show="errors.has('price')" class="invalid-feedback">{{priceError}}</span>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Weight
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input class="input" price="weight" type="text"  v-validate="'required'" v-model="el.weight" name="weight" placeholder=" Weight ">
                     </p>
                  </div>
                  </p>
                  <span v-show="errors.has('weight')" class="invalid-feedback">{{weightError}}</span>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Unit
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <b-autocomplete
                        id="unit"
                        name="unit"
                        v-model="el.unit"
                        field="title"
                        @typing="getAsyncData(index)"
                        v-validate="'required|alpha_spaces'"
                        :key="product.index" 
                        :class="{ 'is-invalid': submitted && errors.has('unit') }"
                        :data="filteredDataArray"
                        placeholder="unit"
                        icon="magnify">
                        <template slot="empty">No results found</template>
                     </b-autocomplete>
                  </div>
                  </p>
                  <!-- <span v-show="errors.has('unit')" class="invalid-feedback">{{unitError}}</span> -->
               </div>
               <div class="column">
                  <p class="bd-notification is-info singleimages">
                     <label>Image
                     <span class="has-text-danger	">*</span>
                     </label>
                     <b-field class="file">
                        <b-upload id="image" accept="image/*" v-model="el.image" ref="file" name="image" >
                           <a class="button is-dark">
                           <span><i class="fas fa-upload"></i>Click to upload</span>
                           </a>
                        </b-upload>
                        <span class="image-name" v-if="el.image">
                        {{el.image.name }}
                        </span>
                     </b-field>
                  </p>
                  <!-- <span v-show="errors.has('image')" class="invalid-feedback">{{imageError}}</span> -->
               </div>
               <div>   
                  <img v-if="image != ''" v-bind:src="image" style="width:100px">
               </div>
               <!-- <pre>{{ $data | json }}</pre> -->
            </div>
            <div v-else class="columns addandremove">
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Price
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input class="input" id="price" type="text" v-model="el.price" name="price"   pattern="[0-9]+"  title="number only allowed" placeholder=" Price " v-validate="'required|numeric'">
                     </p>
                  </div>
                  <span v-if="arr.length-1 == index" v-show="errors.has('price')" class="invalid-feedback">{{priceError}}</span>
                  </p>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Weight
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input class="input" id="weight" type="text" maxlength="5"   pattern="[0-9]+" title="number only allowed" v-model="el.weight" name="weight" placeholder=" Weight " v-validate="'required|numeric'">
                     </p>
                     <span v-if="arr.length-1 == index" v-show="errors.has('weight')" class="invalid-feedback">{{weightError}}</span>
                  </div>
                  </p>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Unit
                     <span class="has-text-danger	">*</span>
                     </label>
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <b-autocomplete
                           id="unit"
                           name="unit"
                           v-model="el.unit"
                           field="title"
                           @typing="getAsyncData(index)"
                           :key="product.index" 
                           v-validate="'required|alpha_spaces'"
                           :class="{ 'is-invalid': submitted && errors.has('unit') }"
                           :data="filteredDataArray"
                           placeholder="unit"
                           icon="magnify">
                           <template slot="empty">No results found</template>
                        </b-autocomplete>
                     </p>
                     <span v-if="arr.length-1 == index" v-show="errors.has('unit')" class="invalid-feedback">{{unitError}}</span>
                  </div>
                  </p>
               </div>
               <div class="column">
                  <p class="bd-notification is-info singleimages">
                     <label>Image
                     <span class="has-text-danger	">*</span>
                     </label>
                     <b-field class="file">
                        <b-upload id="image" accept="image/*" v-model="el.image" ref="file"  name="image" >
                           <a class="button is-dark">
                           <span><i class="fas fa-upload"></i>Click to upload</span>
                           </a>
                        </b-upload>
                        <span class="image-name" v-if="el.image">
                        {{el.image.name }}
                        </span>
                     </b-field>
                  </p>
                  <span v-show="errors.has('image')" class="invalid-feedback">{{imageError}}</span>
               </div>
               <div>   
                  <img v-if="image != ''" v-bind:src="image" style="width:100px">
               </div>
               <div class="colms"  v-if="index != 0" >
                  <button1 class="delete  is-small delete-row"
                     type="btn btn-success" 
                     @click="data='';deleteFiles(index)" >
                  </button1>
               </div>
            </div>
            <button type="submit" class="button is-dark is-pulled-right is-small"  
               >Submit</button>
            <button type="button" class="button has-background-light is-small is-pulled-right clearbuton" @click="resetform">Clear</button>
         </section>
         <layout-footer></layout-footer>
      </form>
   </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import {
    Validator
} from "vee-validate";
var productIndex = -1;
export default {
    components: {
        LayoutHeader,
        LayoutFooter
    },

    data() {
        return {
            selectedunit: [],
            image: '',
            index: 0,
            submitted: false,
            product: {
                category_id: "",
                product_name: "",
                display_name: "",
                description: "",
                slug: "",
                tax_rate_id: "",
                status: 1,
            },
            arr: [{
                price: '',
                weight: '',
                unit: '',
                image: ''
            }],
            category: [],
            events: [],
            tax: [],
            categoryId: '',
            editMode: false,
            validalphaspaces: "Only charecters allowed",
            validname: "Field is required",
            numbervalid: "Only numbers allowed",
            data: [],
        }
    },

    computed: {
          ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

        product_nameError() {

            if (this.product.product_name == "")
                return this.validname
        },

        category_idError() {
            if (this.product.category_id == "")
                return this.validname
            else
                return this.validalphaspaces
        },

        descriptionError() {
            if (this.product.description == "")
                return this.validname

        },

        tax_rate_idError() {
            if (this.product.tax_rate_id == "")
                return this.validname
            else
                return this.validalphaspaces
        },

        statusError() {
            if (this.product.status == "")
                return this.validname
            else
                return this.validalphaspaces
        },

        priceError() {
            if (this.arr.price == "")
                return this.numbervalid
            else
                return this.validname
        },

        weightError() {
            if (this.arr.weight == "")
                return this.validname
            else
                return this.validname
        },

        unitError() {
            if (this.arr.unit == "")
                return this.validname
            else
                return this.validname
        },

        filteredDataArray() {
            if (this.data != null && this.data != "") {
                let temp_data = '';
                temp_data = this.data.filter((option) => {
                    return option
                        .toString()
                        .toLowerCase()
                        .indexOf(this.arr[this.index].unit.toLowerCase()) >= 0
                })
                let selected_item = this.selectedunit
                temp_data = temp_data.filter(function(option) {
                    return !selected_item.includes(option);
                })
                this.products_store = temp_data;
                return (this.products_store);
            }
        }
    },

    mounted: function() {
        this.gettax();
        if (this.$route.query.id != '' && this.$route.query.id != null) {

            this.getproduct();
            this.editMode = true;
        }
        this.getCategory();
    },

    methods: {
 ...mapActions({
      setLoading: "setLoading"
    }),
        resetform() {
            this.product = {
                category_id: "",
                product_name: "",
                display_name: "",
                description: "",
                slug: "",
                tax_rate_id: "",
                status: "",
            }
            this.arr[0] = {
                price: "",
                weight: "",
                unit: "",
                image: "",
            }
        },

        handleSubmit() {
            let context = this;
              context.setLoading(true);
            
            if (context.$route.query.id != '' && context.$route.query.id != null) {
                context.product.price = context.arr[0].price;
                context.product.weight = context.arr[0].weight;
                context.product.unit = context.arr[0].unit;
                context.product.image = context.arr[0].image;
                context.editMode = true;
                context.$validator.validate().then(valid => {
                    if (valid) {
                        let uri = '/Product/' + context.$route.query.id;
                        let config = {
                            headers: {
                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                'content-type': 'multipart/form-data',
                                'content-type': 'application/json'
                            }
                        }
                        let formdata = new FormData();
                        if (context.editMode === false) {
                            context.response = process.env.MIX_PRODUCT_ADD_RESPONSE;
                            if (context.arr) {
                                for (let price in context.arr) {
                                    formdata.append('price[]', context.arr[price].price);
                                }
                                for (let weight in context.arr) {
                                    formdata.append('weight[]', context.arr[weight].weight);
                                }
                                for (let unit in context.arr) {
                                    formdata.append('unit[]', context.arr[unit].unit);
                                }
                                for (let image in context.arr) {
                                    formdata.append('image[]', context.arr[image].image);
                                }
                            }
                        } else if (context.editMode === true) {
                            context.product.id = context.$route.query.id;
                            context.response = process.env.MIX_PRODUCT_UPDATE_RESPONSE;
                            formdata.append('image', context.product.image);
                            formdata.append('price', context.product.price);
                            formdata.append('weight', context.product.weight);
                            formdata.append('unit', context.product.unit);
                        }
                        if (context.product.relatedProduct) {
                            for (let product in context.product.relatedProduct) {
                                formdata.append('relatedProductId[]', context.product.relatedProduct[product].code);
                            }
                        }
                        formdata.append('category_id', context.product.category_id);
                        formdata.append('product_name', context.product.product_name);
                        formdata.append('display_name', context.product.display_name);
                        formdata.append('description', context.product.description);
                        formdata.append('slug', context.product.slug);
                        formdata.append(' tax_rate_id', context.product.tax_rate_id);
                        formdata.append('status', context.product.status);
                        axios.post(uri, formdata, config).then(response => {
                               
                                if (response.data.status == 1) {
                                    context.$buefy.toast.open({
                                        duration: 4000,
                                        message: response.data.message,
                                        position: "is-top-right",
                                        type: "is-success"
                                    });
                                    context.$router.push('/Producttable');
                                } else {
                                    context.$buefy.toast.open({
                                        duration: 4000,
                                        message: response.data.message,
                                        type: "is-danger",
                                        position: "is-top-right"
                                    });
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })
                             .finally(() => {
                                context.setLoading(false);
                       });
                    }else{
                     context.setLoading(false);
                    }
                });
            } else {
                 context.setLoading(true);
                context.submitted = true;
                context.$validator.validate().then(valid => {
                    if (valid) {
                        if (context.arr) {
                            for (let price in context.arr) {
                                if (context.editMode == false && context.arr[price].image == '') {
                                    context.$buefy.toast.open({
                                        duration: 4000,
                                        message: "Please Select Image " + (+price + 1),
                                        position: "is-top-right",
                                        type: "is-danger"
                                    });
                                    return;
                                }else{
                                 context.setLoading(false);
                                }
                            }
                        }
                        let url = '/Product';
                        let config = {
                            headers: {
                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                'content-type': 'multipart/form-data',
                                'content-type': 'application/json'
                            }
                        }
                        let formdata = new FormData();
                        if (context.editMode === false) {
                            context.response = process.env.MIX_PRODUCT_ADD_RESPONSE;
                            if (context.arr) {

                                for (let price in context.arr) {
                                    formdata.append('price[]', context.arr[price].price);
                                }
                                for (let weight in context.arr) {
                                    formdata.append('weight[]', context.arr[weight].weight);
                                }
                                for (let unit in context.arr) {
                                    formdata.append('unit[]', context.arr[unit].unit);
                                }
                                for (let image in context.arr) {
                                    formdata.append('image[]', context.arr[image].image);


                                }
                            }

                        } else if (context.editMode === true) {

                            context.product.id = context.$route.query.id;
                            context.response = process.env.MIX_PRODUCT_UPDATE_RESPONSE;
                            formdata.append('image', context.product.image);
                            formdata.append('price', context.product.price);
                            formdata.append('weight', context.product.weight);
                            formdata.append('unit', context.product.unit);
                        }
                        if (context.product.relatedProduct) {
                            for (let product in context.product.relatedProduct) {
                                formdata.append('relatedProductId[]', context.product.relatedProduct[product].code);
                            }
                        }
                        formdata.append('category_id', context.product.category_id);
                        formdata.append('product_name', context.product.product_name);
                        formdata.append('display_name', context.product.display_name);
                        formdata.append('description', context.product.description);
                        formdata.append('slug', context.product.slug);
                        formdata.append('tax_rate_id', context.product.tax_rate_id);
                        formdata.append('status', context.product.status);

                        axios.post(url, formdata, config).then(response => {
                                if (response.data.status == 1) {

                                    context.$buefy.toast.open({
                                        duration: 4000,
                                        message: response.data.message,
                                        position: "is-top-right",
                                        type: "is-success"
                                    });
                                    context.$router.push('/Producttable');
                                } else {
                                    context.$buefy.toast.open({
                                        duration: 4000,
                                        message: response.data.message,
                                        type: "is-danger",
                                        position: "is-top-right"
                                    });
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })
                            .finally(() => {
                                context.setLoading(false);
                       });
                    }else{
                     context.setLoading(false);
                    }
                });
            }
        },

        getproduct() {
              this.setLoading(true);
            let uri = '/Product/' + this.$route.query.id;
               axios.get(uri).then((response) => {
                this.product = response.data.ProductDetails;
                this.image = this.product.image;
                this.product.image = '';
                this.arr.push({
                    price: response.data.ProductDetails.price,
                    weight: response.data.ProductDetails.weight,
                    unit: response.data.ProductDetails.unit,
                    image: response.data.ProductDetails.image,
                });
                this.arr.splice(0, 1);
            })
                   .finally(() => {
                                this.setLoading(false);
                       });

        },


        gettax() {
              this.setLoading(true);
            let uri = '/listTaxRate';
            axios.get(uri).then((response) => {
                this.tax = response.data.TaxRateDetails;
            })
            .finally(() => {
                        this.isFetching = false
                    });
        },

        getCategory() { 
             this.setLoading(true);
            let uri = '/category';
            axios.get(uri).then((response) => {
                this.category = response.data.CategoryMethodDetails;

            })
            .finally(() => {
                        this.isFetching = false
                    });
        },



        addCurrent(index) {
            if (this.arr[(this.arr.length) - 1].price && this.arr[(this.arr.length) - 1].weight && this.arr[(this.arr.length) - 1].unit && this.arr[(this.arr.length) - 1].image != '') {
                this.arr.push({
                    price: '',
                    weight: '',
                    unit: '',
                    image: '',
                });
            } else {
                this.$buefy.toast.open({
                    duration: 4000,
                    message: "Field is required",
                    title: " updated successfully",
                    type: "is-danger",
                    position: "is-top-right"
                });
            }
        },
        deleteFiles(index) {
            this.arr.splice(index, 1);
        },

        getAsyncData(index) {
            this.index = index;
            if (Object.keys(this.arr[index].unit)) {
                this.isFetching = true
                let url = '/Autounit';
                axios.get(url, {
                        query: {
                            unit: this.arr[index].unit
                        }
                    }).then(response => {
                        this.data = response.data.units;
                    })
                    .catch((error) => {
                        this.data = []
                        throw error
                    })
                    .finally(() => {
                        this.isFetching = false
                    });
            }
        },
    },
}
</script>