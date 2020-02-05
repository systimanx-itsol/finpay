<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Category</h6>

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
      <a href="/Categorytable" class=" has-text-grey-dark     backsection"><i class="fas fa-arrow-left"></i>Back</a>

      <form id="app" @submit.prevent="handleSubmit" validate>
        <div class="columns is-multiline is-mobile">
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Category <span class="has-text-danger">*</span></label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="control is-expanded ">
                    <treeselect id="parentcategory" name="parentcategory" :options="options" placeholder="Select your Category(s)..." v-model="category.parentcategory"  
                      v-validate="'required'"  class="is-radiusless"  />
                     
                  </div>
                     <span v-show="errors.has('parentcategory')" class="invalid-feedback">{{parentcategoryError}}</span>    
                </div>
             
              </div>
            </p>
 </div> 
  
  <div class="column is-3 is-12-mobile">
          
           <p class="bd-notification is-info">
              <label>
                Name <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="name" name="name" max-lenght="25" v-model="category.name"
                    v-validate="'required'" placeholder="Name">
                </p>
                 <span v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</span>  
             </div>
            </p>
           
            </div>
        

          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Position <span class="has-text-danger">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="position" name="position" max-lenght="25" v-model="category.position"
                    v-validate="'required|numeric'" placeholder="Position">
                </p>
                 <span v-show="errors.has('position')" class="invalid-feedback">{{positionError}}</span>
              </div>
            </p>  </div>

              <div class="column is-3 is-12-mobile"> 
            <p class="bd-notification is-info singleimages">
              <label>Image </label>
              <img v-if="file ==null && image != ''" v-bind:src="image" style="width:40px">
              <b-field class="file">
                <b-upload v-model="file" ref="file">
                  <a class="button is-dark">
                    <span><i class="fas fa-upload"></i>Click to upload</span>
                  </a>
                </b-upload>
                <span class="file-name" v-if="file">
                  {{ file.name }}
                </span>
              </b-field>
            </p>
         </div>
            <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Description
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <textarea placeholder="Description" class="textarea is-small is-shadowless" id="description" name="description"
                    max-length="25" v-model="category.description"></textarea> </p>
                </div>
            </p>
         </div>

<div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Status <span class="has-text-danger">*</span></label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <div class="select is-fullwidth">
                    <select name="status" id="status" v-model="category.status" v-validate="'required'">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                     <span v-show="errors.has('statusError')" class="invalid-feedback">{{statusError}}</span>
                   </div>
                </div>
               </div>
            </p>
      
        </div>
        </div>
        <button class="button is-dark is-pulled-right is-small">Submit</button>
        <button class="button has-background-light is-small is-pulled-right clearbuton" @click="clear">Clear</button>
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
  import axios from "axios"
  import Treeselect from '@riophae/vue-treeselect'
  import '@riophae/vue-treeselect/dist/vue-treeselect.css'


  export default {
    components: {
      Treeselect,
      LayoutHeader,
      LayoutFooter
   },

    data() {
      return {
         submitted: false,
         options: [],
          file:null,
       category: {
          name: '',
          image: '',
          parentcategory: null,
          description: '',
          position: '',
          status: 1,
        },

        editMode: false,
        submitted: false,

        validalphaspaces: "Only alphabet value accepted",
        numberAllowed: "Only numeric value accepted",

        validcategory: "Category is required",
        validname: "Name is required",
        validposition: "Position is required",
        validstatus: "Status is required"
      }
    },

     computed:{

       ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

       parentcategoryError(){
       if(this.category.parentcategory == "" || this.category.parentcategory == null )
          return this.validcategory
       },
       nameError(){
        if(this.category.name == "")
          return this.validname
        else
          return this.validalphaspaces  
       },
       positionError(){
        if(this.category.position == "")
         return this.validposition
        else
         return this.numberAllowed 
      },
      statusError(){
       if(this.category.status == "")
         return this.validstatus
       
      }
    },

      created: function () {
      this.getCategories();
    },

    mounted: function () {
      if(this.$route.query.id != '' && this.$route.query.id != null)
      this.editCategory();
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
        this.file =null;
        this.category = {
          
          name: '',
          image: '',
          parentcategory: null,
          position: '',
          description: '',
          status: '',
        }
      },

      getCategories() {
         this.setLoading(true);
        // alert(5);
         let url = '/listCategory';
         axios.get(url).then(response => {
         this.options = response.data.category;
      })
       .finally(() => {
                this.setLoading(false);
              });
      },

      handleSubmit() {
           let context = this;
        context.setLoading(true);
        if (context.$route.query.id != '' && context.$route.query.id != null) {
          if (context.editMode === true) {
                let url = '/UpdateCategory/' + context.$route.query.id;
                let config = {
                     headers: {
                          
                       Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                      'content-type': 'multipart/form-data',
                      'content-type': 'application/json'
                     }
                  };
                  let formdata = new FormData();
                  context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;

                  formdata.append('name', context.category.name);
                  formdata.append('parentcategory', context.category.parentcategory);
                //  if(context.image != '');
                  if(context.file){
                    formdata.append('image', context.file);
                  }
                  if(context.file==null){
                    formdata.append('image_name', context.image);
                  }
                  formdata.append('position', context.category.position);
                  formdata.append('description', context.category.description);
                  formdata.append('status', context.category.status);
                 
                  axios.post(url, formdata, config).then(response => {
                  
                     if (response.data.status == 1) {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           title: "submitted success",
                           type: "is-success",
                           position: "is-top-right"
                        });
                        context.$router.push('/categorytable');
                     } else {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           position: "is-bottom-right",
                           type: "is-danger"
                        });
                      }
                  })
                   .catch( error => { console.log(error); })
                    .finally(() => {
                context.setLoading(false);
              });
                }
        } else {
          context.submitted = true;
            context.setLoading(true);
          context.$validator.validate().then(valid => {
            if (valid) {
              let url = '/Category';
              let config = {
                headers: {
                    Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                   'content-type': 'multipart/form-data', 
                  // 'content-type': 'application/json',
                 }
              }
           
              let formdata = new FormData();
            
              formdata.append('name', context.category.name);
              formdata.append('parentcategory', context.category.parentcategory);
             // if(context.image != '');
              formdata.append('image', context.file);
            //  formdata.append('image',obj);
              formdata.append('position', context.category.position);
                if(context.category.description != undefined)
              formdata.append('description', context.category.description);
              formdata.append('status', context.category.status);

              axios.post(url, formdata, config).then(response => {
               
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "category submitted successfully",
                    type: "is-success",
                    position: "is-top-right"
                  });
                  context.$router.push('/categorytable');
                }
                else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "submitted failed",
                    position: "is-top-right",
                    type: "is-danger",
                  });
                //  context.$router.push('/categorytable');
                }

              })
             .catch( error => { console.log(error); })
              .finally(() => {
                context.setLoading(false);
              });
            }
             else{
                     context.setLoading(false);
                    }
          });
        }

      },
      editCategory() {
         this.setLoading(true);
         this.editMode = true;
        let url = '/Category/' + this.$route.query.id;
        axios.get(url).then((response) => {
        this.category = response.data.category_unitDetails;
         
        this.image = this.category.image;
           this.category.image='';
          
        console.log("testcategory",this.category);
        console.log("Testcategories",response.data.category_unitDetails);

        })
        .finally(() => {
                this.setLoading(false);
              });

      },
    }
  };

</script>