<template>
   <section class="hero is-fullheight is-default is-bold">
      <layout-header></layout-header>
      <div class="container breadcrums1">
         <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Invoices</h6>
         <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
            <ul>
               <li class="is-size-7">
                  <a class="has-text-grey" href="#">Pages</a>
               </li>
               <li class="is-active is-size-7">
                  <a href="#" aria-current="page">Invoice</a>
               </li>
            </ul>
         </nav>
      </div>

       
      <section class="container forms-sec has-background-white box is-clearfix">
         <div class="field invo1 has-addons is-pulled-right ">

           <div>
              <b-field grouped group-multiline>
                 <b-select  v-model="company_name" >
                    <option value="0"> All Company</option>
          <option v-for="name in Company_name" v-bind:value="name.id"  :key="name">
   {{name.company_name}} 
   </option>
    </b-select>
         </b-field>
         </div>&nbsp;&nbsp;&nbsp;&nbsp;

            <div>
              <b-field grouped group-multiline>
                 <b-select  v-model="status" >
                    <option value="0"> All Status</option>
            <option v-for="tax_rate in invoice_status" v-bind:value="tax_rate.invoicestatus" :key="tax_rate">
      {{tax_rate.invoicestatus}} 
      </option>
    </b-select>
         </b-field>
         </div>&nbsp;&nbsp;&nbsp;&nbsp;<div @click="filter" class="control is-hidden-mobile">
               <a class="button is-info is-samll has-background-grey-darker">Search</a>
            </div>
           
            

             <div class="control has-icons-left is-hidden-mobile">
               <input
                  type="text"
                  class="input is-info is-small"
                  v-model="search"
                  placeholder="Filter"
                  >
               <span class="icon is-medium is-left">
               <i class="fa fa-futbol-o"></i>
               </span>
            </div>
            <a  @click="isImageModalActive = true"
               class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
               >Add</a>
         </div>
         <b-field grouped group-multiline>
            <b-select v-model="perPage" :disabled="!isPaginated">
               <option value="5">5 per page</option>
               <option value="10">10 per page</option>
               <option value="15">15 per page</option>
               <option value="20">20 per page</option>
            </b-select>
            <div class="control is-flex">
               <b-switch v-model="isPaginated" class="is-size-7 is-uppercase">Paginated</b-switch>
            </div>
         </b-field>
         <b-table
            class="table is-bordered is-striped is-fullwidth search-table inner"
            :data="filteredDataArray"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :default-sort-direction="defaultSortDirection"
            default-sort=""
            >
            <template slot-scope="props">
               <b-table-column
                  field="id"
                  class="is-size-7-mobile"
                  label="ID"
                  width="40"
                  sortable
                  numeric
                  :row-class="(row,index)"
                  >{{ props.index + 1 }}</b-table-column>
               <b-table-column
                  field="invoice_number"
                  class="is-size-7-mobile"
                  label=" Invoice No"
                  sortable
                  >{{ props.row.invoice_number }}</b-table-column>
               <b-table-column
                  field="date"
                  class="is-size-7-mobile"
                  label="Date"
                  sortable
                  >{{ formatter (props.row.date) }}</b-table-column>
               <b-table-column  
           
                  field="expires_on"
                  class="is-size-7-mobile"
                  label="Due"
                  sortable
                 ><span v-if="props.row.is_date == 1" style="color: red;" > {{ formatter (props.row.expires_on) }}</span> <span v-if="props.row.is_date == 0"> {{formatter (props.row.expires_on) }}</span></b-table-column>
               <b-table-column
                  field="client_name"
                  class="is-size-7-mobile"
                  label="Client"
                  sortable
                  >{{ props.row.client_name }}</b-table-column>
               <b-table-column
                  field="total"
                  class="is-size-7-mobile"
                  label="Total Amount"
                  sortable
                  >{{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}  {{ (props.row.total).toFixed(props.row.currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencythousands) }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column>
               <b-table-column
                  field="balance"
                  class="is-size-7-mobile"
                  label="Balance"
                  sortable
                  >{{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}  {{ (props.row.balance).toFixed(props.row.currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencythousands) }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column>
               <b-table-column 
                  field="status"
                  class="is-size-7-mobile"
                  label="status"
                  sortable
                  >{{ props.row.status }}</b-table-column>
               <b-table-column field="Options" class="is-size-7-mobile" label="Options" sortable>
               
                  <b-dropdown hoverable>
                     <button class="button is-small has-background-grey-darker has-text-white" slot="trigger">
                     <span>Options</span>
                     <i class="fas fa-caret-down drops"></i>
                     </button>
                     <b-dropdown-item>
                        <router-link :to="{name: 'invoiceform', query: { id: props.row.invoice_id, currency: props.row.currency_id, edit :true }}"  class="has-text-dark">
                           <i class="fas fa-edit icon1"></i> Edit
                        </router-link>
                     </b-dropdown-item>
                     <b-dropdown-item @click="goToDelete(props.row.invoice_id)">
                        <i class="fas fa-trash-alt icon1"></i>Delete
                     </b-dropdown-item>
                     <b-dropdown-item @click="savefile(props.row.invoice_id)">
                        <i class="fas fa-download icon1" ></i>Download PDF
                     </b-dropdown-item>
                     <b-dropdown-item v-if="props.row.status != 'Draft' && props.row.status != 'Cancelled'">
                     
                        <a  @click="isImageModalActive1=true;  payment(props.row.invoice_id,props.row.balance,props.row.currencies_id,props.row.currencies_placement,props.row.currencydecimal,props.row.currencythousands)"  class="has-text-dark">
                        <i class="fas fa-credit-card icon1"></i>Payments
                        </a>
                     </b-dropdown-item>
                  </b-dropdown>
               </b-table-column>
            </template>
            <template slot="empty">{{"No Record Found"}}</template>
         </b-table>
      </section>
      <template>
         <section>
            <b-modal :active.sync="isImageModalActive" :width="340">
               <div class="card section sect">
                  <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered">Create Invoice</h4>
                  <form id="app" @submit.prevent="saveInvoice">
                     <p class="bd-notification is-info">
                        <label>Client<span class="has-text-danger">*</span>
                        </label>
                     <div class="field">
                        <b-autocomplete
                           name="client_id"
                           id="client_id"
                           v-model="client_id"
                           field="title"
                           :loading="isFetching"
                           @typing="getData"
                           :class="{ 'is-invalid': submitted && errors.has('client_id') }"
                           :data="filteredCustomerArray"
                           placeholder="client"
                           icon="magnify"
                           @select="option => selected = option" v-validate="'required'" v-on:input="logCreditLimit">
                           <template slot="empty">No results found</template>
                        </b-autocomplete>
                           <span v-show="errors.has('company')" class="invalid-feedback">Field is required</span>
                         </p>
                      
                       
                     </div>
                    
                     <p class="bd-notification is-info">
                        <label>Date 
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker
                              id="date"
                              name="date"
                              v-validate="'required'"
                              :date-formatter="formatDate"
                              v-model="invoice.date"
                              :class="{ 'is-invalid': submitted && errors.has('date') }"
                              placeholder="enter date ..."
                              icon="calendar-today">
                           </b-datepicker>
                        </p>
                        <!-- <div v-if="submitted && errors.has('date')" class="invalid-feedback">{{date}}
                           </div> -->
                        <span v-show="errors.has('date')" class="invalid-feedback">{{validdate}}</span>
                     </div>
                     </p>

                     <p class="bd-notification is-info">
                        <label>Company Name <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="company" id="company" v-model="invoice.company"  v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('company') }">
                                 <option v-for="companies in company"  v-bind:value="companies.id" :key=company>
                          {{companies.company_name}}
                             </option>
                              </select>
                               <span v-show="errors.has('company')" class="invalid-feedback">Field is required</span>
                           </div>
                        </div>
                     </div>
                     </p>


                     <p class="bd-notification is-info">
                        <label>Group</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="invoice_template" id="group"  v-model="invoice.invoice_template" default="SystimaNX balde.pdf" v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('invoice_template') }">
                                 <option value="SystimaNX balde.pdf">SystimaNX balde.pdf</option>
                                 <option value="Other blade.pdf">Other blade.pdf</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     </p>
                     <button class="button is-dark is-small is-pulled-right"
                         >Submit</button>
                     <button4 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive = false">Cancel</button4>
                  </form>
               </div>
            </b-modal>
         </section>
      </template>
      </form >
      <template>
         <section>
          <form id="app" @submit.prevent="handlesubmit">
               <b-modal :active.sync="isImageModalActive1" :width="340">
                  <div class="card section sect">
                     <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Enter Payment</h4>
                     <p class="bd-notification is-info">
                        <!-- quick -->
                        <label>Amount Balance: {{placement==0 ? paymentSymbol : ''}}  {{ (paymentBalance).toFixed(decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, thousands) }} {{placement==1 ? paymentSymbol : ''}}
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <input class="input" type="text"  placeholder="Amount" id="amount" v-model="invoice.amount" name="amount" v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has('amount') }">
                        </p>
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Payment Date <span class="has-text-danger">*</span>
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker
                              placeholder="06/12/2019"
                              icon="calendar-today"  
                              id="paymentdate" 
                              v-model="invoice.paymentdate"
                              :date-formatter="formatDate" 
                              name="paymentdate" 
                              v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has('paymentdate') }">
                           </b-datepicker>
                        </p>
                        <span
                                        v-show="errors.has('bill_to')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Payment Method <span class="has-text-danger">*</span> </label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="paymentmethod" id="paymentmethod" v-model="invoice.paymentmethod"  v-validate="'required'"
                                 >
                                 <option v-for="(paymentmethod) in name" v-bind:value="paymentmethod.id" :key="paymentmethod.id">
                                    {{paymentmethod.name}}
                                 </option>
                              </select>
                              <span
                                        v-show="errors.has('paymentmethod')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                           </div>
                        </div>
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Notes
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <textarea placeholder="Notes 
                              " class="textarea is-small is-shadowless" id="paymentnotes" v-model="invoice.paymentnotes" name="paymentnotes" 
                              :class="{ 'is-invalid': submitted && errors.has('paymentnotes') }"></textarea>                             
                        </p>
                     </div>
                     </p>
                     <span v-if="balanceError != null" style="color: red;"> {{ balanceError }} </span>
                     <button class="button is-dark is-small is-pulled-right" 
                        @click="isImageModalActive1 = false" >Submit</button>
                     <button1 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive1 = false" >Cancel</button1>
                  </div>
               </b-modal>
          </form>
         </section>
      </template>
      <layout-footer></layout-footer>
   </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
 import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import {
    Validator
} from "vee-validate";
import moment from 'moment'
export default {
    components: {
        LayoutHeader,
        LayoutFooter,
        moment
    },

    data() {
        return {
           invoice_status:[],
           indexColor:"",
            logCreditLimit: "",
            submitted: false,
            paymentSymbol: '',
            balanceError: null,
            paymentBalance: 0,
            isImageModalActive: false,
            isImageModalActive1: false,
            isCardModalActive: false,
            search: "",
            data: [],
            invoiceData:[],
             system:'',
             systemValue:'',
            currency:"",
            company:"",
            placement:"",
            decimals:"",
            thousands:"",
            invoice_id: "",
            client_id: "",
            paymentmethod:"",
            invoice: {
                client_id: "",
                date: new Date(),
                company:"",
                invoice_template: "SystimaNX balde.pdf",
                amount: "",
                paymentdate: new Date(),
                paymentmethod: "",
                paymentnotes: "", 
            },
            invoiceform: {
                invoice_number: "",
            },
            currencysymbol: '',
            currencyplace: '',
            currencythousands: '',
            currencydecimal: '',
            submitted: false,
            editMode: false,
           

            isPaginated: true,
            isPaginationSimple: false,
            defaultSortDirection: "asc",
            currentPage: 1,
            perPage: 5,
            company_name:"0",
            status:"0",
            isFetching: false,
            dateoptions: {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            },
        }
    },


   async created(){
      let self =this;
      await this.getInvoicestatus();
       if(this.$route.query.status != null && this.$route.query.status != ''){
         this.status = this.$route.query.status;
         this.filter();
      }
   },

   
    mounted: function() {
        this.isImageModalActive = this.$route.query.popup ? true : false;
        this.client_id = this.$route.query.name ? this.$route.query.name : '';


        
        this.paymentMethod();
              
              this.getCompany();
              this.customFormatter();
                this.fetchdata();
     
    },

    
    
 computed: {
   //  selectColor(){
   //       // alert("selectColor")
   //     var tempDate = new Date(this.data[this.indexColor].expires_on);
   //     var currDate = new Date();
   //     console.log(this.indexColor ,"---", tempDate ,"---", currDate ,"----" , tempDate.getFullYear() < currDate.getFullYear())
   //     if(tempDate.getFullYear() < currDate.getFullYear()){
   //        console.log("if Full Year");
   //        if(tempDate.getMonth() < currDate.getMonth()){
   //           console.log("if getMonth");
   //           if(tempDate.getDate() < currDate.getDate()){
   //              console.log("if getDate");
   //              return "color: red;";
   //           }
   //        }
   //     }
   //     return "";
   //  },

    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

   filteredDataArray: function() {
      var self = this;
     
         return this.invoiceData.filter(function(cust) {
         return (
            cust.invoice_number.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0 || 
            cust.date.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
            cust.expires_on.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0 ||
                cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0 ||
                cust.total_amount.indexOf >=
               0 ||
                cust.balance.indexOf >= 0||
                cust.status.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0
         );
         });
      
     
   },
   filteredCustomerArray: function(){
      var self = this;
      return this.data.filter((option) => {
            return option
               .toString()
               .toLowerCase()
               .indexOf(self.client_id.toLowerCase()) >= 0       
         })
   },

   // filteredDataArray() {
       
  
   //              return this.data.filter((option) => {
                  
   //                  return option
   //                      .toString()
   //                      .toLowerCase()
   //                      .indexOf(this.client_id.toLowerCase()) >= 0 
                        
                      
                             
   //              })
   //          }
			},

    methods: {

     ...mapActions({
      setLoading: "setLoading"
    }),

   explorerecipeStyle(index){
  
  
//   if (this.data == null) {
//         return "background:#fff;";
//       } else {
//         return "background:#eef2f7;";
//       }
    },

 
      

        formatter(date) {
            return moment(new Date(date)).format(this.systemValue);
        },

        customFormatter() {
             this.setLoading(true);
            let url = '/systemdate';
            axios.get(url).then(response => {
                this.system = response.data.systemDate;
                this.systemValue = response.data.systemValue;
            })
              .finally(() => {
                this.setLoading(false);
              });
        },

        formatDate(date) {
           
            return moment(new Date(date)).format(this.systemValue);

        },

        callFunction() {
           
            var currentDateWithFormat = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
            console.log("cureenctdate", currentDateWithFormat);
        },

         filter() {
            this.setLoading(true);
            const input={
            Company:this.company_name,
            Status:this.status
      }
         let uri = '/filter';
            axios.post(uri,input)
            .then((response) => {
              this.invoiceData = response.data.invoiceview;
                })
                  .finally(() => {
                this.setLoading(false);
              });

    },

     
 paymentMethod() {
           this.setLoading(true);
            let uri = '/PaymentMethod';
              axios.get(uri).then((response) => {
               this.name = response.data.payment_methodDetails;
               this.invoice.paymentmethod = this.name[0].id;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },
        savefile(id) {
           this.invoice_id = id;
            let currentObj = this;   
            this.setLoading(true);    
             axios({
                     url:"/pdfview/" + this.invoice_id,
                      method: "get", 
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
                                       this.fetchdata();
                            })
                            .finally(() => {
                              this.setLoading(false);
              });
        },

        resetform() {
            this.invoice = {
                client_id: "",
                date: "",
                invoice_template: "",
            }
        },

        fetchdata() {
            this.setLoading(true);
            let uri = '/invoice';
            axios.get(uri)
                .then((response) => {
                     this.invoiceData = response.data.invoiceview;
                      this.date = response.data.is_date;
                       this.company = response.data.company;
                })
                 .finally(() => {
                  this.setLoading(false);
             });
        },

 getInvoicestatus() {
     this.setLoading(true);
            let uri = '/invoicestatus';
             axios.get(uri).then((response) => {
              this.invoice_status = response.data.invoice_statusDetails;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

       
         getCompany() {
            this.setLoading(true);
            let uri = '/Companyview';
             axios.get(uri).then((response) => {
              this.Company_name = response.data.company_name;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

        goToDelete(id) {
            
            this.$buefy.dialog.confirm({
             message: 'Are you sure you want to delete this record?',
               onConfirm: () => this.destroy(id)
            })
        },

        destroy(id) {
            this.setLoading(true);
            let uri = "/invoice/";
            axios
                .delete(uri + id)
                .then(resp => {
                    if (resp.data.status == 1) {
                        this.$buefy.toast.open({
                            duration: 4000,
                             message: resp.data.message,
                              type: "is-danger",
                               position: "is-top-right"
                        });
                    } else {
                        this.$buefy.toast.open({
                            duration: 4000,
                             message: resp.data.message,
                              position: "is-top-right",
                               type: "is-success"
                        });
                    }
                    this.fetchdata();
                })
                .catch(error => {
                    console.log(error);
                })
                 .finally(() => {
                  this.setLoading(false);
             });
        },


       getData() {
   if (Object.keys(this.client_id).length > 1) { 
     
         this.isFetching = true
         let url = '/autoComplete';
         axios.get(url,{params: {client_name: this.client_id}}).then(response => {
            this.data=response.data.autocomplete;
         
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



  saveInvoice() {
     let context = this;
            context.submitted = true;
            context.setLoading(true);
            context.$validator.validate().then(valid => {
                if (valid) {
                    let url = '/invoice';
                    let config = {
                        headers: {
                            Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                             'content-type': 'multipart/form-data',
                              'content-type': 'application/json'
                        }
                    }
                    let formdata = new FormData();
                     formdata.append('client_id', context.client_id);
                      formdata.append('company', context.invoice.company);
                       formdata.append('invoice_template', context.invoice.invoice_template);
                    if (context.invoice.date != '') {
                        var dateObj = new Date(context.invoice.date);
                         var momentObj = moment(dateObj);
                          var momentString = momentObj.format('YYYY-MM-DD');
                           context.invoice.date = momentString;
                            formdata.append('date', context.invoice.date);
                    }
                    axios.post(url, formdata, config).then(response => {
                        context.invoice_id = response.data.id;
                        if (response.data.status == 1) {
                            context.$buefy.toast.open({
                                duration: 4000,
                                 message: response.data.message,
                                  type: "is-success",
                                   position: "is-top-right"
                            });
                            context.$router.push({
                                name: "invoiceform",
                                query: {
                                    id: response.data.id,
                                     client_id: response.data.client_id,
                                      edit: false
                                }
                            });
                        } else {
                            context.$buefy.toast.open({
                                message: response.data.message,
                                 position: "is-top-right",
                                  type: "is-danger"
                            });
                        }
                    })
                     .finally(() => {
                context.setLoading(false);
              });
                }
                 context.setLoading(false);
            });
        },

        payment(id, balance, symbol,currencies_placement,currencydecimal,currencythousands) {
             this.setLoading(true);
            this.invoice_id = id;
             this.paymentBalance = Number(balance);
              this.paymentSymbol = symbol;
               this.placement = currencies_placement;
                this.decimal = currencydecimal;
                 this.thousands = currencythousands;
            let uri = '/invoice';
            axios.get(uri)
                .then((response) => {
                  this.invoice.amount = Number(this.paymentBalance);
                })
                 .finally(() => {
                this.setLoading(false);
              });
        },

        handlesubmit() {
            let context = this;
            context.submitted = true;
              context.balanceError = null;
            if (Number(context.paymentBalance) < Number(context.invoice.amount) && context.paymentBalance == "0") {
                context.balanceError = "Amount is larger"
                return
            }
            if (context.balanceError == null) {
                context.setLoading(true);
                context.$validator.validate().then(valid => {
                    if (valid) {
                        let url = '/paymentinvoice/' + context.invoice_id;
                        let config = {
                            headers: {
                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formdata = new FormData();
                        formdata.append('amount', context.invoice.amount);
                        if (context.invoice.paymentdate != '') {
                            var dateObj = new Date(context.invoice.paymentdate);
                             var momentObj = moment(dateObj);
                              var momentString = momentObj.format('YYYY-MM-DD');
                               context.invoice.paymentdate = momentString;
                                formdata.append('paymentdate', context.invoice.paymentdate);
                        }
                        formdata.append('paymentmethod', context.invoice.paymentmethod);
                          formdata.append('paymentnotes', context.invoice.paymentnotes);
                          axios.post(url, formdata, config).then(response => {
                            if (response.data.status == 1) {
                               
                                   context.invoice = [];
                                    context.invoice.date = new Date();
                                     context.invoice.company = [];
                                      context.invoice.invoice_template = "SystimaNX balde.pdf";
                                       context.invoice.paymentdate = new Date();
                                        context.invoice.amount =  context.paymentBalance
                                        
                                   context.$buefy.toast.open({
                                    duration: 4000,
                                     message: response.data.message,
                                      type: "is-success",
                                       position: "is-top-right"
                                });
                                
                                 this.fetchdata();
                            } else {
                                context.$buefy.toast.open({
                                 message: response.data.message,
                                  position: "is-top-right",
                                   type: "is-danger"
                                });
                               
                            }
                            
                            
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


       getinvoice() {
            this.setLoading(true);
            let uri = '/invoice';
              axios.get(uri).then((response) => {
                this.invoice_id = response.data.id;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },
    },
};
</script>
<style>
   .sect {
   padding: 3rem 1.5rem;
   padding-top: 2rem !important;
   }
  
</style>