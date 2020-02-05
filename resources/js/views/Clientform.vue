<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>
    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add CLIENT</h6>
      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Users</a>
          </li>
          <li class="is-size-7 is-active">
            <a class="" href="#" aria-current="page">Client</a>
          </li>
        </ul>
      </nav>
    </div>

    <section class="container forms-sec has-background-white	box">
      <router-link to="/clienttable" class=" has-text-grey-dark     backsection"><i class="fas fa-arrow-left"></i>Back</router-link>
      <form id="app" @submit.prevent="handleSubmit" validate>
        <div class="columns is-mobile is-multiline ">
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Client Name <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="client_name" name="client_name" maxlength="25" v-model="user.client_name"
                    v-validate="'required|alpha_spaces'" placeholder=" Name">
                </p>
                <span v-show="errors.has('client_name')" class="invalid-feedback">{{nameError}}</span> 
               
              </div>
            </p>
          </div>
             <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Email <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="email" name="email" maxlength="100" v-validate="'required|email'"
                    v-model="user.email" placeholder="Email">
                </p>
                <span v-show="errors.has('email')" class="invalid-feedback">{{validEmail}}</span>
              </div>
            </p>

             </div>
           
          
          <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>City <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="city" name="city" max-length="20" v-validate="'required|alpha_spaces'"
                    v-model="user.city" placeholder="City">
                </p>
               <span v-show="errors.has('city')" class="invalid-feedback">{{cityError}} </span> 
            
              </div>
            </p>
</div>
 <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>State <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="state" name="state" v-validate="'required|alpha_spaces'"
                    v-model="user.state" placeholder="State">
                </p>
             
                <span v-show="errors.has('state')" class="invalid-feedback">{{stateError}}</span>
              </div>
            </p>
 </div>
  <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Postal Code <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="postal_code" name="postal_code"  v-validate="'required|numeric'"
                    v-model="user.postal_code" placeholder="Postal Code">
                </p>
             
                <span v-show="errors.has('postal_code')" class="invalid-feedback">{{postalcodeError}}</span>
              </div>
            </p>
  </div>
   <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Country <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="country" name="country" maxlength="25" v-validate="'required|alpha_spaces'"
                    v-model="user.country" placeholder="Country">
                </p>
                
                <span v-show="errors.has('country')" class="invalid-feedback">{{countryError}}</span>
              </div>
            </p>
          </div>
         
             <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Phone Number</label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text"
                   id="phone_number" name="phone_number" 
                   pattern="[0-9]+" 
                   title="Enter 10 digit phone number" 
                   placeholder="Phone Number" 
                
                    v-model="user.phone_number" >
                </p>
                <!-- <div v-if="submitted && errors.has('phone_number')" class="invalid-feedback">{{invalid}} </div> -->
               
              </div>
            </p>
             </div>
              <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Fax Number
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="fax_number" name="fax_number"  pattern="[0-9]+"
                    v-model="user.fax_number" placeholder="Fax Number">
                </p>
                
              </div>
            </p>
              </div>
               <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Mobile Number</label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="mobile_number" name="mobile_number"
                    v-model="user.mobile_number" pattern="[0-9]+"  title="Enter 10 digit mobile number" placeholder="Mobile Number">
                </p>
                              

              </div>
            </p>
</div>
<div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Website Address </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="web_site" name="web_site"  v-model="user.web_site"
                    placeholder="Website Address">
                </p>
                <!-- <div v-if="submitted && errors.has('web_site')" class="invalid-feedback">{{validwebsite}} </div>           -->
                <span v-show="errors.has('web_site')" class="invalid-feedback">{{validwebsite}}</span>
              </div>
            </p>
