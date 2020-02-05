<template>
   <section class="hero is-fullheight is-default is-bold drop-special">
      <layout-header></layout-header>
      <div class="container containeg breadcrums1">
         <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add  Recurring Invoices
          </h6>
         <div class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
            <button class="button has-background-dark has-text-white is-size-7"><i class="fas fa-print icon1"></i> PDF</button>
            <b-dropdown hoverable>
               <button class="button has-background-dark has-text-white is-size-7" slot="trigger">
               <span>OTHERS</span>
               <span style="padding-left:8px"><i class="fas fa-caret-down"></i> </span></button>
               </button>
               <b-dropdown-item class="has-text-dark is-size-7 has-text-left"><i class="fas fa-copy icon1"></i>Copy</b-dropdown-item>
               <b-dropdown-item class="has-text-dark is-size-7 has-text-left"><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item>
            </b-dropdown>
            <button class="button has-background-dark has-text-white is-size-7">
               <router-link to="/Recurringinvoice" class="has-text-white">    <i class="fas fa-backward icon1"></i> BACK
               </router-link>
            </button>
            <button class="button has-background-dark has-text-white is-size-7"><i class="far fa-save icon1"></i>SAVE</button>
         </div>
      </div>
      <div class="container containeg is-clearfix">
         <div class="columns is-clearfix">
            <div class="column is-four-fifths">
               <div class="columns">
                  <div class="column">
                     <div class="card">
                        <header class="card-header">
                           <p class="card-header-title">From</p>
                           <b-dropdown hoverable>
                              <a href="#" class="card-header-icon" slot="trigger" aria-label="more options">
                              <span class="icon">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                              </span>
                              </a>
                              <!-- <b-dropdown-item> <i class="fas fa-file icon1"></i> Save</b-dropdown-item> -->
                              <b-dropdown-item><i class="fas fa-edit icon1"></i> Edit</b-dropdown-item>
                              <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                           </b-dropdown>
                        </header>
                        <div class="card-content">
                           <div class="content">
                              <h6 class="is-size-6 name-title">Lavnaya Arumugam</h6>
                              <p class="address">
                                 1725 Slough Ave
                                 Scranton, PA 18505
                                 <br>Phone:984595454
                                 <br>Email: demo@fusioninvoice.com
                              </p>
                           </div>
                        </div>
                        <!-- <footer class="card-footer">
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Save</a>
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Edit</a>
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Delete</a>
                           </footer> -->
                     </div>
                  </div>
                  <div class="column">
                     <div class="card">
                        <header class="card-header">
                           <p class="card-header-title">To</p>
                           <b-dropdown hoverable>
                              <a href="#" class="card-header-icon" slot="trigger" aria-label="more options">
                              <span class="icon">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                              </span>
                              </a>
                              <!-- <b-dropdown-item> <i class="fas fa-file icon1"></i> Save</b-dropdown-item> -->
                              <b-dropdown-item><i class="fas fa-edit icon1"></i> Edit</b-dropdown-item>
                              <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                           </b-dropdown>
                        </header>
                        <div class="card-content">
                           <div class="content">
                              <h6 class="is-size-6 name-title">Lavnaya Arumugam</h6>
                              <p class="address">
                                 1725 Slough Ave
                                 Scranton, PA 18505
                                 <br>Phone:984595454
                                 <br>Email: demo@fusioninvoice.com
                              </p>
                           </div>
                        </div>
                        <!-- <footer class="card-footer">
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Save</a>
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Edit</a>
                           <a href="#" class="card-footer-item has-background-grey-darker is-paddingless has-text-white is-size-7 is-uppercase">Delete</a>
                           </footer> -->
                     </div>
                  </div>
               </div>
               <div class="card">
                  <header class="card-header">
                     <p class="card-header-title">Items</p>
                     <a href="#" class="card-header-icon" aria-label="more options">
                        <!-- <span class="icon">
                           <i class="fas fa-angle-down" aria-hidden="true"></i>
                           </span> -->
                     </a>
                  </header>
                 <div class="card-content">
                     <div class="columns">
                        <div class="column is-2">
                           <div class="bd-notification is-info">
                              <label>
                              Product
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Product">
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column is-4">
                           <div class="bd-notification is-info">
                              <label>
                              Description
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <textarea placeholder="Comments" class="textarea is-small is-shadowless para-des"></textarea>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="bd-notification is-info">
                              <label>
                              Quantity
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Quantity">
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="bd-notification is-info">
                              <label>
                              Price
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Price">
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column  is-1">
                           <div class="bd-notification is-info">
                              <label>
                              Tax
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field has-addons">
                                 <div class="control is-expanded">
                                    <div class="select  is-fullwidth">
                                       <select name="country" class="select-tax">
                                          <option value="Active">0%</option>
                                          <option value="Inactive">10%</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="column ">
                           <div class="bd-notification is-info">
                              <label>
                              Total
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Rs:500" disabled>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div id="button_container_1">
                              <button type="button" class="button is-dark  is-small delete-row" @click="addCurrent">Add a row</button>
                           </div>
                        </div>
                     </div>
                     <div class="columns" v-for="(el,index) in arr" :key="index">
                        <div class="column  is-2">
                           <div class="bd-notification is-info">
                              <label>
                              Product
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Product">
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column is-4">
                           <div class="bd-notification is-info">
                              <label>
                              Description
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <textarea placeholder="Comments" class="textarea is-small is-shadowless para-des"></textarea>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="bd-notification is-info">
                              <label>
                              Quantity
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Quantity">
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="bd-notification is-info">
                              <label>
                              Price
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Price">
                                 </p>
                              </div>
                           </div>
                        </div>
                          <div class="column  is-1">
                           <div class="bd-notification is-info">
                              <label>
                              Tax
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field has-addons">
                                 <div class="control is-expanded">
                                    <div class="select  is-fullwidth">
                                       <select name="country" class="select-tax">
                                          <option value="Active">0%</option>
                                          <option value="Inactive">10%</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="bd-notification is-info">
                              <label>
                              Total
                              <span class="has-text-danger">*</span>
                              </label>
                              <div class="field">
                                 <p class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Rs:500" disabled>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <button class="delete  is-small delete-row"
                              type="btn btn-success"
                              @click="deleteFiles(index)">
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <template>
                  <section class="card section sectionadd">
                     <b-tabs type="is-boxed">
                        <b-tab-item label="Additional">
                           <div class="columns">
                              <div class="column">
                                 <div class="bd-notification is-info">
                                    <label>
                                    Terms & Conditions
                                    <span class="has-text-danger">*</span>
                                    </label>
                                    <div class="field">
                                       <p class="control has-icons-left has-icons-right">
                                          <textarea placeholder="Terms & Conditions" class="textarea is-small is-shadowless"></textarea>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="column">
                                 <div class="bd-notification is-info">
                                    <label>
                                    Footer
                                    <span class="has-text-danger">*</span>
                                    </label>
                                    <div class="field">
                                       <p class="control has-icons-left has-icons-right">
                                          <textarea placeholder="Footer" class="textarea is-small is-shadowless"></textarea>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </b-tab-item>
                     </b-tabs>
                  </section>
               </template>
            </div>
            <div class="column">
               <div class="card section sectionadd is-clearfix form-quote">
                  <div class="bd-notification is-info">
                     <label>
                     Date
                     <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker>
                        </p>
                     </div>
                  </div>
                  <div class="bd-notification is-info">
                     <label>Every</label>
                     <div class="columns">
                        <div class="column">
                           <div class="field has-addons">
                              <div class="control is-expanded">
                                 <div class="select is-fullwidth">
                                    <select name="country">
                                       <option value="">1</option>
                                       <option value="">2</option>
                                       <option value="">3</option>
                                       <option value="">4</option>
                                       <option value="">5</option>
                                       <option value="">6</option>
                                       <option value="">7</option>
                                       <option value="">8</option>
                                       <option value="">9</option>
                                       <option value="">10</option>
                                       <option value="">11</option>
                                       <option value="">12</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="column">
                           <div class="field has-addons">
                              <div class="control is-expanded">
                                 <div class="select is-fullwidth">
                                    <select name="country">
                                       <option value="">Days</option>
                                       <option value="">Weeks</option>
                                       <option value="">Months</option>
                                       <option value="">Years</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="bd-notification is-info">
                     <label>
                     Expires On
                     <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker>
                        </p>
                     </div>
                  </div>
                  <div class="bd-notification is-info">
                     <label>
                     Discount
                     <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <input class="input" type="text" placeholder="Discount">
                        </p>
                     </div>
                  </div>
                  <div class="bd-notification is-info">
                     <label>Currency</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="country">
                                 <option value>Us Dollar</option>
                                 <option value>Euro</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="bd-notification is-info">
                     <label>Staus</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="country">
                                 <option value="">Draft</option>
                                 <option value="">Sent</option>
                                 <option value="">Approved</option>
                                 <option value="">Rejected</option>
                                 <option value="">Canceled</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
           <div class="section has-text-centered">
           <button class="button has-background-light is-small  clearbuton">Clear</button>

 <button class="button is-dark  is-small">Submit</button>
