<template>
 <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Client Statements</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Users</a>
          </li>
          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Offers</a>
          </li>
        </ul>
      </nav>
    </div>
    

   <section class="container forms-sec has-background-white box">
       <form id="app" @submit.prevent="downloadpdf" validate>
        <div class="columns">
          <div class="column">
            <p class="bd-notification is-info">
              <label>
                Company Profile <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth"> 
                    <select id="company_profile" name="company_profile" v-model="clientstatement.company_profile" v-validate="'required'" class="select-companyprofile">
                      <option v-for="companies in companyprofile"  v-bind:value="companies.id">
                            {{companies.company_name}}
                         </option>     
                      </select>
                  </div>
                </div>
              </div>
                <div v-show="errors.has('company_profile')" class="invalid-feedback">{{companyError}}</div>
             </div>
            </p>
          </div>
      
          <div class="column">
            <p class="bd-notification is-info">
              <label>
                Client <span class="has-text-danger">*</span>
              </label>
              <div class="field">
               <b-autocomplete name="client_id" v-model="client_id" v-validate="'required'" field="title" :loading="isFetching"
                              @typing="getAsyncData" :class="{ 'is-invalid': submitted && errors.has('client_id') }"
                              :data="filteredDataArray" placeholder="client" icon="magnify" @select="option => selected = option">
                              <template slot="empty">No results found</template>
                           </b-autocomplete>
               <div v-show="errors.has('client_id')" class="invalid-feedback">{{clientError}}</div>             
             </div>
            </p>
          </div>

           <div class="column">
            <p class="bd-notification is-info">
              <label>
                From Date <span class="has-text-danger">*</span>
              </label>
            <div class="field"> 
               <p class="control has-icons-left has-icons-right">
                           <b-datepicker type="from_date" id="form_date" name="from_date" v-model="clientstatement.from_date" v-validate="'required'"
                          placeholder="enter date.." icon="calendar-today">
                           </b-datepicker>
                </p>
                <div v-show="errors.has('from_date')" class="invalid-feedback">{{fromdateError}}</div>   
             </div>
            </p>
          </div>

            <div class="column">
            <p class="bd-notification is-info">
              <label>
                To Date <span class="has-text-danger">*</span>
              </label>
            <div class="field"> 
               <p class="control has-icons-left has-icons-right">
                           <b-datepicker type="to_date" id="to_date" name="to_date" v-model="clientstatement.to_date" v-validate="'required'"
                          placeholder="enter date.." icon="calendar-today">
                           </b-datepicker>
                        </p>
                 <div v-show="errors.has('to_date')" class="invalid-feedback">{{todateError}}</div>           
             </div>
            </p>
          </div>
          </div>
        
      <!-- <div ref="content" class="card is-clearfix">
      <div id="print" class="card-body">Demo</div>
    </div> -->  
    
<button class="button is-dark is-pulled-right is-small" @click="downloadpdf" >Run report</button>
<button2 class="button has-background-light is-small is-pulled-right clearbuton" @click="topdf" >Download pdf</button2>
  <div v-if ="resultclientstatement !=null">


          
         
    <h1 style="margin-bottom: 0;text-align: left;">{{resultclientstatement.company_name}}</h1>
    <h1 style="margin-bottom: 0;text-align: left;"> {{resultclientstatement.client_name}} </h1>
    <h1 style="margin-bottom: 0;text-align: left;">{{this.fromdate}} - {{this.todate}}</h1>
    
    <br>
    <table class="table table-bordered">
        <thead>
       <tr>
            <th class="amount">Date</th> 
            <th class="amount">Invoice</th>
            <th class="amount">Note</th>
            <th class="amount">Subtotal</th>
            <th class="amount">Discount Amount</th>
            <th class="amount">Tax</th>
            <th class="amount">Total</th>
            <th class="amount">Paid</th>
            <th class="amount">Balance</th>
           
              
      </tr>
        </thead>
        <tbody>
        <tr  v-for ="(clientstatement,i) in resultclientstatement" :key="i">
            <td class="amount" style="font-weight: bold;">{{clientstatement.date}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.invoice_number}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.note}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.placement == 0 ? clientstatement.symbol : ''}}{{(clientstatement.item_sub_total).toFixed(clientstatement.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, clientstatement.thousands)}}{{clientstatement.placement == 1 ? clientstatement.symbol : ''}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.discount_amount}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.placement == 0 ? clientstatement.symbol : ''}}{{(clientstatement.tax).toFixed(clientstatement.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, clientstatement.thousands)}}{{clientstatement.placement == 1 ? clientstatement.symbol : ''}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.placement == 0 ? clientstatement.symbol : ''}}{{(clientstatement.total).toFixed(clientstatement.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, clientstatement.thousands)}}{{clientstatement.placement == 1 ? clientstatement.symbol : ''}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.placement == 0 ? clientstatement.symbol : ''}}{{(clientstatement.total_paid_amount).toFixed(clientstatement.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, clientstatement.thousands)}}{{clientstatement.placement == 1 ? clientstatement.symbol : ''}}</td>
            <td class="amount" style="font-weight: bold;">{{clientstatement.placement == 0 ? clientstatement.symbol : ''}}{{(clientstatement.balance).toFixed(clientstatement.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, clientstatement.thousands)}}{{clientstatement.placement == 1 ? clientstatement.symbol : ''}}</td>
        </tr>
        </tbody>
    </table>
         </div>
          </div>
           </form>  
     </section>
     
    <layout-footer>
     
    </layout-footer>
   </section>
