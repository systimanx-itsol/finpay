<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add List Payment Method</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Payment Method</a>
          </li>
        </ul>
      </nav>
    </div>


    <section class="container forms-sec has-background-white box">
      <a href="/Paymentmethod" class=" has-text-grey-dark     backsection"><i class="fas fa-arrow-left"></i>Back</a>


      <form id="app" @submit.prevent="handleSubmit" validate>
        <div class="columns">
          <div class="column">
            <p class="bd-notification is-info">
              <label>
                Payment Method <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="name" name="name" max-length="20" v-model="payment.name"
                    v-validate="'required|alpha_spaces'" placeholder="Payment Method">
                </p>
              <!-- <span v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</span> -->
                <div v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</div>
                
              </div>
            </p>
          </div>
        </div>
<button  class="button is-dark is-pulled-right is-small"  
           >Submit</button>
        <button2 class="button has-background-light is-small is-pulled-right clearbuton" @click="clear">Clear</button2>
        
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
         loading:false,
            submitted: false,
         payment:
        {
          name: '',
        },
        submitted: false,
        editMode: false,

        validalphaspaces: "Only alphabet value accepted",
        validname: "Payment Method is required",
      }
    },

    computed:{
       ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
      nameError(){
        if(this.payment.name == "")
          return this.validname
        else
          return this.validalphaspaces
      }
    },

    mounted: function () {
       this.editgetpayment();
     },

    methods: {

       ...mapActions({
      setLoading: "setLoading"
    }),
    //    doSomething() {
    //   // we only continue if not clicked before
    //   if (this.submitted) {
    //     return;
    //   }
    //   this.submitted = true;

    //   // do something to process the like

    //   // at some point release the 'clicked' state
    //   this.submitted = false;

    //   // or if you want to release the clicked state after a second (for whatever reason)
    //   setTimeout(
    //     function() {
    //       this.submitted = false;
    //     }.bind(this),
    //     1000
    //   );
    // },
       clear() {
          this.payment = {
              name: '',
         }
      },

      handleSubmit(e) {
      //  alert(4);
       let context = this;
         context.setLoading(true);
        if (context.$route.query.id != '' && context.$route.query.id != null) {
            context.editMode = true;
            context.submitted = true;
        //  context.$validator.validateAll().then(valid => {
         context.$validator.validate().then(valid => {
         //context.validate().then(valid => {
            if (valid) {
             // context.loading=true;
              let url = '/PaymentMethod/' + context.$route.query.id;
              axios.put(url, context.payment).then((response) => {
              if (response.data.status == 1) {
              context.$buefy.toast.open({
                duration: 4000,
                message: response.data.message,
                title: "updated success",
                type: "is-success",
                position: "is-top-right",
              });
              context.$router.push('/paymentmethod');
            }
            else {
              context.$buefy.toast.open({
                duration: 1000,
                message: response.data.message,
                title: "updated failed",
                position: "is-top-right",
                type: "is-danger"
              });
            }
          //  console.log(response)
          })
           .catch( error => { console.log(error); })
          .finally(()=>{
            context.setLoading(false);
          });
            }
             context.setLoading(false);
          });
        

        } else {
       //   alert(5);
       context.setLoading(true);
              context.submitted = true;
         //    alert(55);
          //     alert('SUCCESS!! :-)\n\n' + JSON.stringify(context.payment))
               context.$validator.validate().then(valid => {
              //  alert('SUCCESS!! :-)\n\n' + JSON.stringify(context.payment))
           //     alert(6);
               if (valid) {
           //      alert(7);
            
            let url = '/PaymentMethod';
            context.loading=true;
            let config = {
                headers: {
                   Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                   // 'content-type': 'multipart/form-data',
                      'content-type': 'application/json'
                }

              }
              let formdata = new FormData();
              formdata.append('name', context.payment.name);
              axios.post(url, formdata, config).then(response => {
                
              //  console.log(response.data.status)
                if (response.data.status == 1) {
                   context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "payment method submitted successfully",
                    type: "is-success",
                    position: "is-top-right"
                  });
                   context.$router.push('/paymentmethod');
                }
                else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "submitted failed",
                    position: "is-top-right",
                    type: "is-danger",
                  })
                }
              })
               
             .catch( error => { console.log(error); })
             .finally(()=>{
            context.setLoading(false);
          });

              
              // .finally(()=>{
              //   context.loading=false;
              // });
              
               }
                 context.setLoading(false);
          });
         }

      },
      editgetpayment() {
        this.setLoading(true);
           let url = '/PaymentMethod/' + this.$route.query.id;
            this.loading=true;
           axios.get(url).then((response) => {
           this.payment = response.data.payment_methodDetails;
        }) 
        .finally(() => {
                this.setLoading(false);
              });
      
      },
    
    }
  };
</script>