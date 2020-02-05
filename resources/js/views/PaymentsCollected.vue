<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Payments Collected</h6>

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
                    <select id="company_profile" name="company_profile" v-model="paymentcollected.company_profile" v-validate="'required'" class="select-companyprofile">
                      <option v-for="companies in companyprofile" v-bind:value="companies.id">
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
                From Date <span class="has-text-danger">*</span>
              </label>
            <div class="field"> 
               <p class="control has-icons-left has-icons-right">
                           <b-datepicker type="from_date" id="from_date" name="from_date" v-model="paymentcollected.from_date" v-validate="'required'"
                          placeholder="enter date.." icon="calendar-today">
                           </b-datepicker>
                        </p> 
             </div>
              <div v-show="errors.has('from_date')" class="invalid-feedback">{{fromdateError}}</div>
            </p>
          </div> 
            <div class="column">
            <p class="bd-notification is-info">
              <label>
                To Date <span class="has-text-danger">*</span>
              </label>
            <div class="field"> 
               <p class="control has-icons-left has-icons-right">
                           <b-datepicker type="to_date" id="to_date" name="to_date" v-model="paymentcollected.to_date" v-validate="'required'"
                          placeholder="enter date.." icon="calendar-today">
                           </b-datepicker>
                        </p> 
                  <div v-show="errors.has('to_date')" class="invalid-feedback">{{todateError}}</div>        
             </div>
            </p>
          </div>

        </div>

         
        <button class="button is-dark is-pulled-right is-small" @click="downloadpdf" >Run report</button>
       
       <button2 class="button has-background-light is-small is-pulled-right clearbuton" @click="topdf" >Download pdf</button2>
       <div v-if ="resultpaymentcollected !=null">
      <!-- <div  ref="content" v-if ="resultpaymentcollected !=null"> -->
    <h1 style="margin-bottom: 0;text-align: left;">{{resultpaymentcollected.company_name}}</h1>
    <h1 style="margin-bottom: 0;text-align: left;">{{this.fromdate}} - {{this.todate}}</h1>
    
    <br>
    <table class="table table-bordered">
        <thead>
       <tr>
            <th class="amount">Date</th> 
            <th class="amount">Invoice</th>
            <th class="amount">Client</th>
            <th class="amount">Payment Method</th>
            <th class="amount">Note</th>
            <th class="amount">Amount</th>
       </tr>
        </thead>
        <tbody>
        <tr v-for ="(paymentcollected,i) in resultpaymentcollected" :key="i">
            <td class="amount" style="font-weight: bold;">{{paymentcollected.payment_date}}</td>
            <td class="amount" style="font-weight: bold;">{{paymentcollected.invoice_number}}</td>
            <td class="amount" style="font-weight: bold;">{{paymentcollected.client_name}}</td>
            <td class="amount" style="font-weight: bold;">{{paymentcollected.name}}</td>
            <td class="amount" style="font-weight: bold;">{{paymentcollected.note}}</td>
            <td class="amount" style="font-weight: bold;">{{paymentcollected.placement == 0 ? paymentcollected.symbol : ''}}{{(paymentcollected.payment_amount).toFixed(paymentcollected.decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, paymentcollected.thousands)}}{{paymentcollected.placement == 1 ? paymentcollected.symbol : ''}}</td>
           
        </tr>
        </tbody>
    </table>
         </div>
          </div>
          </form>
      </section>
    <layout-footer></layout-footer>
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


        resultpaymentcollected: null,

        paymentcollected:
        {
         company_profile: "",
         from_date:"",
         to_date:"",

        },


        submitted: false,
        editMode: false,
      
      
        validalphaspaces: "Only alphabet value accepted",
        numberAllowed: "Only numeric value accepted",
        validcompanyname: "Company Name is required",
        validfromdate: "From date is required",
        validtodate: "To date is required",

     }
     },
     computed:{
        ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
        companyError(){
       if(this.paymentcollected.company_profile == "" || this.paymentcollected.company_profile == null )
          return this.validcompanyname
          else
           return this.validalphaspaces
       },
        fromdateError(){
        if(this.paymentcollected.from_date == ""  || this.paymentcollected.to_date == null )
          return this.validfromdate
        else
          return this.numberAllowed  
       
       },
       todateError(){
           if(this.paymentcollected.to_date == ""  || this.paymentcollected.to_date == null)
          return this.validtodate
        else
          return this.numberAllowed  
       }
     },
    methods: {
      ...mapActions({
      setLoading: "setLoading"
    }),
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

      //      topdf(){
      //       if (process.browser){
      //         var html2canvas =  require("html2canvas");
      //         var jsPDF = require("jspdf");
      //      }
      //       const doc = new jsPDF();
      //       /** WITH CSS */
      //       var canvasElement = document.createElement('canvas');
      //        html2canvas(this.$refs.content, { canvas: canvasElement 
      //           }).then(function (canvas) {
      //         const img = canvas.toDataURL("image/jpeg", 0.8);
      //         doc.addImage(img,'JPEG',0,20);
      //         doc.save("sample.pdf");
      //       });
      // },
              
    downloadpdf() {
       this.setLoading(true);
         this.submitted =true;
         this.company_profile = this.paymentcollected.company_profile;
         this.fromdate = moment(this.paymentcollected.from_date).format("YYYY-MM-DD");
         this.todate = moment(this.paymentcollected.to_date).format("YYYY-MM-DD");
    //  console.log(this.fromdate,"fromdate"),
    //  console.log(this.todate,"todate"),
         this.api(  this.company_profile, this.fromdate, this.todate,"view");
    },
    
        api(company_profile,fromdate, todate,type) {

    this.$validator.validate().then(valid => {
            if (valid) {
     
       
        let formData = new FormData();

        formData.append("company_profile", company_profile);
        formData.append("fromdate",fromdate);
        formData.append("todate",todate);
  switch(type){
            case "view":
              let url = "/paymentcollectedpreview";
              axios.post(url,formData).then(response => {
                this.resultpaymentcollected = response.data.paymentcollectedpreview;
                console.log("Response",response.data.paymentcollectedpreview);
              })
                 .finally(() => {
                this.setLoading(false);
              });
            break;
            case "download":
               this.setLoading(true);
              axios({
                  url:"/paymentcollected" ,
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
      //   axios.post(url,formdata).then(response => {
      //   this.resultpaymentcollected = response.data.paymentcollected;
      //   // console.log("paymentcollected",this.paymentcollected);
      //  }); 
     }
       }
       this.setLoading(false);
    });
     
       },

   topdf(){
       this.company_profile = this.paymentcollected.company_profile;
         this.fromdate = moment(this.paymentcollected.from_date).format("YYYY-MM-DD");
         this.todate = moment(this.paymentcollected.to_date).format("YYYY-MM-DD");
        this.api(  this.company_profile, this.fromdate, this.todate,"download"); 
   }
   },     
     mounted: function() {
      this.getcompany();
  },
 };
</script>