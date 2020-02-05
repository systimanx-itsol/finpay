<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>
    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add User Account</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
      
          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Users Account</a>
          </li>
        </ul>
      </nav>
    </div>


    <section class="container forms-sec has-background-white box">
      <a href="/Account" class=" has-text-grey-dark     backsection"><i class="fas fa-arrow-left"></i>Back</a>
      <div class="columns">
        <div class="column">
                           <p class="bd-notification is-info">
            <label>
             Name <span class="has-text-danger">*</span>
            </label>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="Name">
              </p>
            </div>
          </p>
         </div>
        
        <div class="column">
           <p class="bd-notification is-info">
            <label>
               Email <span class="has-text-danger">*</span>
            </label>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="Email">
              </p>
            </div>
          </p>
         </div>
      </div>

      <button class="button is-dark is-small is-pulled-right">Generate Key</button>
      <button class="button is-small has-background-light is-pulled-right clearbuton">Clear Key</button>
    </section>
  <layout-footer></layout-footer>
  </section>
</template>

<script>
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import { Validator } from "vee-validate";
export default {
  components: {
    LayoutHeader,
    LayoutFooter
  },
    data(){
      return{
        current:{
        },
        arr:[]
      }
    } ,
  methods: {
    addCurrent() {
        this.arr.push(JSON.parse(JSON.stringify(this.current)));
    },
    deleteFiles(index) {
                this.arr.splice(index, 1)
            },

  }

};
</script>



