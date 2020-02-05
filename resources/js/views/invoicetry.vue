<template>
      <section class="hero is-fullheight dashboarding is-default is-bold">
        <layout-finpay></layout-finpay>

        <form id="app" @submit.prevent="handleSubmit" class="tryinvocie">
            <section class="hero is-fullheight is-default is-bold drop-special">
                <div class="container is-widescreen intry">
                    <div class="columns is-multiline is-mobile is-marginless">
                        <div class="column is-3 is-12-mobile">
                            <div class="helper"></div>
                            <div
                                class="drop display-inline align-center"
                                @dragover.prevent
                                @drop="onDrop"
                            >
                                <div class="helper"></div>
                                <label
                                    v-if="!image"
                                    class="btnS display-inline "
                                >
                                    <span class="is-size-3 is-marginless"
                                        >+</span
                                    >
                                    ADD YOUR LOGO
                                    <input
                                        type="file"
                                        name="image"
                                        @change="onChange"
                                    />
                                </label>
                                <div
                                    class="hidden display-inline align-center"
                                    v-else
                                    v-bind:class="{ image: true }"
                                >
                                    <img :src="image" alt="" class="img" />

                                    <a @click="removeFile">
                                        <i class="far fa-times-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                          
                        <div class="column is-3 is-12-mobile">
                            <div class="control is-clearfix">
                                <label>Bill to</label>
                                <div>
                                    <textarea
                                        class="textarea has-fixed-size is-shadowless"
                                        style=" min-height: 114px; "
                                        placeholder="Bill To"
                                        id="bill_to"
                                        name="bill_to"
                                        v-model="invoicetry.bill_to"
                                        v-validate="'required'"
                                    ></textarea>
                                    <span
                                        v-show="errors.has('bill_to')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="column is-3 is-12-mobile">
                            <div class=" bd-notification is-info ">
                                <label>Company address</label>

                                <div class="field">
                                    <textarea
                                        class="textarea has-fixed-size is-shadowless"
                                        placeholder="Enter Company address"
                                        id="company_address"
                                        name="company_address"
                                        v-model="invoicetry.company_address"
                                        v-validate="'required'"
                                        style="    min-height: 114px;   "
                                    ></textarea>
                                    <span
                                        v-show="errors.has('company_address')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="column is-3 is-12-mobile">
                            <h6
                                class="form-name is-uppercase has-text-right   is-size-6"
                            >
                                Invoices 
                            </h6>
                            <ul class="amounsec">
                                <li
                                    class="has-text-darker has-text-right has-text-weight-semibold"
                                >
                                    Subtotal 
                                    <span
                                        class="has-text-weight-normal is-pulled-right"
                                        > :  Rs {{ subtotal }}</span
                                    >
                                </li>
                                <li
                                    class="has-text-darker has-text-right has-text-weight-semibold"
                                >
                                    Discount
                                    <span
                                        class="has-text-weight-normal is-pulled-right"
                                        > : Rs {{ discountval }}</span
                                    >
                                </li>
                                <li
                                    class="has-text-darker has-text-right has-text-weight-semibold"
                                >
                                    Tax
                                    <span
                                        class="has-text-weight-normal is-pulled-right"
                                        > : Rs {{ totaltax }}</span
                                    >
                                </li>
                                <li
                                    class="has-text-darker has-text-right has-text-weight-semibold"
                                >
                                    Total
                                    <span
                                        class="has-text-weight-normal is-pulled-right" 
                                        > :  Rs {{ wholeTotal }}</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button data-v-c731277c="" class="navbar-item button has-background-dark has-text-white is-size-7 pdf"><i data-v-c731277c="" class="fas fa-print icon1"></i> Download PDF
          </button>
                     <!-- <button class="button has-background-dark has-text-white is-size-7"><i class="fas fa-print icon1" ></i> PDF</button> -->
                    <div class="container" containeg breadcrums1>
                      
                        <div class="container containeg is-clearfix">
                            <div class="columns is-clearfix">
                                <div class="column is-four-fifths">
                                    <div class="card">
                                        <header class="card-header">
                                            <p class="card-header-title">
                                                Items
                                            </p>
                                            <div class="columns is-marginless">
                                                <div class="column">
                                                    <div
                                                        id="button_container_1"
                                                    >
                                                        <button
                                                            type="button"
                                                            class="button is-dark is-small delete-row"
                                                            @click="addCurrent"
                                                        >
                                                            Add a row
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <a
                                                href="#"
                                                class="card-header-icon"
                                                aria-label="more options"
                                            >
                                                <!-- <span class="icon">
                                 <i class="fas fa-angle-down" aria-hidden="true"></i>
                                 </span>-->
                                            </a>
                                        </header>
                                        <div class="card-content">
                                            <div
                                                class="columns"
                                                v-for="(el, index) in product"
                                                :key="index"
                                            >
                                                <div class="column is-2">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Product
                                                            <span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        </label>
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <input
                                                                    class="input"
                                                                    id="product"
                                                                     v-validate="'required'"
                                                                    name="product"
                                                                    v-model="
                                                                        product[
                                                                            index
                                                                        ]
                                                                            .product
                                                                    "
                                                                    type="text"
                                                                    placeholder="Product"
                                                                />
                                                            </p>
                                                              <span
                                      v-if="product.length-1 == index"  v-show="errors.has('product')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column is-4">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Description
                                                            <span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                            
                                                        </label>
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <textarea
                                                                    placeholder="Comments"
                                                                    class="textarea is-small is-shadowless para-des"
                                                                    id="description"
                                                                    name="description"
                                                                     v-validate="'required'"
                                                                    v-model="
                                                                        product[
                                                                            index
                                                                        ]
                                                                            .description
                                                                    "
                                                                ></textarea>
                                                            </p>
                                                        <span
                                      v-if="product.length-1 == index"  v-show="errors.has('description')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>Quantity</label><span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <input
                                                                    class="input"
                                                                    type="text"
                                                                    placeholder="Quantity"
                                                                     v-validate="'required'"
                                                                    id="quantity"
                                                                    name="quantity"
                                                                    v-model="
                                                                        product[
                                                                            index
                                                                        ]
                                                                            .quantity
                                                                    "
                                                                />
                                                            </p>
                                                                                    <span
                                        v-if="product.length-1 == index" v-show="errors.has('quantity')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Price
                                                         
                                                        </label><span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <input
                                                                    class="input"
                                                                    type="text"
                                                                    placeholder="Price"
                                                                    id="price"
                                                                     v-validate="'required'"
                                                                    name="price"
                                                                    v-model="
                                                                        product[
                                                                            index
                                                                        ].price
                                                                    "
                                                                />
                                                            </p>
                                                             <span
                                        v-if="product.length-1 == index" v-show="errors.has('price')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column is-1">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Tax
                                                            <span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        </label>
                                                        <div
                                                            class="field has-addons"
                                                        >
                                                            <div
                                                                class="control is-expanded"
                                                            >
                                                                <div
                                                                    class="select is-fullwidth"
                                                                >
                                                                    <select
                                                                        class="select-tax"
                                                                        @change="
                                                                            calculatedAmount(
                                                                                index
                                                                            )
                                                                        "
                                                                        id="tax"
                                                                        name="tax"
                                                                        v-validate="'required'"
                                                                        v-model="
                                                                            product[
                                                                                index
                                                                            ]
                                                                                .tax
                                                                        "
                                                                    >
                                                                        <option
                                                                            value="0"
                                                                            >0%</option
                                                                        >
                                                                        <option
                                                                            value="12"
                                                                            >12%</option
                                                                        >
                                                                        <option
                                                                            value="18"
                                                                            >18%</option
                                                                        >
                                                                        <option
                                                                            value="28"
                                                                            >28%</option
                                                                        >
                                                                        <option
                                                                            value="5"
                                                                            >5%</option
                                                                        >
                                                                        <option
                                                                            value="10"
                                                                            >10%</option
                                                                        >
                                                                        <option
                                                                            value="8"
                                                                            >8%</option
                                                                        >
                                                                    </select>
                                                                                            <span
                                        v-if="product.length-1 == index" v-show="errors.has('tax')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Total
                                                            
                                                        </label>
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <input
                                                                    class="input"
                                                                    type="text"
                                                                    placeholder="Rs:500"
                                                                    id="total"
                                                                    name="total"
                                                                    disabled
                                                                    v-model="
                                                                        product[
                                                                            index
                                                                        ].total
                                                                    "
                                                                />
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <button2
                                                        class="delete is-small delete-row"
                                                        type="btn btn-success"
                                                        @click="
                                                            deleteFiles(index)
                                                        "
                                                    ></button2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <template>
                                        <section
                                            class="card section sectionadd sectionadda"
                                        >
                                            <h1>Additional</h1>
                                            <div class="columns">
                                                <div class="column">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Terms & Conditions
                                                            <span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        </label>
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <textarea
                                                                    placeholder="Terms & Conditions"
                                                                    class="textarea is-small is-shadowless"
                                                                    id="terms"
                                                                    name="terms"
                                                                    v-model="
                                                                        invoicetry.terms
                                                                    "
                                                                    v-validate="
                                                                        'required'
                                                                    "
                                                                ></textarea>
                                                            </p>
                                                            <span
                                                                v-show="
                                                                    errors.has(
                                                                        'terms'
                                                                    )
                                                                "
                                                                class="invalid-feedback"
                                                                >Field is
                                                                required</span
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column">
                                                    <div
                                                        class="bd-notification is-info"
                                                    >
                                                        <label>
                                                            Notes
                                                            <span
                                                                class="has-text-danger"
                                                                >*</span
                                                            >
                                                        </label>
                                                        <div class="field">
                                                            <p
                                                                class="control has-icons-left has-icons-right"
                                                            >
                                                                <textarea
                                                                    placeholder="Footer"
                                                                    class="textarea is-small is-shadowless"
                                                                    id="notes"
                                                                    name="notes"
                                                                    v-model="
                                                                        invoicetry.notes
                                                                    "
                                                                    v-validate="
                                                                        'required'
                                                                    "
                                                                ></textarea>
                                                            </p>
                                                            <span
                                                                v-show="
                                                                    errors.has(
                                                                        'notes'
                                                                    )
                                                                "
                                                                class="invalid-feedback"
                                                                >Field is
                                                                required</span
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </template>
                                </div>
                                <div class="column">
                                    <div
                                        class="card section sectionadd is-clearfix form-quote"
                                    >
                                        <div class="bd-notification is-info">
                                            <label>
                                                Invoice Number

                                                <span class="has-text-danger"
                                                    >*</span
                                                >
                                            </label>
                                            <div class="field">
                                                <p
                                                    class="control has-icons-left has-icons-right"
                                                >
                                                    <input
                                                        class="input"
                                                        type="text"
                                                        placeholder="#434403"
                                                        id="invoice_number"
                                                        name="invoice_number"
                                                        v-model="
                                                            invoicetry.invoice_number
                                                        "
                                                        v-validate="'required'"
                                                    />
                                                </p>
                                                <span
                                                    v-show="
                                                        errors.has(
                                                            'invoice_number'
                                                        )
                                                    "
                                                    class="invalid-feedback"
                                                    >Field is required</span
                                                >
                                            </div>
                                        </div>
                                        <div class="bd-notification is-info">
                                            <label>
                                                Date
                                                <span class="has-text-danger"
                                                    >*</span
                                                >
                                            </label>
                                            <div class="field">
                                                <p
                                                    class="control has-icons-left has-icons-right"
                                                >
                                                    <b-datepicker
                                                        placeholder="Date"
                                                        icon="calendar-today"
                                                        id="date"
                                                        name="date"
                                                        v-model="
                                                            invoicetry.date
                                                        "
                                                        @input="dateDisplay"
                                                        v-validate="'required'"
                                                    ></b-datepicker>
                                                </p>
                                                <span
                                                    v-show="errors.has('date')"
                                                    class="invalid-feedback"
                                                    >Field is required</span
                                                >
                                            </div>
                                        </div>
                                        <div class="bd-notification is-info">
                                            <label>Due Date</label>
                                            <div class="field">
                                                <p
                                                    class="control has-icons-left has-icons-right"
                                                >
                                                    <b-datepicker
                                                        placeholder="Due Date"
                                                        icon="calendar-today"
                                                        id="due_date"
                                                        name="due_date"
                                                        v-model="
                                                            invoicetry.due_date
                                                        "
                                                    ></b-datepicker>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bd-notification is-info">
                                            <label>Discount</label>
                                            <div class="field">
                                                <p
                                                    class="control has-icons-left has-icons-right"
                                                >
                                                    <input
                                                        class="input"
                                                        type="text"
                                                        placeholder="Discount"
                                                        @input="discal"
                                                        id="discount"
                                                        name="discount"
                                                        v-model="
                                                            invoicetry.discount
                                                        "
                                                    />
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bd-notification is-info">
                                            <label>Currency</label>
                                            <div class="field has-addons">
                                                <div
                                                    class="control is-expanded"
                                                >
                                                    <div
                                                        class="select is-fullwidth"
                                                    >
                                                        <p
                                                            class="control has-icons-left has-icons-right"
                                                        >
                                                            <select
                                                                id="currency"
                                                                name="currency"
                                                                v-model="
                                                                    invoicetry.currency
                                                                "
                                                            >
                                                                <option
                                                                    value="Rs"
                                                                    >Rupees</option
                                                                >
                                                                <option
                                                                    value="$"
                                                                    >Doller</option
                                                                >
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <layout-footer></layout-footer>
      </section>