</div>
      <br>
      <layout-footer></layout-footer>
   </section>
</template>
<script>
   import LayoutHeader from "./layouts/Header.vue";
   import LayoutFooter from "./layouts/Footer.vue";
   import { Validator } from "vee-validate";
   export default{
   components: {
     LayoutHeader,
     LayoutFooter
   },
     data() {
               return {
                 current:{
           },
           arr:[],
         
                   dropFiles: [],
                   tags: [
                       ]
               }
               myDate: new Date()
           },
           methods: {
               deleteDropFile(index) {
                   this.dropFiles.splice(index, 1)
               },
               deleteFile(index) {
                   this.tags.splice(index, 1)
               },
                addCurrent() {
           this.arr.push(JSON.parse(JSON.stringify(this.current)));
       },
       deleteFiles(index) {
                   this.arr.splice(index, 1)
               },
   
   
           }
   }
</script>
<style>
   .address {
   font-size: 13px !important;
   line-height: 23px;
   }
   h6.is-size-6.name-title {
   font-size: 15px !important;
   font-weight: 500;
   }
   .card-header {
   box-shadow: unset !important;
   }
   .card {
   box-shadow: 0px 0px 15px #ddd !important;
   }
   textarea.textarea.is-small.is-shadowless.para-des {
   min-height: 52px;
   }
   .form-quote .bd-notification.is-info {
   margin-bottom: 15px;
   }
   .hero .tabs ul {
   border-bottom: 1px solid #ddd !important;
   width: 50%;
   }.is-boxed ul li a span {
   font-size: 12px;
   text-transform: uppercase;
   }
   .filetable td{
   padding: 0.5em 0.75em !important;
   }
   span.files {
   font-size: 12px;
   text-transform: capitalize;
   background-color: #ddd;
   padding: 10px;
   border-radius: 19px;
   margin-left: 20px;
   position: relative;
   }     
   .taginput-container.is-focusable span.tag {
   display: none;
   }.icons1 {
   border: 1px solid #000;
   padding: 4px 5px;
   border-radius: 33px;
   color: #aba4a4;
   }
   .taginput .taginput-container.is-focusable {
   box-shadow: unset !important;
   }ul.list-unstyled.chat-sections1 {
   box-shadow: 0px 0px 10px #ddd;
   padding: 10px 20px;
   padding-bottom: 41px;
   margin: 40px auto;
   height: 250px;
   overflow: auto;
   transform: translate(0,0);
   }.datetime {
   margin-top: 20px;
   }.fa-caret-left:before
   {
   position: absolute;
   left: -8px;
   top: -4px;
   font-size: 41px;
   color:#ddd;
   }.delete-row {
   text-align: center;
   margin: 0 auto;
   display: block !important;
   margin-top: 37%;
   }
   .delete-row
   {
   background-color: #363636;
   }  .dropdown-content {
   float: left;
   }.sectionadd {
    padding: 1rem 1.5rem !important;
}

.drop-special .card-content
{
       padding-top: 5px!important;

}
</style>