</div>
         
            <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Default Currency<span class="has-text-danger	">*</span></label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <!-- <select name="default_currency" id="default_currency" v-model="user.default_currency">
                      <option value="0">SGD</option>
                      <option value="1">MYR</option>
                    </select> -->

                    <select id="default_currency" name="default_currency" v-model="user.default_currency" class="select-defaultcurrency" v-validate="'required'">
                      <option v-for="currencies in defaultcurrency" v-bind:value="currencies.id">
                            {{currencies.code}}
                         </option>     
                      </select>
                        <span v-show="errors.has('default_currency')" class="invalid-feedback">{{defaultcurrencyError}} </span> 
                  </div>
                </div>
               
              </div>
            </p>
            </div>
            <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Tax Number<span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="tax_code" name="tax_code"  v-validate="'required'"
                    v-model="user.tax_code" placeholder="Tax Number">
                </p>
               
                <span v-show="errors.has('tax_code')" class="invalid-feedback">{{taxcodeError}}</span>
              </div>
            </p>
            </div>
               <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Address <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <textarea placeholder="Address" class="textarea is-small is-shadowless" id="address" name="address"
                    max_length="200" v-model="user.address" v-validate="'required'"></textarea>
                </p>
                <!-- <div v-if="submitted && errors.has('address')" class="invalid-feedback">{{address}}</div> -->
                  <span v-show="errors.has('address')" class="invalid-feedback">{{addressError}}</span>
              </div>
            </p>
              </div>
                        <div class="column is-3 is-12-mobile">

            <p class="bd-notification is-info">
              <label>Status</label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <select name="status" id="status" v-model="user.status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
            </p>

        </div></div>
        <button class="button is-dark is-pulled-right is-small" >Submit</button>
        <button4 class="button has-background-light is-small is-pulled-right clearbuton" @click="clear"> Clear </button4>
      </form>
    </section>
    <layout-footer></layout-footer>
  </section>
</template>

