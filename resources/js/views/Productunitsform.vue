<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Product Units</h6>

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
      <a href="/Productunitstable" class=" has-text-grey-dark     backsection"><i class="fas fa-arrow-left"></i>Back</a>


      <form id="app" @submit.prevent="handleSubmit" validate>
        <div class="columns">
          <div class="column">
            <p class="bd-notification is-info">
              <label>
                Name <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="name" name="name"  v-model="product.name"
                    v-validate="'required|alpha_spaces'" placeholder=" Name">
                </p>
              
                <span v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</span>
              </div>
            </p>
          </div>
          <div class="column">
            <p class="bd-notification is-info">
              <label>
                Unit <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="unit" name="unit"  v-model="product.unit"
                    v-validate="'required|alpha_spaces'" placeholder=" Unit">
                </p>
               <span v-show="errors.has('unit')" class="invalid-feedback">{{unitError}}</span>
              </div>
            </p>
          </div>
 
            <div class="column">
            <p class="bd-notification is-info">
              <label>
                Status <span class="has-text-danger">*</span>
              </label>
              <div class="field">
               <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <select name="status" id="status" v-model="product.status" >
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
             <span v-show="errors.has('status')" class="invalid-feedback">{{status}}</span>
              </div>
            </p>
          </div>


        </div>
        <button class="button is-dark is-pulled-right is-small" >Submit</button>
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
        product:
        {
          name: '',
          unit: '',
          status: 1,
        },

        submitted: false,
        editMode: false,

        validalphaspaces: "Only alphabet value accepted",
        validname: "Name is required",
        validunit: "Unit is required",
      }
    },

     computed:{
         ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
      nameError(){
        if(this.product.name == "")
          return this.validname
        else
          return this.validalphaspaces
      },
      unitError(){
         if(this.product.unit == "")
          return this.validunit
        else
          return this.validalphaspaces
      }
    },
    mounted: function () {
      if (this.$route.query.id != '' && this.$route.query.id != null)
      this.editgetProduct();
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
        this.product = {
          name: '',
          unit: '',
        }
      },

      handleSubmit(e) {
         let context = this;
         context.setLoading(true);
        if (context.$route.query.id != '' && context.$route.query.id != null) {
          context.editMode = true;
          
          let url = '/ProductUnit/' + context.$route.query.id;
          axios.put(url, context.product).then((response) => {
            if (response.data.status == 1) {
              context.$buefy.toast.open({
                duration: 4000,
                message: response.data.message,
                title: "updated success",
                type: "is-success",
                position: "is-top-right",
              });
              context.$router.push('/Productunitstable');
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
          })
           .catch( error => { console.log(error); })
           .finally(() => {
                context.setLoading(false);
              });

        } else {  
          context.setLoading(true);
          context.submitted = true;
          context.$validator.validate().then(valid => {
            if (valid) {
              let url = '/ProductUnit';

              let config = {
                headers: {
                    Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                 //    'content-type': 'multipart/form-data',
                  'content-type': 'application/json'
                }

              }
              let formdata = new FormData();
              formdata.append('name', context.product.name);
              formdata.append('unit', context.product.unit);
              formdata.append('status',context.product.status);
              axios.post(url, formdata, config).then(response => {

                if (response.data.status == 1) {

                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "product units submitted successfully",
                    type: "is-success",
                    position: "is-top-right"
                  });
                  context.$router.push('/productunitstable');

                }
                else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "submitted failed",
                    position: "is-top-right",
                    type: "is-danger",
                  });
                //  context.$router.push('/productunitstable');
                }

              })
               .catch( error => { console.log(error); })
               .finally(() => {
                context.setLoading(false);
              });
            }
              context.setLoading(false);
          });
        }

      },
      editgetProduct() {
         this.setLoading(true);
    //    alert(1);
        let url = '/ProductUnit/' + this.$route.query.id;
        axios.get(url).then((response) => {
          this.product = response.data.product_unitDetails;
          console.log(this.product);

        })
         .finally(() => {
                this.setLoading(false);
              });
        // this.$router.push('/productunitstable');
      },
     
    }
  };
</script>