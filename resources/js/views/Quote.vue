<template>
   <section class="hero is-fullheight is-default is-bold">
      <layout-header></layout-header>
      <div class="container breadcrums1">
         <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Quotes</h6>
         <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
            <ul>
               <li class="is-size-7">
                  <a class="has-text-grey" href="#">Pages</a>
               </li>
               <li class="is-size-7">
                  <a class="has-text-grey" href="#">Users</a>
               </li>
               <li class="is-active is-size-7">
                  <a href="#" aria-current="page">Category</a>
               </li>
            </ul>
         </nav>
      </div>
      <section class="container forms-sec has-background-white box is-clearfix">
        
        <div class="field invo1 has-addons is-pulled-right ">
           <div>
            <b-field grouped group-multiline>
            <b-select  v-model="company_name" >
            <option value = "0"> All Company</option>
             <option v-for="(companies,index) in companyquote"  v-bind:value="companies.id" :key="index">
                          {{companies.company_name}}
                             </option>
       
         </b-select>
         </b-field>
         </div>

           <div>
            <b-field grouped group-multiline>
            <b-select  v-model="status" >
            <option value = "0"> All Status</option>
         <option v-for="(quotes_status_master,index) in statuses" v-bind:value="quotes_status_master.quotesstatus" :key="index">
                                       {{ quotes_status_master.quotesstatus }}
                                    </option>
         </b-select>
         </b-field>
         </div>
           <!-- <div>
              <b-field grouped group-multiline>
                 </b-field>
              </div> -->
         
            <div class="control has-icons-left is-hidden-mobile">
               <input type="text" class="input is-info is-small" v-model="search" placeholder="Filter.....">
               <span class="icon is-medium is-left">
                  <i class="fa fa-futbol-o"></i>
               </span>
            </div>
            <div class="control is-hidden-mobile">
               <a class="button is-info is-small has-background-grey-darker" @click="filter">Search</a>
            </div>
            <a @click="isImageModalActive = true" class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform">Add</a>
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

        <b-table class="table is-bordered is-striped is-fullwidth search-table inner" 
         :data="filteredCustomers"
         :paginated="isPaginated" 
         :per-page="perPage" 
         :current-page.sync="currentPage" 
         :pagination-simple="isPaginationSimple"
         :default-sort-direction="defaultSortDirection" default-sort="">
            <template slot-scope="props">
               <b-table-column field="id" class="is-size-7-mobile" label="ID" width="40" sortable numeric :row-class="(row,index)">
                  {{ props.index + 1 }}
               </b-table-column>

               <b-table-column field="quote_no" class="is-size-7-mobile" label=" Quote No" sortable>
                  {{ props.row.quote_no }}
               </b-table-column>
               <b-table-column field="date" class="is-size-7-mobile" label="Date" sortable>
                  {{formatter(props.row.date)  }}
               </b-table-column>
               <b-table-column field="expires_on" class="is-size-7-mobile" label="ExpiresOn" sortable>
                  {{formatter(props.row.expires_on)
                  }}
               </b-table-column>
               <b-table-column field="client_name" class="is-size-7-mobile" label="ClientName" sortable>
                  {{ props.row.client_name}}
               </b-table-column>
              
               <b-table-column field="total_amount" class="is-size-7-mobile" label="Total Amount" sortable>
   
              <!-- {{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}  {{(props.row.totalamount).toFixed(props.row.currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencies_thousands)}} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}
    -->
    {{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}  {{(props.row.totalamount).toFixed(props.row.currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencies_thousands)}} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}
               </b-table-column>
                 <b-table-column 
                  field="quotesstatus"
                  class="is-size-7-mobile"
                  label="status"
                  sortable
                  >{{ props.row.quotesstatus }}</b-table-column>

               <b-table-column field="Options" class="is-size-7-mobile" label="Options" sortable>
                
                  <b-dropdown hoverable>
                     <button class="button is-small has-background-grey-darker has-text-white" slot="trigger">
                        <span>Options</span>
                        <i class="fas fa-caret-down drops"></i>
                     </button>
                     <b-dropdown-item >
                   <router-link :to="{name: 'quoteform', query: { id : props.row.quotes_id, edit: true }}" class="has-text-dark">
                        <i class="fas fa-edit icon1" ></i> Edit 
                        </router-link>
                     </b-dropdown-item>
                     <b-dropdown-item @click="goToDelete(props.row.quotes_id)">
                        <i class="fas fa-trash-alt icon1"></i>Delete
                     </b-dropdown-item>
                     <b-dropdown-item @click="savefiles(props.row.quotes_id)">
                        <i class="fas fa-download icon1" ></i>Download PDF
                     </b-dropdown-item>
                  </b-dropdown>
               </b-table-column>
            </template>
           
            <template slot="empty">
          <h4>
            <center>{{"No record found"}}</center>
          </h4>
        </template>
         
         </b-table>
            
      </section>
      <template>
         <section>
            <form id="app" @submit.prevent="savequote" validate>
               <b-modal :active.sync="isImageModalActive " :width="340">
                  <div class="card section sect">
                     <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Create Quote</h4>

                     <p class="bd-notification is-info">
                        <label>Client
                        </label>
                        <div class="field">
                           <b-autocomplete name="client_id" v-model="client_id" field="title" :loading="isFetching"
                              @typing="getAsyncData" :class="{ 'is-invalid': submitted && errors.has('client_id') }"
                              :data="filteredDataArray" placeholder="client" icon="magnify" @select="option => selected = option">
                              <template slot="empty">No results found</template>
                           </b-autocomplete>

                         
                     </p>
                  </div>
               
                  <p class="bd-notification is-info">
                     <label>Date <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker id="date" name="date" v-model="quote.date" v-validate="'required'"
                            :date-formatter="formatDate"
                          placeholder="enter date..." icon="calendar-today">
                           </b-datepicker>
                        </p>
                     </div>
                  </p>


                  <p class="bd-notification is-info">
                     <label>Company Name</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                       <select name="company" id="company" v-model="quote.company"  v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('company') }">
                                 <option v-for="(companies,index) in companyquote"  v-bind:value="companies.id" :key="index">
                          {{companies.company_name}}
                             </option>
                              </select>
                           </div>
                        </div>
                     </div>
                   </p>

                  <p class="bd-notification is-info">
                     <label>Group</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">

                              <select name="quote_template" v-model="quote.quote_template" default :class="{ 'is-invalid': submitted && errors.has('quote_template') }">
                                 <option value="systimanx_quote">systimanx_quote</option>
                                
                              </select>
                           </div>
                        </div>
                   
                     </div>
                  </p>

                
                  <button class="button is-dark is-small is-pulled-right">Submit</button>
             <button1 @click="isImageModalActive = false" class="button has-background-light is-small is-pulled-right clearbuton"  >Cancel</button1>   
           

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
   import moment,{ defaultFormat } from 'moment';
   export default {
      components: {
         LayoutHeader,
         LayoutFooter,
         moment
      },

      data() {
         return {
            system:"",
            systemValue:"",
            systemquantities : "",
            isImageModalActive: false,
            isCardModalActive: false,
            search: "",
            // status:"",
            quotes_id: "",
            client_id: "",
            currencysymbol: "",
            currencyplace:"",
            expDate:"",
            myDate: '',
            newDay: '',
            expires_on: '',
            company_name:"0",
            status:"0",
            // data:[],
            statuses:[],
            client:[],
            quoteclient:[],
            companyquote: [],
            quotedata:[],
            // quotesData:[],
            
            quote: 
               {
                  client_id: "",
                  date: new Date(),
                  company: "",
                  quote_template: "systimanx_quote",
               },
            
             quoteform: 
            {
               quote_no: "",
               date: "",
               expires_on: "",
               client_name: "",
               totalamount: "",
               quotesstatus: "",
            },

           
            submitted: false,
            editMode: false,


            required: "date required",
            requiredclient: "select client",
            requireddate: "select date",

           // data: [],

            isPaginated: true,
            isPaginationSimple: false,
            defaultSortDirection: "asc",
            currentPage: 1,
            perPage: 5,
            isFetching: false,
            dateoptions : { year: 'numeric', month: 'numeric', day: 'numeric' },
         };
      },

       async created(){
      let self =this;
      await  this.getstatus();
       if(this.$route.query.status != null && this.$route.query.status != ''){
         this.status = this.$route.query.status;
         this.filter();
      }
   },

      computed: {

           ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

      filteredDataArray() {
         //   var self = this;
        return this.quoteclient.filter((option) => {
               return option
                  .toString()
                  .toLowerCase()
                  .indexOf(this.client_id.toLowerCase()) >= 0
            })
          },
      

   
      filteredCustomers: function() {
        
     var self = this;
      // if(self.search != null && self.search != undefined && self.search != ''){
         return this.quotedata.filter(function(cust) {
         return (
            cust.quote_no.toLocaleString().indexOf(self.search.toLowerCase()) >=
               0 ||
            cust.date.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
            cust.expires_on.toLocaleString().indexOf(self.search.toLowerCase()) >=
               0 ||
                cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0 ||
              cust.totalamount.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
                cust.quotesstatus.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0
         );
         });
     }
      },     
     
      mounted: function () {
        this.isImageModalActive = this.$route.query.popup ? true : false;
        console.log("popupstatus",this.$route.query);
        this.client_id = this.$route.query.name ? this.$route.query.name : '';
   
        this.fetchquotes();
        this.customFormatter();
        this.getcompany();
       
      
      //  this.dateDisplay();
      },

      methods: {

          ...mapActions({
      setLoading: "setLoading"
    }),
         
      //   dateDisplay(theDate, days) {
            
      //    var dateObj = new Date(this.quote.date);
      //    var momentObj1 = this.quote.date
      //    var dateObj1 = moment(momentObj1);
      //    var myDate = new Date(theDate.getTime() + (10 * 24 * 60 * 60 * 1000));
      //    console.log("mydate",myDate);
      //    this.quoteform.expires_on = new Date(myDate);
      //    console.log("expireson",this.quoteform.expires_on);
      //  },
    
     filter(){
         //   alert(this.company_name)
      const input={
         Company:this.company_name,
         Status:this.status
      }
         let url = '/filterquotes'; 
            axios.post(url,input)
                .then((response) => {
                   this.quotedata = response.data.quotesviews;
                   console.log(this.quotedata,"quotesdata")
                });
         
     },
     
     getcompany(){
        this.setLoading(true);
      //   alert(1);
         let url = '/Company';
            axios.get(url).then(response => {
             this.companyquote = response.data.CompanyDetails;
          
            })
            .finally(() => {
                this.setLoading(false);
              });
     },
      getstatus(){
      //   alert(1);
        this.setLoading(true);
         let url = '/listStatus';
            axios.get(url).then(response => {
             this.statuses = response.data.statusDetails;
          
            })
            .finally(() => {
                this.setLoading(false);
              });
     },


     
     
         formatter(date){
           return moment(new Date(date)).format(this.systemValue);
         },
         customFormatter(){
       //alert(5);
       this.setLoading(true);
            let url = '/systemdate';
            axios.get(url).then(response => {
            this.system = response.data.systemDate;
            this.systemValue = response.data.systemValue;
            console.log(this.systemValue,"system");
         })
          .finally(() => {
                this.setLoading(false);
              });
     }, 

    
         formatDate(date){
          //  console.log("dataeformat",dt.toLocaleDateString(this.system));
          //  return dt.toLocaleDateString(this.system);
              return moment(new Date(date)).format(this.systemValue);
              
         },
       
        clear() {
            this.isImageModalActive = false;

        },

       fetchquotes() {
         //  alert(1);
          this.setLoading(true);
            let url = '/Quotes';
            axios.get(url).then(response => {
               console.log(response);
            this.quotedata = response.data.quotedetails;
            console.log( this.quotedata,"quotedata");
          })
          .finally(() => {
                this.setLoading(false);
              });
      },

      //     callFunction() {
   
      //       // var currentDate = new Date();
      //       // console.log("currentdate",currentDate);
  
      //       var currentDateWithFormat = new Date().toJSON(this.system).slice(0,10);
      //       console.log("cureenctdate",currentDateWithFormat);
     
      //   },

     
         // savefiles(id){
       
         
            //  let currentObj = this;
            // axios.get('/pdfviewquote', { params: {quotes_id:id,quote_no: this.quoteform.quote_no} }).then((response) => {
               
            //    var link = document.createElement('a');
            //    link.href = response.data.data.outputfile;
            //    link.download = response.data.name;
            //    link.dispatchEvent(new MouseEvent('click'));
            // });

              savefiles(id) {
           this.quotes_id = id;
            let currentObj = this;
             this.setLoading(true);
            

                      
             axios({
                            url:"/pdfviewquote/" + this.quotes_id,
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
                                this.fetchquotes();
                            })
                             .finally(() => {
                this.setLoading(false);
              });
            
        },

        

         

         getAsyncData() {
           // alert(0);
            this.setLoading(true);
            if (Object.keys(this.client_id).length > 1) {
               this.isFetching = true
               let url = '/autoComplete'
               
               axios.get(url,{query: {client_name: this.client_id}}).then(response => {
                  console.log(response)
              
                 this.quoteclient = response.data.autocomplete;
             
               })
                  .catch((error) => {
                     this.quoteclient = []
                     throw error
                  })
                 .finally(() => {
                this.setLoading(false);
              });
            }

         },

           goToDelete(id) {
          this.$buefy.dialog.confirm({
            message: 'Are you sure you want to delete this record?',
            onConfirm: () => this.destroy(id)
          })
        },
    
    destroy(id){
        this.setLoading(true);
      let url = '/Quotes/' ;
  //    console.log("URL",url);
      
        axios
        .delete(url+id)
        .then(resp =>{
          if (resp.data.status == 1) {
                      this.$buefy.toast.open({
                      duration: 4000,
                      message: resp.data.message,
                      title: "deleted successfully",
                      type: 'is-success',
                      position: "is-top-right",
                    });
                   // this.fetchquotes();
                    // alert('success');
                    // this.user = '';
                      window.location.href = "";
                  }
                  else {
                      this.$buefy.toast.open({
                      duration: 1000,
                      message: resp.data.message,
                      title: "deleted failed",
                      position: "is-top-right",
                      type: 'is-danger'
                    });
                    // alert('failed');
                  }
          //  alert(resp.data.message);
          // this.fetchuser();
        })
        .catch(error => {
            console.log(error);
          })
          .finally(() => {
                this.setLoading(false);
              });
      
    },
   
         savequote(e) {
            // alert(124);
            if (this.$route.query.id != '' && this.$route.query.id != null) {
               this.submitted = true;
                this.setLoading(true);
               this.editMode = true;
               let url = '/Quotes/' + this.$route.query.id;
             //  console.log(url);
               axios.put(url, this.quote).then((response) => {
                  if (response.data.status == 1) {
                     this.$buefy.toast.open({
                        duration: 4000,
                        message: response.data.message,
                        title: "updated success",
                        type: "is-success",
                        position: "is-bottom-right",
                     });
                     this.$router.push('/quoteform');
                  }
                  else {
                     this.$buefy.toast.open({
                        duration: 1000,
                        message: response.data.message,
                        title: "updated failed",
                        position: "is-top-right",
                        type: "is-danger"
                     });
                  }
                  console.log(response)
               })
                .finally(() => {
                this.setLoading(false);
              });
            } else {
                   this.submitted = true;
                    this.setLoading(true);
                   this.$validator.validate().then(valid => {
                  if (valid) {
                     let url = '/Quotes';
                    // console.log(url);
                     let config = {
                        headers: {
                            Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                            'content-type': 'multipart/form-data',
                          //  'content-type': 'application/json'
                        }
                     }
                     let formdata = new FormData();
                     formdata.append('client_id', this.client_id);
                     formdata.append('quote_template', this.quote.quote_template);
                     formdata.append('company', this.quote.company);
                    
                     if (this.quote.date != '') {
                        var dateObj = new Date(this.quote.date);
                        var momentObj = moment(dateObj);
                        var momentString = momentObj.format('YYYY/MM/DD');
                        console.log("moment",momentString);
                        this.quote.date = momentString;
                        // this.quote.date = new Date(this.quote.date);
                       formdata.append('date', this.quote.date);
                     }

                     //   formdata.append('date',this.quote.date);

                     axios.post(url,formdata,config).then(response => {
                        this.quotes_id = response.data.id;
                       
                       // console.log(this.client_id);
                        if (response.data.status == 1) {
                            this.$buefy.toast.open({
                              duration: 4000,
                              message: response.data.message,
                              type: "is-success",
                              position: "is-top-right"
                           });
                        this.$router.push({ name: 'quoteform', query: { id: response.data.id, client_id: response.data.client_id, edit:false } });
          
                        } else {
                           this.$buefy.toast.open({
                              message: response.data.message,
                              position: "is-top-right",
                              type: "is-danger"
                           });
                           this.$router.push('/quoteform');
                        }
                     })
                       .finally(() => {
                this.setLoading(false);
              });
                  }
               });
            }
         },
    }
      };
  

</script>
<style>
   .sect {
      padding: 3rem 1.5rem;
      padding-top: 2rem !important;
   }
</style>