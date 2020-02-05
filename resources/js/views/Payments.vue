<template>
  <section class="hero is-fullheight is-default is-bold">
       <layout-header></layout-header>
   <form id="app" @submit.prevent="handleSubmit">
 
   
    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Payments</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
        

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Payments</a>
          </li>
        </ul>
      </nav>
    </div>
    
    <section class="container forms-sec has-background-white box is-clearfix">
      <div class="field has-addons is-pulled-right ">
        <div class="control has-icons-left is-hidden-mobile">
          <input
            type="text"
            class="input is-info is-small"
            v-model="search"
            placeholder="Filter....."
          >
          <span class="icon is-medium is-left">
            <i class="fa fa-futbol-o"></i>
          </span>
        </div>
        <div class="control is-hidden-mobile">
          <a class="button is-info is-samll has-background-grey-darker">Search</a>
        </div>
       
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
        :data="filteredCustomers"
        :paginated="isPaginated"
        :per-page="perPage"
        :current-page.sync="currentPage"
        :pagination-simple="isPaginationSimple"
        :default-sort-direction="defaultSortDirection"
        default-sort="invoice"
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
            field="payment_date"
            class="is-size-7-mobile"
            label="Payment Date"
            sortable
          >{{ formatter (props.row.payment_date) }}</b-table-column>

          <b-table-column
            field="invoice_number"
            class="is-size-7-mobile"
            label=" Invoice"
            sortable
          >{{ props.row.invoice_number }}</b-table-column>

          <b-table-column
            field="date"
            class="is-size-7-mobile"
            label="	 Date"
            sortable
          >{{ formatter (props.row.date) }}</b-table-column>

         
          <b-table-column
            field="client_name"
            class="is-size-7-mobile"
            label="Client"
            sortable
          >{{ props.row.client_name }}</b-table-column>
          <b-table-column
            field="Payment_amount"
            class="is-size-7-mobile"
            label="Amount Paid"
            sortable
            
           
          > {{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}  {{ (props.row.payment_amount).toFixed(props.row.currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencythousands) }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column>
 <b-table-column
            field="paymenttype_id"
            class="is-size-7-mobile"
            label="Payment Method"
            sortable
          >{{ props.row.paymenttype_id }}</b-table-column>
 <b-table-column
            field="note"
            class="is-size-7-mobile"
            label="Notes"
            sortable
          >{{ props.row.note }}</b-table-column>
          

         
        
         <b-table-column field="Options" class="is-size-7-mobile" label="Options" sortable>
            <!-- <a href=""><i class="fas fa-pencil-alt spaces has-text-grey-dark	"></i>  </a>
        <a href=""><i class="fa fa-trash spaces has-text-grey-dark	" aria-hidden="true"></i> </a>
            -->
            <b-dropdown hoverable>
              <button1 class="button is-small has-background-grey-darker has-text-white" slot="trigger">
                <span>Options</span>
                <i class="fas fa-caret-down drops"></i>
              </button1>

              <b-dropdown-item @click="isImageModalActive= true; getpayment(props.row.payment_id)">
			
                <i class="fas fa-edit icon1" ></i> Edit
				
              </b-dropdown-item>
              
            
              <b-dropdown-item @click="goToDelete(props.row.payment_id)">
                <i class="fas fa-trash-alt icon1"></i> Delete
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
                  <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Enter Payment</h4>
                
                     <p class="bd-notification is-info">
                        <label>Amount
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
							
                           <input class="input" type="text" placeholder="Amount" id="amount" v-model="payment.amount" name="amount" v-validate="'required'"
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
							  v-model="payment.paymentdate" 
							  name="paymentdate" 
                :date-formatter="formatDate"
							  v-validate="'required'"
                             :class="{ 'is-invalid': submitted && errors.has('paymentdate') }">
                           </b-datepicker>
                        </p>
						 <span v-show="errors.has('paymentdate')" class="invalid-feedback">{{validpaymentdate}}</span>
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Payment Method</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="paymentmethod" id="paymentmethod" v-model="payment.paymentmethod"  v-validate="'required'"
                    :class="{ 'is-invalid': submitted && errors.has('paymentmethod') }">
                                  <option v-for="paymentmethod in name"  v-bind:value="paymentmethod.id" :key="paymentmethod.id">
           {{paymentmethod.name}} 
     </option>
                              </select>
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
                              " class="textarea is-small is-shadowless" id="paymentnotes" v-model="payment.paymentnotes" name="paymentnotes" 
                    :class="{ 'is-invalid': submitted && errors.has('paymentnotes') }"></textarea>                             
                        </p>
                     </div>
                     </p>
             
                      <button class="button is-dark is-small is-pulled-right" >Submit</button>
                     
                     <button1 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive = false">cancel</button1>
               
               </div>
            </b-modal>
		
         </section>

      </template>



    <layout-footer></layout-footer>
	</form>
  </section>
</template>
 

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import { Validator } from "vee-validate";
import moment from 'moment'
export default {
    components: {
    LayoutHeader,
    LayoutFooter,
	moment
  },
  data() {
    return {
      isImageModalActive: false,
      isCardModalActive: false,
      search: "",
      data: [
      ],
	    payment:
            { 
				amount: "",
				paymentdate: "",
				paymentmethod: "",
        paymentnotes: "",
        currency_id:'',
        
            },
        currencysymbol:'',
        currencyplace:'',
        currencydecimal:'',
        currencythousands:'',
        system:'',
        systemValue:'',
        isPaginated: true,
        isPaginationSimple: false,
        defaultSortDirection: "asc",
        currentPage: 1,
        perPage: 5
    };
  },
 
 computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

    filteredCustomers: function() {
      var self = this;
      return this.data.filter(function(cust){
        return( 
        cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
         cust.payment_date.indexOf >= 0 ||
           cust.invoice_number.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
             cust.date.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
               cust.payment_amount.indexOf >= 0 ||
                 cust.paymenttype_id.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 
                 
        );
        });
    }
  },
  
		mounted: function()
		{
      this.getpaymethod();
       this.callFunction(); 
        this.customFormatter();
         this.fetchdata();
		},
    
	 methods: {

  ...mapActions({
      setLoading: "setLoading"
    }),
             
formatDate(date){
              return moment(new Date(date)).format(this.systemValue);
         },

  formatter(date){
           return moment(new Date(date)).format(this.systemValue);
         },

 customFormatter(){
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

  callFunction() {
           var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
       },
            fetchdata()
            {
              this.setLoading(true);
              let uri = '/Payment';
               axios.get(uri).then((response) => {
                this.data= response.data.payment_Details;
                })
                .finally(() => {
                this.setLoading(false);
              });
      },

  getpayment(id) {
    this.setLoading(true);
      this.payment_id= id;
        let uri = '/Payment/' + id;
          axios.get(uri).then((response) => {
            this.payment = response.data.paymentdetails;
              var dateMomentObj = response.data.paymentdetails.paymentdate;
              var DateObj = moment(dateMomentObj);
                this.payment.paymentdate = new Date(DateObj);
     })
     .finally(() => {
                this.setLoading(false);
              });
    },
	
	getpaymethod() {
     this.setLoading(true);
      let uri = '/PaymentMethod' ;
       axios.get(uri).then((response) => {
        this.name = response.data.payment_methodDetails;
      })
      .finally(() => {
                this.setLoading(false);
              });
    },

    handleSubmit( ) {
        let context = this;
        context.setLoading(true);
         context.submitted = true;
          if (context.payment_id != '' && context.payment_id != null) {
           context.$validator.validate().then(valid => {
            if (valid) {
             let url = '/Payment/' +context.payment_id;
              let config = {
               headers: {
                'content-type': 'application/json'
            }
          }
          let formdata = new FormData();
           formdata.append('amount', context.payment.amount);
            if (context.payment.paymentdate != '') {
              var dateObj = new Date(context.payment.paymentdate);
               var momentObj = moment(dateObj);
                var momentString = momentObj.format('YYYY-MM-DD');
                 context.payment.paymentdate = momentString;
                  formdata.append('date', context.payment.paymentdate);
            }
          formdata.append('paymentmethod', context.payment.paymentmethod);
           formdata.append('paymentnotes', context.payment.paymentnotes);
            axios.put(url, context.payment, config).then(response => {
             if (response.data.status == 1) {
              context.$buefy.toast.open({
            duration: 4000,
             message: response.data.message,
              type: "is-danger",
               position: "is-top-right"
          });
        } else {
          context.payment = [];
           context.fetchdata();
          context.$buefy.toast.open({
            duration: 4000,
            message: response.data.message,
            position: "is-top-right",
            type: "is-success"
          });
        }
      })
      .finally(() => {
                context.setLoading(false);
              });
        }
        else{
                   context.setLoading(false);
                    }
      });
      }  
           context.isImageModalActive = false;
    },

  goToDelete(id){ 
     this.$buefy.dialog.confirm({
        message: 'Are you sure you want to delete this record?',
         onConfirm: () => this.destroy(id)
      })  
    },
 
 destroy(id) {  
     this.setLoading(true);
        let uri = "/Payment/";
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
        }
        }
};
</script>

<style>
.sect {
    padding: 3rem 1.5rem;
    padding-top: 2rem !important;
}
</style>

