<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Revenue Client</h6>

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
                    <select id="company_profile" name="company_profile" v-model="revenueclient.company_profile" v-validate="'required'" class="select-companyprofile">
                      <option v-for="companies in companyprofile" @click="revenueclient.company_name = companies.company_name" v-bind:value="companies.id" :key="companies">
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
                Year <span class="has-text-danger">*</span>
              </label>
            <div class="field">  
              <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <select type="year" name="year" v-model="selectedYear" v-validate="'required'" >
                       <option :key="i" v-for="(year,i) in year" :value="year" :selected="i===0">
                                       {{year}}
                       </option>
                    </select>
                  </div>
                </div>
              </div>
                  <div v-show="errors.has('year')" class="invalid-feedback">{{yearError}}</div>
                  </div>
              </p>
             </div>
            </p>
          </div>
          </div>
           <button class="button is-dark is-pulled-right is-small" @click="downloadpdf" >Run report</button>
         <!-- <div v-if ="resultrevenueclient !=null"> -->

       <button2 class="button has-background-light is-small is-pulled-right clearbuton" @click="topdf" >Download pdf</button2>
      <div v-if ="resultrevenueclient !=null">
        <!-- <button class="button is-dark is-pulled-right is-small" @click="downloadpdf" >Run report</button>
         <div v-if ="resultrevenueclient !=null"> -->

       <!-- <button2 class="button is-dark is-pulled-right is-small" @click="topdf" >Download pdf</button2>
           <div ref="content" v-if ="resultrevenueclient !=null"> -->

             <!-- <h1 style="margin-bottom: 0;text-align: center;">{{resultclientstatement.company_name}}</h1> -->
    
    <br>
    <table class="table table-bordered">
        <thead>
       <tr>
            <th class="amount">Client</th> 
            <th class="amount">January</th> 
            <th class="amount">Febuary</th>
            <th class="amount">March</th>
            <th class="amount">April</th>
            <th class="amount">May</th>
            <th class="amount">June</th>
            <th class="amount">July</th>
            <th class="amount">August</th>
            <th class="amount">September</th>
            <th class="amount">October</th>
            <th class="amount">November</th>
            <th class="amount">December</th>
            <th class="amount">Total</th>
                 
      </tr>
        </thead>
        <tbody>
        <tr v-for ="(client,i) in resultrevenueclient" :key="i">
            <!-- <div v-if ="resultrevenueclient ==null"> -->
<!-- {{resultpaymentcollected.placement == 0 ? resultpaymentcollected.symbol : ''}}{{resultpaymentcollected.total_paid_amount}}{{resultpaymentcollected.placement == 1 ? resultpaymentcollected.symbol : ''}} -->
            <td class="amount" style="font-weight: bold;">{{client.client_name}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.January}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.February}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.March}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.April}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.May}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.June}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.July}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.August}}{{client.placement == 1 ? client.symbol: ''}}</td> 
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.September}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.October}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.November}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.December}}{{client.placement == 1 ? client.symbol: ''}}</td>
            <td class="amount" style="font-weight: bold;">{{client.placement == 0 ? client.symbol: ''}}{{client.Total}}{{client.placement == 1 ? client.symbol: ''}}</td>
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
  import moment,{ defaultFormat } from 'moment';
  

  export default {
    components: {
      LayoutHeader,
      LayoutFooter,
    
    },
    name: 'app',
     data() {
      return {
        companyprofile:[],
         year:[],

         resultrevenueclient: null,
        selectedYear:"",
        revenueclient:
        {
         company_profile: "",
         company_name:"",
          //  year: "",
        },

 
        submitted: false,
        editMode: false,

      
        validalphaspaces: "Only alphabet value accepted",
        numberAllowed: "Year is required",
        validcompanyname: "Company Name is required",
        validyear: "Year is required",
     }
     },
     computed: {
        ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
         companyError(){
       if(this.revenueclient.company_profile == "" || this.revenueclient.company_profile == null )
          return this.validcompanyname
          else
           return this.validalphaspaces
       },
      yearError(){
        if(this.year == "" || this.year == null )
          return this.validyear
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
      
        yearDisplay(){
          
          var tempyear = [];
          var now = new Date();
          for (let i = 0; i<=10 ; i++) { 
            tempyear.push(now.getFullYear() - i)
          }
           this.year = tempyear;
           console.log("tenyear",this.year);
        },
          downloadpdf() {
            // alert(1);
             
            this.submitted = true;
            this.setLoading(true);
      this.company_profile = this.revenueclient.company_profile;
    // console.log("company",this.company_profile);
    // console.log("year",this.year);
       this.api(  this.company_profile, this.selectedYear,"view");
    },
    
      api(company_profile, pass_year,type) {
      this.$validator.validate().then(valid => {
      if (valid) {
         let formData = new FormData();
      formData.append("company_profile", company_profile);
      formData.append("year",pass_year);
         switch(type){
            case "view":
              let url = "/revenueclientpreview";
              axios.post(url,formData).then(response => {
                this.resultrevenueclient = response.data.revenueclientpreview;
                console.log("Response",response.data.revenueclientpreview);
              })
               .finally(() => {
                this.setLoading(false);
              });
              
            break;
             this.setLoading(true);
            case "download":
              axios({
                  url:"/revenueclient" ,
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
      console.log("year",pass_year);
      console.log("company_profile",company_profile);
          
      // axios.post(url,formdata).then(response => {
      //   this.resultrevenueclient = response.data.revenueclient;
      // console.log("Response",this.resultrevenueclient);
   
    
      // }); 
            }
            }
               this.setLoading(false);
             });
//  });
      },
   
      
  
       topdf(){
          this.company_profile = this.revenueclient.company_profile;
          this.api( this.company_profile, this.selectedYear,"download");
              
      
            // const doc = new jsPDF();
            // const contentHtml = this.$refs.content.innerHTML;
            // doc.fromHTML(contentHtml, 15, 15, {
            //   width: 170
            // });
            // doc.save("sample.pdf");

          //    if (process.browser){
          //     var html2canvas =  require("html2canvas");
          //     var jsPDF = require("jspdf");
          //  }
          //   const doc = new jsPDF();
          //   /** WITH CSS */
          //   var canvasElement = document.createElement('canvas');
          //    html2canvas(this.$refs.content, { canvas: canvasElement 
          //       }).then(function (canvas) {
          //     const img = canvas.toDataURL("image/jpeg", 0.8);
          //     // doc.addImage(img,'JPEG',0,20);
          //     doc.addImage(img,'JPEG',0,20);

          //     doc.save("sample.pdf");
          //   });
      }
         

      },

     mounted: function() {
      this.getcompany();
     this.yearDisplay();
  },

 };
</script>