</template>
<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutFinpay from "./layouts/finpay.vue";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import moment from "moment";
import jsPDF from "jspdf";
import Vue from "vue";
import { Validator } from "vee-validate";
export default {
    components: {
        LayoutFinpay,
        LayoutFooter
    },

    data() {
        return {
            image: "",
            wholetotal: 0,
            current: {},
            arr: [],
            subtotal: 0,
            totaltax: 0,
            discountval: 0,
            balance: 0,
            invoice_file: "",
            date: "",
            due_date: "",
            items: [
                {
                    image: false
                }
            ],

            product: [
                {
                    product: "",
                    description: "",
                    quantity: "",
                    price: "",
                    tax: "",
                    total: ""
                }
            ],
            item: "",
            invoicetry: {
                invoice_number: "",
                company_address: "",
                bill_to: "",
                terms: "",
                notes: "",
                date: "",
                due_date: "",
                discount: "",
                currency: ""
            },
            showinvoicenumber: false,
            dropFiles: [],
            tags: []
        };
        myDate: new Date();
    },

    computed:{

        ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
        
        wholeTotal() {
       
            var tempholeTotal = 0;
            var tempsubtotal = 0;
            var temptaxtotal = 0;
            var tempdiscount = 0;
            var tempdiscountval = 0;
            var total = 0;
            var finaltotal = 0;
            var wholetotal = 0;

            var temp_subtotal = 0;
            var temp_discountval = 0;
            var temp_discount = 0;
            var temp_totaltax = 0;
            var temp_wholetotal = 0;

            var arr_subtotal = [];
            var arr_discountval = [];
            var arr_discount = [];
            var arr_totaltax = [];
            var arr_wholetotal = [];

            if (this.product != null && this.product != undefined) {
                for (let j = 0; j < this.product.length; j++)

                {
                    temp_subtotal = Number(this.product[j].quantity) * Number(this.product[j].price);
                    temp_discount = (temp_subtotal * Number(this.invoicetry.discount) / 100);
                    temp_discountval = (temp_subtotal - temp_discount);
                    temp_totaltax = (temp_discountval * Number(this.product[j].tax) / 100);
                    temp_wholetotal = Number(this.product[j].total);
                    arr_subtotal[j] = temp_subtotal;
                    arr_discount[j] = temp_discount;
                    arr_discountval[j] = temp_discountval;
                    arr_totaltax[j] = temp_totaltax;
                    arr_wholetotal[j] = temp_wholetotal;
                
                }
                console.log("arr_subtotal",arr_subtotal);
                console.log("arr_discount",arr_discount);
                console.log("arr_discountval",arr_discountval);
                console.log("arr_totaltax",arr_totaltax);
                console.log("arr_wholetotal",arr_wholetotal);
            }

            temp_subtotal = 0;
            temp_discount = 0;
            temp_discountval = 0;
            temp_totaltax = 0;
            temp_wholetotal = 0;

            for (let k = 0; k < this.product.length; k++) {
                temp_subtotal += arr_subtotal[k];
                temp_discount += arr_discount[k];
                temp_discountval += arr_discountval[k];
                temp_totaltax += arr_totaltax[k];
                temp_wholetotal += arr_wholetotal[k];
            }

            this.totaltax = (temp_totaltax).toFixed();
            this.subtotal = (temp_subtotal).toFixed();
            this.discountval = (this.subtotal * this.invoicetry.discount / 100).toFixed();
            this.wholetotal = ((temp_subtotal + Number(this.totaltax)) - Number(this.discountval)).toFixed();
      
            return this.wholetotal;
        },
       
    },

    methods: {

 ...mapActions({
      setLoading: "setLoading"
    }),
       
        onDrop: function(e) {
            e.stopPropagation();
            e.preventDefault();
            var files = e.dataTransfer.files;
            this.createFile(files[0]);
        },
        onChange(e) {
            this.file = e.target.files[0];
            var files = e.target.files;
            this.createFile(files[0]);
        },
        createFile(file) {
            if (!file.type.match("image.*")) {
                alert("Select an image");
                return;
            }
            var img = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e) {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeFile() {
            this.image = "";
        },
        expertpdf() {
            this.showinvoicenumber = true;
        },
        dateDisplay(theDate, days) {
            var dateObj = new Date(this.invoicetry.date);
            var momentObj1 = this.invoicetry.date;
            var dateObj1 = moment(momentObj1);
            var myDate = new Date(theDate.getTime() + 10 * 24 * 60 * 60 * 1000);
            this.invoicetry.due_date = new Date(myDate);
            this.date = moment(this.invoicetry.date).format("DD/MM/YYYY");
            this.due_date = moment(this.invoicetry.due_date).format(
                "DD/MM/YYYY"
            );
        },

        calculatedAmount(index) {
            this.total =
                this.product[index].quantity * this.product[index].price;
            this.taxtot = (this.total * this.product[index].tax) / 100;
            this.product[index].total = this.total + this.taxtot;
            //this.subtotal = this.total;
            // this.totaltax = (this.total * this.product[index].tax) / 100;
            // this.discountval = (this.total * this.invoicetry.discount) / 100;
            // this.whole = this.subtotal + this.totaltax;
            // this.wholetotal = this.whole - this.discountval;
        },
        discal() {
            // this.discountval = (this.total * this.invoicetry.discount) / 100;
            // this.whole = this.subtotal + this.totaltax;
            // this.wholetotal = this.whole - this.discountval;
        },

        handleSubmit() {
             let context = this;
             context.setLoading(true);
            context.$validator.validate().then(valid => {
                if (valid) {
                    let url = "/invoicetry";

                    if (context.file == "") {
                        context.$buefy.toast.open({
                            duration: 4000,
                            message: "Please select the image",
                            type: "is-danger",
                            position: "is-top-right"
                        });
                    } else {
                        let formdata = new FormData();

                        formdata.append(
                            "invoice_number",
                            context.invoicetry.invoice_number
                        );
                        formdata.append(
                            "company_address",
                            context.invoicetry.company_address
                        );
                        formdata.append("bill_to", context.invoicetry.bill_to);
                        formdata.append(
                            "productdata",
                            JSON.stringify(context.product)
                        );
                        formdata.append("terms", context.invoicetry.terms);
                        formdata.append("notes", context.invoicetry.notes);
                        formdata.append("currency", context.invoicetry.currency);
                        formdata.append("total", context.wholetotal);
                        formdata.append("subtotal", context.subtotal);
                        formdata.append("taxtotal", context.totaltax);
                        formdata.append("discountval", context.discountval);
                        formdata.append("image", context.file);
                        if (context.invoicetry.date != "") {
                            var dateObj = new Date(context.invoicetry.date);
                            var momentObj = moment(dateObj);
                            var momentString = momentObj.format("YYYY-MM-DD");
                            context.invoicetry.date = momentString;
                            formdata.append("date", context.invoicetry.date);
                        }

                        if (context.invoicetry.due_date != "") {
                            var dateObj = new Date(context.invoicetry.due_date);
                            var momentObj = moment(dateObj);
                            var momentString = momentObj.format("YYYY-MM-DD");
                            context.invoicetry.due_date = momentString;
                            formdata.append(
                                "due_date",
                                context.invoicetry.due_date
                            );
                        }
                        formdata.append("discount", context.invoicetry.discount);
                        console.log(context.productname, "product");

                        axios({
                            url: url,
                            method: "post",
                            data: formdata,
                            responseType: "blob" // important for pdf download
                        })
                            // axios.post(url, formdata)
                            .then(response => {
                                var fileURL = window.URL.createObjectURL(
                                    new Blob([response.data])
                                );
                                var fileLink = document.createElement("a");
                                fileLink.href = fileURL;
                                fileLink.setAttribute("download", "file.pdf");
                                document.body.appendChild(fileLink);
                                fileLink.click();
                                context.fetchdata();
                            })
                             .finally(() => {
                context.setLoading(false);
              });
                    }
                    context.setLoading(false);
                }
                context.setLoading(false);
            });
        },

        deleteDropFile(index) {
            this.dropFiles.splice(index, 1);
        },
        deleteFile(index) {
            this.tags.splice(index, 1);
        },

        addCurrent(index) {

            if (this.product[(this.product.length) - 1].product && this.product[(this.product.length) - 1].description && this.product[(this.product.length) - 1].quantity && this.product[(this.product.length) - 1].price && this.product[(this.product.length) - 1].tax != '') {

                this.product.push({
                    product: '',
                    description: '',
                    quantity: '',
                    price: '',
                    tax: '',
                    total: ''
                });
            } else {
                this.$buefy.toast.open({
                    duration: 4000,
                    message: "Items Field is required",
                    title: " updated successfully",
                    type: "is-danger",
                    position: "is-top-right"
                });
            }
        },

        deleteFiles(index) {
            this.product.splice(index, 1);
        }
    }
};
</script>
<style>
h6.is-size-6.name-title {
    font-size: 15px !important;
    font-weight: 500;
}
.card-header {
    box-shadow: unset !important;
}
.card {
    box-shadow: 0px 0px 15px #ddd !important;
}
textarea.textarea.is-small.is-shadowless.para-des {
    min-height: 52px;
}
.form-quote .bd-notification.is-info {
    margin-bottom: 15px;
}
.hero .tabs ul {
    border-bottom: 1px solid #ddd !important;
    width: 50%;
}
.is-boxed ul li a span {
    font-size: 12px;
    text-transform: uppercase;
}
.filetable td {
    padding: 0.5em 0.75em !important;
}
span.files {
    font-size: 12px;
    text-transform: capitalize;
    background-color: #ddd;
    padding: 10px;
    border-radius: 19px;
    margin-left: 20px;
    position: relative;
}
.taginput-container.is-focusable span.tag {
    display: none;
}
.icons1 {
    border: 1px solid #000;
    padding: 4px 5px;
    border-radius: 33px;
    color: #aba4a4;
}
.taginput .taginput-container.is-focusable {
    box-shadow: unset !important;
}
ul.list-unstyled.chat-sections1 {
    box-shadow: 0px 0px 10px #ddd;
    padding: 10px 20px;
    padding-bottom: 41px;
    margin: 40px auto;
    height: 250px;
    overflow: auto;
    transform: translate(0, 0);
}
.datetime {
    margin-top: 20px;
}
.fa-caret-left:before {
    position: absolute;
    left: -8px;
    top: -4px;
    font-size: 41px;
    color: #ddd;
}
.delete-row {
    text-align: center;
    margin: 0 auto;
    display: block !important;
    margin-top: 37%;
}
.delete-row {
    background-color: #363636;
}
.dropdown-content {
    float: left;
}
.sectionadd {
    padding: 1rem 1.5rem !important;
}

.drop-special .card-content {
    padding-top: 5px !important;
}

img {
    width: 30%;
    margin: auto;
    display: block;
    margin-bottom: 10px;
}
</style>