<script>
  import { mapState, mapActions, mapGetters } from "vuex";
  import LayoutHeader from "./layouts/Header.vue";
  import LayoutFooter from "./layouts/Footer.vue";
  import { Validator } from "vee-validate";
  export default {
    components: {
      LayoutHeader,
      LayoutFooter
    },
    name: 'app',
    data() {
      return {
        defaultcurrency:[],
        user:
        {
          client_name: '',
          email: '',
          address: '',
          city: '',
          state: '',
          postal_code: '',
          country: '',
          phone_number: '',
          mobile_number: '',
          fax_number: '',
          web_site: '',
          default_currency: '',
          tax_code: '',
          status: 1,

        },


        submitted: false,
        editMode: false,

      
        validalphaspaces: "Only alphabet value accepted",
        numberAllowed: "Only numeric value accepted",
         validname: "Client Name is required",
        validEmail: "Email is required",
        validaddress: "Address is required",
        validcity: "City is required",
        validstate: "State is required",
        validpostalcode: "Postal code is required",
        validcountry: "Country is required",
        validtax_code: "Tax Number is required",
        validdefault_currency: "Default Currency is required",
      

      }
    },
    computed:{

        ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
      nameError(){
        if(this.user.client_name == "")
          return this.validname
        else
          return this.validalphaspaces
      },
      addressError(){
        if(this.user.address == "")
        return this.validaddress
      },
      cityError(){
         if(this.user.city == "")
         return this.validcity
       else
         return this.validalphaspaces
      },
      stateError(){
           if(this.user.state == "")
         return this.validstate
       else
         return this.validalphaspaces
      },
     postalcodeError(){
        if(this.user.postal_code == "")
         return this.validpostalcode
       else
         return this.numberAllowed
     },
    countryError(){
       if(this.user.country == "")
         return this.validcountry
       else
         return this.validalphaspaces
    },
    taxcodeError(){
       if(this.user.tax_code == "")
         return this.validtax_code
    },
    defaultcurrencyError(){
        if(this.user.default_currency == "")
         return this.validdefault_currency
           else
         return this.validalphaspaces
    }

      },


  
    //page reference call mounted
    mounted: function () {
      if (this.$route.query.id != '' && this.$route.query.id != null) 
      this.editgetUser();
      this.getdefaultcurrency();
    },

   
    methods: {
       ...mapActions({
      setLoading: "setLoading"
    }),
      
      clear() {
        this.user = {
          client_name: '',
          email: '',
          address: '',
          city: '',
          state: '',
          postal_code: '',
          country: '',
          phone_number: '',
          mobile_number: '',
          fax_number: '',
          web_site: '',
          default_currency: '',
          tax_code: '',
          status: '',
        }
      },
      handleSubmit(e) {
        // alert(1);
         let context = this;
        context.submitted = true;
        if (context.$route.query.id != '' && context.$route.query.id != null) {
          // alert(2);
          context.editMode = true;
          context.submitted = true;
          context.setLoading(true);
           context.$validator.validate().then(valid => {
            //  alert(3);
            //    alert('SUCCESS!! :-)\n\n' + JSON.stringify(context.user));
            if (valid) {
          
          let url = '/Client/' + context.$route.query.id;
          axios.put(url, context.user).then((response) => {
            if (response.data.status == 1) {
              context.$buefy.toast.open({
                duration: 4000,
                message: response.data.message,
                title: "client details updated successfully",
                type: "is-success",
                position: "is-top-right",
              });
                context.$router.push('/Clienttable');
           }
            else {
              context.$buefy.toast.open({
                duration: 1000,
                message: response.data.message,
                title: "updated failed",
                position: "is-right-right",
                type: "is-danger"
              });

            }
            context.$router.push('/Clienttable');
          
          })
           .catch( error => { console.log(error);
            })
            .finally(() => {
                context.setLoading(false);
              });
            }
            else{
                     context.setLoading(false);
                    }
           });
             

        } else {
          context.submitted = true;
          context.setLoading(true);
          context.$validator.validate().then(valid => {
            if (valid) {
              let url = '/Client';
              // console.log(url);
              let config = {
                headers: {
                  Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                    //  'content-type': 'multipart/form-data',
                      'content-type': 'application/json'
                }
              }
              let formdata = new FormData();
              formdata.append('client_name', context.user.client_name);
              formdata.append('email', context.user.email);
              formdata.append('address', context.user.address);
              formdata.append('city', context.user.city);
              formdata.append('state', context.user.state);
              formdata.append('postal_code', context.user.postal_code);
              formdata.append('country', context.user.country);
              formdata.append('phone_number', context.user.phone_number);
              formdata.append('fax_number', context.user.fax_number);
              if(context.user.mobile_number != undefined)
              formdata.append('mobile_number', context.user.mobile_number);
              formdata.append('web_site', context.user.web_site);
              formdata.append('default_currency', context.user.default_currency);
              formdata.append('tax_code', context.user.tax_code);
              formdata.append('status', context.user.status);
              axios.post(url, formdata, config).then(response => {
               // console.log(response.data.status)
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "client details submitted successfully",
                    type: "is-success",
                    position: "is-top-right"
                  });
                  context.$router.push('/clienttable');
                }
                else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "submitted failed",
                    position: "is-top-right",
                    type: "is-danger",
                  });
                  // context.$router.push('/clienttable');
                }
              })
               .catch( error => { console.log(error); })
               .finally(() => {
                context.setLoading(false);
              });
            }else{
                     context.setLoading(false);
                    }
          });
        }
      },

      editgetUser() {
         this.setLoading(true);
        // this.editMode = true,
        let url = '/Client/' + this.$route.query.id;
        axios.get(url).then((response) => {
          this.user = response.data.clientDetails;
        //  console.log(this.user);
        })
        .finally(() => {
                this.setLoading(false);
              });
      },

        getdefaultcurrency() {
            let url = '/Currencies';
             axios.get(url).then((response) => {
               this.defaultcurrency = response.data.currenciesDetails;
        
            });
         },
    }
  };
</script>
<style>
  input.input {
    font-size: 13px !important;
    padding: 16px !important;
    border-right-color: #ddd !important;

    border-radius: 0px;
  }

  label {
    font-size: 14px;
    font-weight: 400;
    line-height: 2.5;
    color: #646367;
  }

  select {
    color: #ddd !important;
    font-size: 14px !important;
    font-weight: 400;
    height: 35px !important;
  }

  .select:not(.is-multiple):not(.is-loading)::after {


    top: 58% !important;


    width: 0 !important;
    border-color: #888 transparent transparent transparent !important;
    border-style: solid !important;
    border-width: 5px 4px 0 4px !important;
    height: 0 !important;
    transform: unset;
    border-radius: 0;

  }

  .forms-sec {



    box-shadow: 0 1px 15px 1px rgba(208, 201, 243, .5);
    padding: 35px;
  }

  select {
    color: #000 !important;
  }

  .invalid-feedback {
    color: red;
  }
</style>