</template>

<script>
  import { mapState, mapActions, mapGetters } from "vuex";
  import LayoutHeader from "./layouts/Header.vue";
  import LayoutFooter from "./layouts/Footer.vue";
  import moment from 'moment';

 

  export default {
    components: {
      LayoutHeader,
      LayoutFooter
    },
    name: 'app',
     data() {
      return {
       
        companyprofile:[],
        data:[],
       clientstatementclient:[],
        client_id:"",
        resultclientstatement:null,

        clientstatement:
        {
         company_profile: "",
         from_date:"",
         to_date:"",
        },


        submitted: false,
        editMode: false,
      
        validalphaspaces: "Only alphabet value accepted",
        numberAllowed: "Only numeric value accepted",
        validcompanyname: "Company name is required",
        validclientname: "Client name is required",
        validfromdate: "From date is required",
        validtodate: "To date is required",
   }
  
     },
      computed: {
     
     ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
            filteredDataArray() {
            
            return this.clientstatementclient.filter((option) => {
               return option
                  .toString()
                  .toLowerCase()
                  .indexOf(this.client_id.toLowerCase()) >= 0
            })
          },
      companyError(){
       if(this.clientstatement.company_profile == "" || this.clientstatement.company_profile == null )
          return this.validcompanyname
          else
           return this.validalphaspaces
       },
      clientError(){
        if(this.client_id == "" || this.client_id == null )
          return this.validclientname
        else
          return this.validalphaspaces  
       },
       fromdateError(){
        if(this.clientstatement.from_date == ""  || this.clientstatement.to_date == null )
          return this.validfromdate
        else
          return this.numberAllowed  
       
       },
       todateError(){
           if(this.clientstatement.to_date == ""  || this.clientstatement.to_date == null)
          return this.validtodate
        else
          return this.numberAllowed  
       }

        },
 
  
      
    methods: {
       ...mapActions({
      setLoading: "setLoading"
    }),
     getAsyncData() {
       
            if (Object.keys(this.client_id).length > 1) {
               this.isFetching = true
               let url = '/autoComplete'
               
               axios.get(url,{query: {client_name: this.client_id}}).then(response => {
                  console.log(response)
              
                 this.clientstatementclient = response.data.autocomplete;
                
             console.log("autoclient",response.data.autocomplete);
               })
                  .catch((error) => {
                     this.clientstatementclient = []
                     throw error
                  })
                  .finally(() => {
                     this.isFetching = false
                  });
            }

              // alert(this.data)

         },

         topdf(){
            this.company_profile = this.clientstatement.company_profile;
    
            this.client_id = this.client_id;
          
            this.fromdate = moment(this.clientstatement.from_date).format("YYYY-MM-DD");
            this.todate = moment(this.clientstatement.to_date).format("YYYY-MM-DD");
            
            this.api( this.company_profile, this.client_id, this.fromdate, this.todate,"download");
              
        },
         
      getcompany() {
         this.setLoading(true);
            let url = '/Company';
             axios.get(url).then((response) => {
               this.companyprofile = response.data.CompanyDetails;
                console.log("companyname",response.data.CompanyDetails);
            })
            .finally(() => {
                this.setLoading(false);
              });
         },

       

          downloadpdf() {
        //  alert(1);
      
          this.setLoading(true);
             this.submitted = true;
      // this.date = moment(this.clientstatement.from_date).format("YYYY-MM-DD");
      // this.newdate = moment(this.clientstatement.to_date).format("YYYY-MM-DD");
      this.company_profile = this.clientstatement.company_profile;
    
      this.client_id = this.client_id;
    
      this.fromdate = moment(this.clientstatement.from_date).format("YYYY-MM-DD");
      this.todate = moment(this.clientstatement.to_date).format("YYYY-MM-DD");
      
      this.api( this.company_profile, this.client_id, this.fromdate, this.todate,"view");
    },
    
      api(company_profile, client_id, fromdate, todate,type) {
      this.$validator.validate().then(valid => {
        if (valid) {
          let formData = new FormData();
          formData.append("company_profile", company_profile);
          formData.append("client_id",client_id);
          formData.append("fromdate",fromdate);
          formData.append("todate",todate);
          switch(type){
            case "view":
              let url = "/clientstatementpreview";
              axios.post(url,formData).then(response => {
                this.resultclientstatement = response.data.clientstatementpreview;
                console.log("Response",response.data.clientstatementpreview);
              })
               .finally(() => {
                this.setLoading(false);
              });
            break;
            case "download":
                this.setLoading(true);
              axios({
                
                  url:"/clientstatement" ,
                  data: formData,
                  method: "post",
                  responseType: "blob" // important for pdf download
              })
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
            break;
          }
          
        }
           this.setLoading(false);
 });
      
    }
    },
    
      
     mounted: function() {
      this.getcompany();
     
  },
 };

</script>
