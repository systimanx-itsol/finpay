

<template>
    <form id="app" @submit.prevent=''>
      <section class="hero is-fullheight is-default is-bold drop-special">
         <layout-header></layout-header>
         <div class="container containeg breadcrums1">
            <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Invoices</h6>
            <div class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
               <!-- <button1 class="button has-background-dark has-text-white is-size-7" :disabled ="submitted==false" @click="savefile"><i class="fas fa-print icon1" ></i> PDF</button1> -->
               <b-dropdown hoverable>
                  <button class="button has-background-dark has-text-white is-size-7" slot="trigger">
                  <span>OTHERS</span>
                  <span style="padding-left:8px"><i class="fas fa-caret-down"></i> </span></button>

                  <b-dropdown-item class="has-text-dark is-size-7 has-text-left" @click="copyinvoice"><i class="fas fa-copy icon1"></i>Copy</b-dropdown-item>
                   <b-dropdown-item class="has-text-dark is-size-7 has-text-left" @click="isImageModalActive1=true;  payment()"><i class="fas fa-copy icon1"></i>Payments</b-dropdown-item>
                  <b-dropdown-item class="has-text-dark is-size-7 has-text-left" @click="destroy"><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item>
               </b-dropdown>
                 <template>
         <section>
             <form id="app" @submit.prevent='enterpayment'>
               <b-modal :active.sync="isImageModalActive1" :width="340">
                  <div class="card section sect">
                     <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered">Enter Payment</h4>
                     <p class="bd-notification is-info">
                        <!-- quick -->
                        <label>
                        </label>
                     <div class="field">Amount Balance:{{currencyplace==0 ? currencysymbol : ''}} {{this.balance}} {{currencyplace==1 ? currencysymbol : ''}}
                        <p class="control has-icons-left has-icons-right">
                           <input class="input" type="text"  placeholder="Amount" id="amount" v-model="invoice.amount" name="amount" v-validate="'required'"
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
                              v-model="invoice.paymentdate"
                              :date-formatter="formatDate" 
                              name="paymentdate" 
                              v-validate="'required'"
                              :class="{ 'is-invalid': submitted && errors.has('paymentdate') }">
                           </b-datepicker>
                        </p>
                        <span
                                        v-show="errors.has('bill_to')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Payment Method <span class="has-text-danger">*</span> </label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="paymentmethod" id="paymentmethod" v-model="invoice.paymentmethod"  v-validate="'required'"
                                 >
                                 <option v-for="(paymentmethod) in name" v-bind:value="paymentmethod.id" :key="paymentmethod.id">
                                    {{paymentmethod.name}}
                                 </option>
                              </select>
                              <span
                                        v-show="errors.has('paymentmethod')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
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
                              " class="textarea is-small is-shadowless" id="paymentnotes" v-model="invoice.paymentnotes" name="paymentnotes" 
                              :class="{ 'is-invalid': submitted && errors.has('paymentnotes') }"></textarea>                             
                        </p>
                     </div>
                     </p>
                     <span v-if="balanceError != null" style="color: red;"> {{ balanceError }} </span>
                     <button class="button is-dark is-small is-pulled-right" 
                        @click="isImageModalActive1 = false" >Submit</button>
                     <button8 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive1 = false" >Cancel</button8>
                  </div>
               </b-modal>
            </form>
         </section>
      </template>
               <button5 class="button has-background-dark has-text-white is-size-7">
                  <router-link to="/Invoice" class="has-text-white">    <i class="fas fa-backward icon1"></i> BACK
                  </router-link>
               </button5>
               <button class="button has-background-dark has-text-white is-size-7" @click="handleSubmit" ><i class="far fa-save icon1"></i>SAVE</button>
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
                                    <!-- <span class="icon">
                                       <i class="fas fa-angle-down" aria-hidden="true"></i>
                                       </span> -->
                                 </a>
                                 <!-- <b-dropdown-item> <i class="fas fa-file icon1"></i> Save</b-dropdown-item> -->
                                 <!-- <b-dropdown-item><i class="fas fa-edit icon1"></i> Edit</b-dropdown-item> -->
                                 <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                              </b-dropdown>
                           </header>
                           <div class="card-content">
                              <div class="content">
                                 <h6 class="is-size-6 name-title"> {{company.company_name}}</h6>
                                 <p class="address">
                                    {{company.address}}, 
                                    <br>{{company.city}} 
                                    -{{company.zipcode}}<br> 
                                    {{company.state}}, 
                                    {{company.country}},
                                    <br>Phone: {{company.mobile}}, 
                                    <br>Website: {{company. website}}.
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
                                 <b-dropdown-item>
                                    <a  @click="isImageModalActive5=true; client (this.$route.query.client_id)" class="has-text-dark"  >
                                    <i class="fas fa-edit icon1"></i> Edit 
                                    </a>
                                 </b-dropdown-item>
                                 <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                              </b-dropdown>
                           </header>
                           <div class="card-content">
                              <div class="content" >
                                 <h6 class="is-size-6 name-title" >  {{client.client_name}}</h6>
                                 <p class="address"  >
                                    {{client.address}}, 
                                    </br> {{client.city}},
                                    {{client.postal_code}},
                                    </br>{{client.state}},
                                    <br>Phone: {{client.phone_number}},
                                    <br>Email:  {{client.email}}.
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
                  <template>
                     <section>
                        <b-modal :active.sync="isImageModalActive5" :width="1200" >
                           <div class="card section sect">
                              <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Edit Client</h4>
   <form id="app" @submit.prevent="editclient" validate>
   <div class="columns ">
   <div class="column">
   <p class="bd-notification is-info">
   <label>Client Name <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="client_name" name="client_name" v-model="client.client_name"
      placeholder=" Name" v-validate="'required|alpha_spaces'">
   </p>
   <span v-show="errors.has('client_name')" class="invalid-feedback">{{nameError}}</span>          
   </div>
   </p>      
   <p class="bd-notification is-info">
   <label>Email <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="email" name="email" v-model="client.email"
      placeholder="Email" v-validate="'required|email'" disabled>
   </p>
   <span v-show="errors.has('email')" class="invalid-feedback">{{validEmail}}</span>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Address <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <textarea placeholder="Address" class="textarea is-small is-shadowless" id="address" v-validate="'required'" v-model="client.address"
      ></textarea>
   </p>
   <span v-show="errors.has('address')" class="invalid-feedback">{{addressError}}</span>
   </div>
   </p>
   </div>
   <div class="column">
   <p class="bd-notification is-info">
   <label>City <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="city" name="city" v-model="client.city"
      placeholder="City" v-validate="'required|alpha_spaces'">
   </p>
   <span v-show="errors.has('city')" class="invalid-feedback">{{cityError}} </span>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>State <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="state" name="state" v-model="client.state"
      placeholder="State" v-validate="'required|alpha_spaces'">
   </p>
   <span v-show="errors.has('state')" class="invalid-feedback">{{stateError}}</span>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Postal Code <span class="has-text-danger"  v-validate="'required|numeric'">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="postal_code" name="postal_code"  v-model="client.postal_code"
      placeholder="Postal Code">
   </p>
   <span v-show="errors.has('postal_code')" class="invalid-feedback">{{postalcodeError}}</span>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Country <span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="country" name="country" v-model="client.country"
      placeholder="Country" v-validate="'required|alpha_spaces'">
   </p>
   <span v-show="errors.has('country')" class="invalid-feedback">{{countryError}}</span>
   </div>
   </p>
   </div>
   <div class="column">
   <p class="bd-notification is-info">
   <label>Phone Number</label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text"
      id="phone_number" name="phone_number" client.phone_number
      placeholder="phone number" v-model="client.phone_number">
   </p>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Fax Number
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="fax_number" name="fax_number" v-model="client.fax_number"
      placeholder="Fax Number">
   </p>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Mobile Number</label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="mobile_number" name="mobile_number" v-model="client.mobile_number"
      placeholder="Mobile Number">
   </p>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Website Address </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="web_site" name="web_site" v-model="client.web_site"
      placeholder="Website Address">
   </p>
   </div>
   </p>
   </div>
   <div class="column">
   <p class="bd-notification is-info">
   <label>Default Currency</label>
   <div class="field has-addons">
   <div class="control is-expanded">
   <div class="select is-fullwidth">
   <select id="default_currency" name="default_currency" v-model="client.default_currency" class="select-defaultcurrency">
   <option v-for="currencies in currency" v-bind:value="currencies.id" :key=currencies>
   {{currencies.name}}
   </option>     
   </select>
   </div>
   </div>
   </div>
   </p>
   <p class="bd-notification is-info">
   <label>Tax Number<span class="has-text-danger	">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" id="tax_code" name="tax_code"  v-model="client.tax_code"
      placeholder="Tax Number" v-validate="'required'">
   </p>
   <span v-show="errors.has('tax_code')" class="invalid-feedback">{{taxcodeError}}</span>
   </div>
   </p>
   </div>
   </div>
   <button @click="isImageModalActive5 = false" class="button is-dark is-small is-pulled-right">Submit</button>
   <a class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive5 = false">cancel</a>
   </form>
   </div>           
   </b-modal>
   </section>
   </template>
   <div class="card">
   <header class="card-header">
   <p class="card-header-title">Items</p>
   <div  v-if="editMode === false" class="has-text-right	 is-full">
   <div id="button">
   <button type="button" class="button is-dark  is-small delete-row"  @click="addCurrent(index)">Add a row</button>
   </div>
   </div>
   <a href="#" class="card-header-icon" aria-label="more options">
   <!-- <span class="icon">
      <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span> -->
   </a>
   </header>
   <div class="card-content">
   <div v-if="editMode === false" class="columns addandremove"  v-for="(el,index) in arr" :key="index" >
   <div class="columns" >
   <div class="column is-2">
   <div class="bd-notification is-info">
   <label>
   Product
   <span class="has-text-danger">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <b-autocomplete
      :id="'product_name'+index"
      :name="'product_name'+index"
      v-model="el.product_name"
       
      field="title"
      @typing="getAsyncData(index)"
      @select ="myFunction"
       v-validate="'required'"
      :key="index" 
      :class="{ 'is-invalid': submitted && errors.has('product_name') }"
      :data="filteredDataArray"
      placeholder="Product"
      icon="magnify"
     
      >
    <template slot="empty">No results found</template>
   </b-autocomplete>
   
   </p>
    <span
                                    v-if="arr.length-1 == index"    v-show="errors.has('product_name')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
   </div>
   </div>
   </div>
   <div class="column is-4">
   <div class="bd-notification is-info">
   <label>
   Description
  
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <textarea placeholder="Comments" class="textarea is-small is-shadowless para-des" :id="'description'+index" v-model="el.description"    :name="'description'+index" v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('description') }" disabled></textarea>	
   </p>
   <span  v-show="errors.has('description'+index)" class="invalid-feedback">{{descriptionError}}</span>
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
   <input class="input" type="text" placeholder="Quantity" id="quantity" v-model="el.quantity"  v-onchange="calculatedFromAmount"   name="quantity"  v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('quantity') }">
   </p>
   <span v-if="arr.length-1 == index" v-show="errors.has('quantity')" class="invalid-feedback">Field is required</span>
   </div>
   </div>
   </div>
   <div class="column">
   <div class="bd-notification is-info">
   <label>
   Price
  
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" placeholder="Price" id="price" v-model="el.price"    name="price" v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('price') }" disabled>
   </p>
   <span v-show="errors.has('price')" class="invalid-feedback">{{priceError}}</span>
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
   <select name="tax_rate_id" class="select-tax" id="tax_rate_id" v-model="el.tax_rate_id"    @change="calculatedFromAmount"  v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('tax_rate_id') }">
   <option v-for="tax_rate in tax_rate_id"  v-bind:value="tax_rate.percentage" :key="tax_rate">
   {{tax_rate.percentage}} %
   </option>
   </select>
  <span
                                      v-if="arr.length-1 == index"  v-show="errors.has('tax_rate_id')"
                                        class="invalid-feedback"
                                        >Field is required</span
                                    >
   </div>
   </div>
   </div>
   </div>
   </div>
   <div class="column ">
   <div class="bd-notification is-info">
   <label>
   Total
  
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input class="input" type="text" placeholder="Rs:500" disabled  id="total" v-model="el.total"    name="total" v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('total') }">
   </p>
   <span v-show="errors.has('total')" class="invalid-feedback">{{totalError}}</span>
   </div>
   </div>
   </div>
   <div class="colms"  v-if="index != 0" >
   <button type = "button" class="delete  is-small delete-row"
      @click="data='';deleteProduct(index)">
   </button>
   </div>						
   </div>
   </div>
   </div>
   </div>                    
   <template>
   <section class="card section sectionadd">
   <b-tabs type="is-boxed tabings-1">
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
   <textarea placeholder="Terms & Conditions" class="textarea is-small is-shadowless" id="terms"  type="text" v-model="invoiceform.terms"    name="terms" v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('terms') }"></textarea>
   </p>
   <span v-show="errors.has('terms')" class="invalid-feedback">Terms and Conditions is required</span>
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
   <textarea placeholder="Footer" class="textarea is-small is-shadowless" id="footer"  type="text" v-model="invoiceform.footer"    name="footer"  v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('footer') }"></textarea>
   </p>
   <span
      v-show="errors.has('footer')"
      class="invalid-feedback"
      >Footer is required</span>
   </div>
   </div>
   </div>
   </div>
   </b-tab-item>
   <b-tab-item label="Notes">
   <template>
   <section>
   <ul class="list-unstyled chat-sections1" >
   <li>
   <p class="is-size-7 datetime is-pulled-right"> 
   {{ new Date().getDate() }}/
   {{ new Date().getMonth()+1 }}/
   {{ new Date().getFullYear() }}
   </p>
   <br>
   <i class="fas fa-user icons1 is-size-5"></i> <span class="files">
   <i class="fas fa-caret-left"></i>
   Types Your Notes</span>
   </li>
   </p>
   </li>
   <li v-for="(file, index) in note"
      :key="index"
      class=" is-primary">
   <p class="is-size-7 datetime is-pulled-right"> 
   {{ new Date().getDate() }}/
   {{ new Date().getMonth()+1 }}/
   {{ new Date().getFullYear() }}
   <button class="delete is-small" type="button" @click="deleteFile(index)">
   </button>
   </p>
   <br>
   <i class="fas fa-user icons1 is-size-5"></i> <span class="files">               
   <i class="fas fa-caret-left"></i>
   {{ file }}</span>
   </p>
   </li>
   </ul>
   <b-field label="Notes" class="is-size-7 is-shadowless" >
   <b-taginput class="is-shadowless"
      v-model="note" :max="6"
      multiple
      drag-drop name="note"
      >
   </b-taginput>
   </b-field>
   </section>
   </template>
   </b-tab-item>
   <b-tab-item label="Attachments">
   <p class="bd-notification is-info">
   <label>Files
   </label>
   <table   >
   <thead>
   <!-- <tr>
      <th scope="col">File Name</th>
      <th scope="col">Date</th>
      <th scope="col">Delete</th>
      </tr> -->
   </thead>
   <tbody>
   <tr v-for="(file, index) in bindfile"
      :key="index"
      class=" is-primary" >
   <td scope="row" class="is-size-7 is-uppercase" style="font-weight:400">
   <a v-if="file.file_path" :href="download_path + file.name" >{{file.name}}</a>
   </td>
   <td class="is-size-7">
   {{ new Date().getDate() }}/
   {{ new Date().getMonth()+1 }}/
   {{ new Date().getFullYear() }}
   </td>
   <td> <button class="delete is-small" type="button" @click="deleteDrop(index)">
   </button>
   </td>
   </tr>
   <tr v-for="(file, index) in invoiceform.datafile"
      :key="index"
      class=" is-primary" >
   <td scope="row" class="is-size-7 is-uppercase" style="font-weight:400">
   <a> {{file.name}}</a>
   </td>
   <td class="is-size-7">
   {{ new Date().getDate() }}/
   {{ new Date().getMonth()+1 }}/
   {{ new Date().getFullYear() }}
   </td>
   <td> <button class="delete is-small" type="button" @click="deleteDropFile(index)">
   </button>
   </td>
   </tr>
   </tbody>
   </table>
   <b-field>
   <b-upload v-model="invoiceform.datafile"
      multiple
      drag-drop>
   <section class="section">
   <div class="content has-text-centered">
   <p class="is-marginless">
   <b-icon>
   <i class="fas fa-cloud-upload-alt is-size-2"></i>
   </b-icon>
   </p>
   <p class="is-size-7">Drop your files here or click to upload</p>
   </div>
   </section>
   </b-upload>
   </b-field>
   </p>               
   </b-tab-item>
   <b-tab-item label="Payments">
   <section >
   <div class="field has-addons is-pulled-right is-hidden-mobile">
   <div class="control has-icons-left">
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
   <div class="control">
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
      :data="paymentDataArray"
      :paginated="isPaginated"
      :per-page="perPage"
      :current-page.sync="currentPage"
      :pagination-simple="isPaginationSimple"
      :default-sort-direction="defaultSortDirection"
      default-sort="paymentmethod"
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
      >{{ props.index + 1  }}</b-table-column>
   <b-table-column
      field="payment_date"
      class="is-size-7-mobile"
      label="Payment Date"
      sortable
      >{{ formatter (props.row.payment_date) }}</b-table-column>
   <b-table-column
      field="payment_amount"
      class="is-size-7-mobile"
      label="Payment Amount"
      sortable
      >{{currencyplace==0 ? currencysymbol : ''}}  {{ (props.row.payment_amount).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands) }} {{currencyplace==1 ? currencysymbol : ''}} </b-table-column>
   <b-table-column
      field="paymenttype_id"
      class="is-size-7-mobile"
      label="Payment Method"
      sortable
      >{{ props.row.paymenttype_id }}</b-table-column>
   <b-table-column
      field="note"
      class="is-size-7-mobile"
      label="Note"
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

              <b-dropdown-item @click="isImageModalActive2= true; getpaymentview(props.row.payment_id)">
			
                <i class="fas fa-edit icon1" ></i> Edit
				
              </b-dropdown-item>
              
            
              <b-dropdown-item @click="goToDelete(props.row.payment_id)">
                <i class="fas fa-trash-alt icon1"></i> Delete
              </b-dropdown-item>

            </b-dropdown>
          </b-table-column>
   </template>
   </b-table>
   </section>
   </b-tab-item>
   </b-tabs>
   </section>
   </template>
   </div> 
   <template>
   
         <section>
            <b-modal :active.sync="isImageModalActive2" :width="340">
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
             
                      <button class="button is-dark is-small is-pulled-right" @click ="updatepayment">Submit</button>
                     
                     <button1 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive2 = false">cancel</button1>
               
               </div>
            </b-modal>
         </section>

      </template>



   <div class="column">
   <div class="card section sectionadd is-clearfix form-quote">
   <ul class="amounsec">
   <li class="has-text-darker has-text-weight-semibold" >Subtotal <span class="has-text-weight-normal is-pulled-right" >{{currencyplace==0 ? currencysymbol : ''}} {{Subtotal}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   <li class="has-text-darker has-text-weight-semibold ">Discount<span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{Discountval}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   <li class="has-text-darker has-text-weight-semibold " >Tax <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{Totaltax}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   <li class="has-text-darker has-text-weight-semibold " >Total <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{wholeTotal}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   <!-- <li class="has-text-darker has-text-weight-semibold " id="paid" name="paid" 
      :class="{ 'is-invalid': submitted && errors.has('paid') }">Paid <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{invoiceform.paid}}</span></li> -->
   <li class="has-text-darker has-text-weight-semibold " id="paid" name="paid" 
      :class="{ 'is-invalid': submitted && errors.has('paid') }">Paid <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{(invoiceform.paid).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands)}}  {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   <li class="has-text-darker has-text-weight-semibold ">Balance <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{Balance}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
   </ul>                                                                                                                                          
   </div>
   <br>
   <div class="card section sectionadd is-clearfix form-quote">
   <div class="bd-notification is-info">
   <label>
   Invoice No
   <span class="has-text-danger">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input id="invoice_number" class="input" type="text" v-model="invoiceform.invoice_number" @blur="getinvoiceno" placeholder="Invoice No"   name="invoice_number" v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('invoice_number') }" >
   </p>
   <span v-show="errors.has('invoice_number')" class="invalid-feedback"> Invoice Number is required</span>
   </div>
   </div>
   <div class="bd-notification is-info">
   <label>
   Date
   <span class="has-text-danger">*</span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right" >
   <b-datepicker  class="control has-icons-left has-icons-right" :date-formatter="formatDate" v-model="invoiceform.date"  v-validate="'required'"
      :class="{ 'is-invalid': submitted && errors.has('date') }" placeholder="Date" icon="calendar-today" @input="dateDisplay" ></b-datepicker>
   </p>
   <span v-show="errors.has('date')" class="invalid-feedback"> Date Number is required</span>
   </div>
   </div>
   <div class="bd-notification is-info">
   <label>
   Due Date
   <span class="has-text-danger">*</span>
   </label>
   <div class="field">
   <p  class="control has-icons-left has-icons-right" >
   <b-datepicker name="expires_on" class="control has-icons-left has-icons-right"  v-model="invoiceform.expires_on"  :date-formatter="formatDate" 
      icon="calendar-today"  placeholder="Expires_on" v-validate="'required'">
   </b-datepicker>
   </p>
   <span v-show="errors.has('expires_on')" class="invalid-feedback"> Expire On is required</span>
   </div>
   </div> 
   <div class="bd-notification is-info">
   <label>
   Discount
   <span class="has-text-danger"></span>
   </label>
   <div class="field">
   <p class="control has-icons-left has-icons-right">
   <input id="discount" class="input" type="text"   placeholder="Discount" v-model="invoiceform.discount"   name="discount" >
   </p>
   </div>
   </div>
   <div class="bd-notification is-info">
   <label>Currency <span class="has-text-danger	">*</span></label>
   <div class="field has-addons">
   <div class="control is-expanded">
   <div class="select is-fullwidth">
   <select id="currency_id" name="currency_id" v-model="invoiceform.currency_id"
      @change="calculatedSymbol"  class="select-currency" v-validate="'required'">
   <option :key="i" v-for="(currencies,i) in currency" v-bind:value="currencies.id" :selected="i===0">
   {{currencies.name}}
   </option>
   </select>
   <span
      v-show="errors.has('currency_id')"
      class="invalid-feedback"
      >Currency is required</span>
   </div>
   </div>
   </div>
   </div>
   <div class="bd-notification is-info">
   <label>Staus<span class="has-text-danger	">*</span> </label>
   <div class="field has-addons">
   <div class="control is-expanded">
   <div class="select is-fullwidth">
   <select  name="invoice_status_id" id="invoice_status_id" v-model="invoiceform.invoice_status_id"   
      :class="{ 'is-invalid': submitted && errors.has('invoice_status_id') }" v-validate="'required'">
   <option v-for="tax_rate in invoice_status" v-bind:value="tax_rate.invoicestatus_id" :key="tax_rate.invoicestatus_id">
   {{tax_rate.invoicestatus}} 
   </option>
   </select>
   <span
      v-show="errors.has('invoice_status_id')"
      class="invalid-feedback"
      >Status is required</span>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   <div class="section has-text-centered">
   <button2 class="button has-background-light is-small  clearbuton" @click="clear">Clear</button2>
   <button class="button is-dark  is-small" @click="handleSubmit" >Save</button>
   </div>
   <br>
   <layout-footer></layout-footer>
   </section>
   </form>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import {
    Validator
} from "vee-validate";
import moment from 'moment';
import Vue from 'vue';
import {
    log
} from 'util';
var productIndex = -1;
var totalamount;
var total;
var subtotalamount;

export default {
    components: {
        LayoutHeader,
        LayoutFooter,
        moment
    },
    data() {
        return {
            isImageModalActive1: false,
             isImageModalActive2: false,
            isImageModalActive5: false,
            currencyplace: '',
            Invoiceform: [],
            currencysymbol: '',
            currencythousands: '',
            currencydecimal: '',
            systemquantities: [],
            systemtaxrounding: [],
            bind_file_name: [],
            selectedproduct: [],
            products_store: [],
            subtotal: 0,
            totaltax: 0,
            discountval: 0,
            wholetotal: 0,
            balance: 0,
            invoice_status: [],
            index: 0,
            note: [],
            bindfile: [],
            newDay: '',
            myDate: '',
             payment:
            { 
				amount: "",
				paymentdate: "",
				paymentmethod: "",
        paymentnotes: "",
        currency_id:'',
        
            },
            client:
            {
                client_name: "",
                address: "",
                city: "",
                state: "",
                postal_code: "",
                country: "",
                phone_number: "",
                email: "",
                mobile_number: '',
                fax_number: '',
                web_site: '',
                default_currency: '',
                tax_code: '',
                status: 1,
            },
            company: {
                company_name: "",
                address: "",
                city: "",
                state: "",
                zipcode: "",
                country: "",
                mobile: "",
                website: ""
            },
            invoiceform: {
                invoice_number: "",
                footer: "",
                terms: "",
                paid:0,
                total_amount: "",
                date: "",
                expires_on: "",
                discount: "",
                currency_id: "",
                invoice_status_id: "",
                datafile: [],
            },
            invoice: {
                amount: "",
                paymentdate: new Date(),
                paymentmethod: "",
                paymentnotes: "", 
            },
            submitted: false,
            arr: [{
                product_id: '',
                product_name: '',
                description: '',
                quantity: '',
                price: '',
                tax_rate_id: '',
                total: ''
            }],
            footer: '',
            editMode: false,
            validEmail: "email required",
            validaddress: "address required",
            validcity: "city required",
            validstate: "state required",
            validpostalcode: "postal code required",
            validcountry: "country required",
            validtax_code: "taxcode required",
            validnumber: "",
            validterms: "",
            validfooter: "",
            search: "",
            data: [],
            item: [],
            isPaginated: true,
            isPaginationSimple: false,
            defaultSortDirection: "asc",
            currentPage: 1,
            perPage: 5,
            current: {},
            currency: [],
        }
        myDate: new Date()
    },

    mounted: function() {

          if (this.$route.query.id != '' && this.$route.query.id != null) {
            this.getinvoice();
        }
        if (this.$route.query.id != '' && this.$route.query.id != null) {
            this.getclient();
        }
        this.gettax();
        this.getInvoicestatus();
        this.customFormatter();
        this.quantities();
        this.taxrounding();
        this.getpayment();
        this.getcurrency();
        this.paymentMethod();
    },

    methods: {
              ...mapActions({
                setLoading: "setLoading"
            }),

          

 getpaymentview(id) {
    this.setLoading(true);
      this.payment_id= id;
        let uri = '/Payment/' +  this.payment_id;
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

   updatepayment( ) {
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
          this.fetchdata();
        }
     
         else {
          context.payment = [];
               this.fetchdata();
              context.isImageModalActive2 = false;
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
      context.isImageModalActive2 = false;
      }  
           
    },


     goToDelete(id){ 
     this.$buefy.dialog.confirm({
        message: 'Are you sure you want to delete this record?',
         onConfirm: () => this.destroypayment(id)
      })  
    },
 
 destroypayment(id) {  
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
        },
        

paymentMethod() {
           this.setLoading(true);
            let uri = '/PaymentMethod';
              axios.get(uri).then((response) => {
               this.name = response.data.payment_methodDetails;
               this.invoice.paymentmethod = this.name[0].id;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

         payment() {
             this.setLoading(true);
            let uri = '/invoiceView/'+this.$route.query.id;
            axios.get(uri)
                .then((response) => {
                  this.invoice.amount = response.data.invoiceviewdetails.balance;
                })
                 .finally(() => {
                this.setLoading(false);
              });
        },

      enterpayment() {
            let context = this;
            context.submitted = true;
              context.balanceError = null;
            if (Number(context.balance) < Number(context.invoice.amount)) {
                context.balanceError = "Amount is larger"
                return
            }
            if (context.balanceError == null) {
                context.setLoading(true);
                context.$validator.validate().then(valid => {
                    if (valid) {
                        let url = '/paymentinvoice/' + context.$route.query.id;
                        let config = {
                            headers: {
                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formdata = new FormData();
                        formdata.append('amount', context.invoice.amount);
                        if (context.invoice.paymentdate != '') {
                            var dateObj = new Date(context.invoice.paymentdate);
                             var momentObj = moment(dateObj);
                              var momentString = momentObj.format('YYYY-MM-DD');
                               context.invoice.paymentdate = momentString;
                                formdata.append('paymentdate', context.invoice.paymentdate);
                        }
                        formdata.append('paymentmethod', context.invoice.paymentmethod);
                         formdata.append('paymentnotes', context.invoice.paymentnotes);
                          axios.post(url, formdata, config).then(response => {
                            if (response.data.status == 1) {
                               
                                   context.invoice = [];
                                       context.invoice.paymentdate = new Date();
                                        context.invoice.amount =  context.paymentBalance
                                        
                                   context.$buefy.toast.open({
                                    duration: 4000,
                                     message: response.data.message,
                                      type: "is-success",
                                       position: "is-top-right"
                                });
                                   context.getclient();
                            } else {
                                context.$buefy.toast.open({
                                 message: response.data.message,
                                  position: "is-top-right",
                                   type: "is-danger"
                                }); 
                                //  context.getclient();
                                //   context.isImageModalActive = false;
                            }
                             
                            
                        })

                        .finally(() => {
                                context.setLoading(false);
                                 
                       });
                              
                    }else{
                   context.setLoading(false);
                    }
                });
            }
        },

        calculatedSymbol() {
            let temp = this.invoiceform.currency_id;
            for (let i in this.currency) {
                if (temp == this.currency[i].id) {
                    this.currencysymbol = this.currency[i].symbol;
                     this.currencyplace = this.currency[i].placement;
                      this.currencythousands = this.currency[i].thousands;
                       this.currencydecimal = this.currency[i].decimal;
                }
            }
        },

        formatter(date) {
            return moment(new Date(date)).format(this.systemValue);
        },

        quantities() {
              this.setLoading(true); 
            let url = '/systemquantities';
             axios.get(url).then(response => {
              this.systemquantities = response.data.systemQuantities;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

        taxrounding() {
             this.setLoading(true);
            let url = '/taxrounding';
             axios.get(url).then(response => {
              this.systemtaxrounding = response.data.systemTaxrounding;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

        customFormatter() {
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

        formatDate(date) {
            return moment(new Date(date)).format(this.systemValue);
        },

        getcurrency() {
              this.setLoading(true);
            let url = '/Currencies';
             axios.get(url).then((response) => {
              this.currency = response.data.currenciesDetails;
               this.invoiceform.currencysymbol = this.currency.symbol;
                this.invoiceform.currencyplace = this.currency.placement;
            })
            .finally(() => {
                this.setLoading(false);
              });
        },

        clear()
        {
            this.invoiceform = {
                invoice_number: "",
                date: "",
                expires_on: "",
                discount: "",
                terms: "",
                footer: "",
            }
            this.arr = [{
                product_name: '',
                tax_rate_id: '',
                description: '',
                quantity: '',
                tax_rate_value: '',
                price: '',
                total: ''
            }];
            this.note = [];
            this.datafile = [];
        },

        dateDisplay(theDate, days) {
            var dateObj = new Date(this.invoiceform.date);
            var momentObj1 = this.invoiceform.date
            var dateObj1 = moment(momentObj1);
            var myDate = new Date(theDate.getTime() + (10 * 24 * 60 * 60 * 1000));
            this.invoiceform.expires_on = new Date(myDate);
        },

        deleteDropFile(index) {
            this.invoiceform.datafile.splice(index, 1)
        },
        deleteDrop(index) {
            this.bindfile.splice(index, 1)
        },
 
        getDate(invoice) {
            return moment(invoice).format('DD/MM/YYYY')
        },

        deleteFile(index) {
            this.note.splice(index, 1)
        },

        addCurrent(index) {
            if (this.arr[(this.arr.length) - 1].product_name && this.arr[(this.arr.length) - 1].quantity && this.arr[(this.arr.length) - 1].tax_rate_id != '') {
                this.arr.push({
                    product_name: '',
                    description: '',
                    quantity: '',
                    price: '',
                    tax_rate_id: '',
                    total: ''
                });
            } else {
                this.$buefy.toast.open({
                    duration: 4000,
                    message: "Items Field is required",
                    title: " updated successfully",
                    type: "is-danger",
                    position: "is-top-right"
                });
            }
        },
        deleteProduct(index) {

            this.arr.splice(index, 1)

        },

        getAsyncData(index) {

            this.index = index;

            if (Object.keys(this.arr[index].product_name).length > 1) {
                this.isFetching = true
                let url = '/autoProduct';
                axios.get(url, {
                        query: {
                            product_name: this.arr[index].product_name
                        }
                    }).then(response => {
                        this.data = response.data.product;


                    })

                    .catch((error) => {
                        this.data = []
                        throw error
                    })
                    .finally(() => {
                        this.isFetching = false
                    });
            }
        },

        copyinvoice() {
               this.setLoading(true);
            if (this.$route.query.id != '' && this.$route.query.id != null) {
                for (let i = 0; i <= this.arr[i]; i++) {
                    this.invoiceform.product_name = this.arr[i].product_name;
                     this.invoiceform.description = this.arr[i].description;
                      this.invoiceform.quantity = this.arr[i].quantity;
                       this.invoiceform.price = this.arr[i].price;
                        this.invoiceform.tax_rate_id = this.arr[i].tax_rate_id;
                         this.invoiceform.total = this.arr[i].total;
                          this.note = this.note;
                }
                this.submitted = true;
                 this.editMode = true;
               
                   let url = '/invoicecopy'
                    let config = {
                     headers: {
                        'content-type': 'application/json'
                    }
                }
                let formdata = new FormData();
                if (this.editMode === false) {
                    this.response = process.env.MIX_INVOICE_ADD_RESPONSE;
                    if (this.arr) {
                        for (let product_name in this.arr) {
                            formdata.append('product_name[]', this.arr[product_name].product_name);
                        }
                        for (let description in this.arr) {
                            formdata.append('description[]', this.arr[description].description);
                        }
                        for (let quantity in this.arr) {
                            formdata.append('quantity[]', this.arr[quantity].quantity);
                        }
                        for (let price in this.arr) {
                            formdata.append('price[]', this.arr[price].price);
                        }
                        for (let tax_rate_id in this.arr) {
                            formdata.append('tax_rate_id[]', this.arr[tax_rate_id].tax_rate_id);
                        }
                        for (let total in this.arr) {
                            formdata.append('total[]', this.arr[total].total);
                        }
                    }
                } else if (this.editMode === true) {
                    this.invoiceform.id = this.$route.query.id;
                     this.response = process.env.MIX_INVOICE_UPDATE_RESPONSE;
                      formdata.append('number_of_products', this.arr.length);
                       for (let i = 0; i < this.arr.length; i++) {
                        formdata.append('products' + i + 'product_name', this.arr[i].product_name);
                         formdata.append('products' + i + 'description', this.arr[i].description);
                          formdata.append('products' + i + 'quantity', this.arr[i].quantity);
                           formdata.append('products' + i + 'price', this.arr[i].price);
                            formdata.append('products' + i + 'tax_rate_id', this.arr[i].tax_rate_id);
                             formdata.append('products' + i + 'total', this.arr[i].total);
                    }
                    formdata.append('subtotal', this.subtotal);
                     formdata.append('discountval', this.discountval);
                      formdata.append('totaltax', this.totaltax);
                       formdata.append('wholetotal', this.wholetotal);
                        formdata.append('balance', this.balance);
                         formdata.append('note', this.note);
                }
                formdata.append('footer', this.invoiceform.footer);
                 formdata.append('terms', this.invoiceform.terms);
                  formdata.append('invoice_number', this.invoiceform.invoice_number);
                   if (this.invoiceform.date != '') {
                    var dateObj = new Date(this.invoiceform.date);
                     var momentObj = moment(dateObj);
                      var momentString = momentObj.format('YYYY-MM-DD');
                       this.invoiceform.date = momentString;
                        formdata.append('date', this.invoiceform.date);
                }
                if (this.invoiceform.expires_on != '') {
                    var dateObj = new Date(this.invoiceform.expires_on);
                     var momentObj = moment(dateObj);
                      var momentString = momentObj.format('YYYY-MM-DD');
                       this.invoiceform.expires_on = momentString;
                        formdata.append('expires_on', this.invoiceform.expires_on);
                }
                formdata.append('discount', this.invoiceform.discount);
                 formdata.append('currency_id', this.invoiceform.currency_id);
                  formdata.append('invoice_status_id', this.invoiceform.invoice_status_id);
                   formdata.append('subtotal', this.subtotal);
                     formdata.append('discountval', this.discountval);
                      formdata.append('totaltax', this.totaltax);
                       formdata.append('wholetotal', this.wholetotal);
                        formdata.append('invoice_template', 'SystimaNX balde.pdf');
                         formdata.append('balance', this.balance);
                          formdata.append('note', this.note);
                           formdata.append('id', this.$route.query.id);
                if (this.invoiceform.datafile) {
                    this.invoiceform.datafile.forEach(file => {
                        formdata.append("images[]", file);
                    });
                }
                axios.post(url, formdata, config).then((response) => {
                    if (response.data.status == 1) {
                        this.$buefy.toast.open({
                         duration: 4000,
                          message: response.data.message,
                           title: " updated successfully",
                            type: "is-danger",
                             position: "is-top-right"
                        });
                    } else {
                        this.$buefy.toast.open({
                         duration: 4000,
                          message: response.data.message,
                           title: " updated successfully",
                            position: "is-top-right",
                             type: "is-success"
                        });
                        this.$router.push('/invoice');
                    }
                })
                  .finally(() => {
                this.setLoading(false);
              });
            }
        }, 
 
        handleSubmit() {
             let context = this;
            if (context.$route.query.id != '' && context.$route.query.id != null) {
                context.$validator.validate().then(valid => {
                    if (valid) {
                        for (let i = 0; i < context.arr.length; i++) {
                        }
                        context.editMode = context.$route.query.edit;
                         context.note = context.note;
                          context.submitted = true;
                           context.setLoading(true);
                           let url = '/invoiceupdate';
                        let config = {
                            headers: {

                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                 'content-type': 'multipart/form-data',
                                  'content-type': 'application/json'

                            }
                        };
                        let formdata = new FormData();
                         context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;
                          if (context.editMode === true) {
                            context.$validator.validate().then(valid => {
                                if (valid) {
                                    let url = '/updateInvoice';
                                     let config = {
                                        headers: {
                                            'content-type': 'application/json'
                                        }
                                    };
                                    let formdata = new FormData();
                                     context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;
                                      formdata.append('number_of_products', context.arr.length);
                                       for (let i = 0; i < context.arr.length; i++) {
                                        formdata.append('products' + i + 'product_id', context.arr[i].product_id);
                                         formdata.append('products' + i + 'product_name', context.arr[i].product_name);
                                          formdata.append('products' + i + 'description', context.arr[i].description);
                                           formdata.append('products' + i + 'quantity', context.arr[i].quantity);
                                            formdata.append('products' + i + 'price', context.arr[i].price);
                                             formdata.append('products' + i + 'tax_rate_id', context.arr[i].tax_rate_id);
                                              formdata.append('products' + i + 'total', context.arr[i].total);
                                    }
                                    formdata.append('subtotal', context.subtotal);
                                     formdata.append('discountval', context.discountval);
                                      formdata.append('totaltax', context.totaltax);
                                       formdata.append('wholetotal', context.wholetotal);
                                        formdata.append('balance', context.balance);
                                         formdata.append('note', context.note);
                                    for (let i = 0; i < context.bindfile.length; i++) {
                                        context.bind_file_name.push(context.bindfile[i].name);
                                    }
                                    formdata.append('bindfile', context.bind_file_name); 
                                     formdata.append('footer', context.invoiceform.footer);
                                      formdata.append('terms', context.invoiceform.terms);
                                       formdata.append('invoice_number', context.invoiceform.invoice_number);
                                    if (context.invoiceform.date != '') {
                                        var dateObj = new Date(context.invoiceform.date);
                                         var momentObj = moment(dateObj);
                                          var momentString = momentObj.format('YYYY-MM-DD');
                                           context.invoiceform.date = momentString;
                                            formdata.append('date', context.invoiceform.date);
                                    }

                                    if (context.invoiceform.expires_on != '') {
                                        var dateObj = new Date(context.invoiceform.expires_on);
                                         var momentObj = moment(dateObj);
                                          var momentString = momentObj.format('YYYY-MM-DD');
                                           context.invoiceform.expires_on = momentString;
                                            formdata.append('expires_on', context.invoiceform.expires_on);
                                    }
                                    formdata.append('discount', context.invoiceform.discount);
                                     formdata.append('currency_id', context.invoiceform.currency_id);
                                      formdata.append('invoice_status_id', context.invoiceform.invoice_status_id);
                                       formdata.append('subtotal', context.subtotal);
                                        formdata.append('discountval', context.discountval);
                                         formdata.append('totaltax', context.totaltax);
                                          formdata.append('wholetotal', context.wholetotal);
                                           formdata.append('balance', context.balance);
                                            formdata.append('note', context.note);
                                    formdata.append('id', context.$route.query.id);
                                    if (context.invoiceform.datafile) {
                                        context.invoiceform.datafile.forEach(file => {
                                            formdata.append("images[]", file);
                                        });
                                    }
                                    axios.post(url, formdata, config).then(response => {
                                        if (response.data.status == 1) {
                                            context.$buefy.toast.open({
                                                duration: 4000,
                                                 message: response.data.message,
                                                  title: "submitted success",
                                                   type: "is-danger",
                                                    position: "is-top-right"
                                            });
                                            context.$router.push('/quote');
                                        } else {
                                            context.$buefy.toast.open({
                                                duration: 4000,
                                                 message: response.data.message,
                                                  type: "is-success",
                                                   position: "is-top-right",
                                            });
                                            context.$router.push('/invoice');
                                        }
                                    })
                                     .finally(() => {
                                       context.setLoading(false);
                                });
                                }else{
                                 context.setLoading(false);
                                }
                            });
                        } else if (context.editMode === false) {
                             context.setLoading(true);
                             context.$validator.validate().then(valid => {
                                if (valid) {
                                    let url = '/invoiceupdate';
                                    let config = {
                                    headers: {
                                        'content-type': 'application/json'
                                        }
                                    };
                                    let formdata = new FormData();
                                     context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;
                                      formdata.append('number_of_products', context.arr.length);
                                       for (let i = 0; i < context.arr.length; i++) {
                                        formdata.append('products' + i + 'product_name', context.arr[i].product_name);
                                         formdata.append('products' + i + 'description', context.arr[i].description);
                                          formdata.append('products' + i + 'quantity', context.arr[i].quantity);
                                           formdata.append('products' + i + 'price', context.arr[i].price);
                                            formdata.append('products' + i + 'tax_rate_id', context.arr[i].tax_rate_id);
                                             formdata.append('products' + i + 'total', context.arr[i].total);
                                    }
                                    formdata.append('subtotal', context.subtotal);
                                     formdata.append('discountval', context.discountval);
                                      formdata.append('totaltax', context.totaltax);
                                       formdata.append('wholetotal', context.wholetotal);
                                        formdata.append('balance', context.balance);
                                         formdata.append('note', context.note);
                                          formdata.append('footer', context.invoiceform.footer);
                                           formdata.append('terms', context.invoiceform.terms);
                                            formdata.append('invoice_number', context.invoiceform.invoice_number);
                                    if (context.invoiceform.date != '') {
                                        var dateObj = new Date(context.invoiceform.date);
                                         var momentObj = moment(dateObj);
                                          var momentString = momentObj.format('YYYY-MM-DD');
                                           context.invoiceform.date = momentString;
                                            formdata.append('date', context.invoiceform.date);
                                    }
                                    if (context.invoiceform.expires_on != '') {
                                        var dateObj = new Date(context.invoiceform.expires_on);
                                         var momentObj = moment(dateObj);
                                          var momentString = momentObj.format('YYYY-MM-DD');
                                           context.invoiceform.expires_on = momentString;
                                            formdata.append('expires_on', context.invoiceform.expires_on);
                                    }
                                    formdata.append('discount', context.invoiceform.discount);
                                     formdata.append('currency_id', context.invoiceform.currency_id);
                                      formdata.append('invoice_status_id', context.invoiceform.invoice_status_id);
                                       formdata.append('subtotal', context.subtotal);
                                        formdata.append('discountval', context.discountval);
                                         formdata.append('totaltax', context.totaltax);
                                          formdata.append('balance', context.balance);
                                           formdata.append('note', context.note);
                                    formdata.append('id', context.$route.query.id);
                                    if (context.invoiceform.datafile) {
                                        context.invoiceform.datafile.forEach(file => {
                                            formdata.append("images[]", file);
                                        });
                                    }
                                    axios.post(url, formdata, config).then(response => {
                                        if (response.data.status == 1) {
                                            context.$buefy.toast.open({
                                                duration: 4000,
                                                 message: response.data.message,
                                                  title: "submitted success",
                                                   type: "is-danger",
                                                    position: "is-top-right"
                                            });
                                        } else {
                                            context.$buefy.toast.open({
                                                duration: 4000,
                                                 message: response.data.message,
                                                  position: "is-top-right",
                                                   type: "is-success"
                                            });
                                            context.$router.push('/invoice');
                                        }
                                    })
                                    .finally(() => {
                                      context.setLoading(false);
                                });
                                }
                            });
                        }
                    }else{
                     context.setLoading(false);
                    }
                });
            }
        },

        getinvoiceno() {
            this.setLoading(true);
            let url = '/invoiceno';
             axios.post(url, {
              invoice_number: this.invoiceform.invoice_number
            }).then(response => {
                this.invoicenumber = response.data.invoicenumberDetails;
                 if (response.data.status == 1) {
                } else {
                    this.$buefy.toast.open({
                        duration: 4000,
                         message: response.data.message,
                          position: "is-top-right",
                           type: "is-danger"
                    });
                    this.invoiceform.invoice_number = "";
                }
            }) 
             .finally(() => {
                this.setLoading(false);
              });
        },

        myFunction(selected) {
            productIndex = -1;
             let url = '/autoProduct';
              axios.get(url).then((response) => {
                const product_id = response.data.product_details;
                 product_id.forEach(function(value, index) {
                });
                const product_name = response.data.product;
                 product_name.forEach(function(value, index) {
                    if (value === selected) {
                        productIndex = index;
                    }
                });
                const description = response.data.description;
                 this.product = response.data.product[productIndex];
                  this.description = response.data.description[productIndex];
                   this.price = response.data.price[productIndex];
                    const data = response.data.price
                     data.forEach(function(price, index) {
                });
                this.selectedproduct.push(
                 response.data.product[productIndex]
                );
                this.arr[this.index].description = this.description;
                 this.arr[this.index].price = this.price;
                  this.arr[this.index].product_id = response.data.product_details[productIndex];
            });
        },

        destroy() {
            this.setLoading(true);
             let uri = "/invoice/" + this.$route.query.id;
              axios
               .delete(uri)
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
                    this.$router.push('/Invoice');
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                this.setLoading(false);
              });
        },

        gettax() { 
            this.setLoading(true);
            let uri = '/listTaxRate';
              axios.get(uri).then((response) => {
               this.tax_rate_id = response.data.TaxRateDetails;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

        getinvoice() {
            let temp_subtotal = 0;
            let temp_totaltax = 0;
            let temp_wholetotal = 0;
            let temp_balance = 0;
            this.setLoading(true);
             let uri = '/invoiceView/' + this.$route.query.id;
              axios.get(uri).then((response) => {
               this.company = response.data.companyDetails;
                this.Invoiceform = response.data.invoiceviewdetails;
                 this.client.client_name = this.Invoiceform.client_name;
                  this.client.address = this.Invoiceform.address;
                   this.client.city = this.Invoiceform.city;
                    this.client.state = this.Invoiceform.state;
                     this.client.postal_code = this.Invoiceform.postal_code;
                      this.$route.query.client_id = this.Invoiceform.client_id;
                       this.client.country = this.Invoiceform.country;
                        this.client.phone_number = this.Invoiceform.phone_number;
                         this.client.mobile_number = this.Invoiceform.mobile_number;
                          this.client.web_site = this.Invoiceform.web_site;
                           this.client.tax_code = this.Invoiceform.tax_code;
                            this.client.fax_number = this.Invoiceform.fax_number;
                             this.client.default_currency = this.Invoiceform.default_currency;
                              this.client.email = this.Invoiceform.email;
                               var dateMomentObj = response.data.invoiceviewdetails.date;
                                var DateObj = moment(dateMomentObj);
                                 this.invoiceform.date = new Date(DateObj);
                                  var dateMomentObj = response.data.invoiceviewdetails.expires_on;
                                   var DateObj = moment(dateMomentObj);
                                    this.invoiceform.expires_on = new Date(DateObj);

                this.invoiceform.invoice_number = this.Invoiceform.invoice_number;
                 this.invoiceform.discount = this.Invoiceform.discount;
                  this.invoiceform.terms = this.Invoiceform.terms;
                   this.invoiceform.footer = this.Invoiceform.footer;
                    this.invoiceform.currency_id = this.Invoiceform.currency_id;
                     this.currencysymbol = this.Invoiceform.currency_symbol;
                      this.currencyplace = this.Invoiceform.currency_placement;
                       this.currencydecimal = this.Invoiceform.currency_decimal;
                        this.currencythousands = this.Invoiceform.currency_thousands;
                         this.invoiceform.invoice_status_id = this.Invoiceform.invoice_status_id;
                          this.invoiceform.paid = this.Invoiceform.total_paid_amount;
                           this.invoiceform.balance = this.Invoiceform.balance;
                          
                for (let i in response.data.invoiceviewdetails.notes) {
                    this.note.push(response.data.invoiceviewdetails.notes[i].note);
                }
                if (response.data.invoiceviewdetails.products.length > 0) {
                    this.arr = [];
                }
                for (var i = 0; i < response.data.invoiceviewdetails.products.length; i++) {
                    this.selectedproduct.push(response.data.invoiceviewdetails.products[i].product_name);
                     totalamount = (response.data.invoiceviewdetails.products[i].quantity * response.data.invoiceviewdetails.products[i].price);
                      total = (totalamount * response.data.invoiceviewdetails.products[i].tax_value / 100);
                       this.arr.push({
                        product_id: response.data.invoiceviewdetails.products[i].product_id,
                         product_name: response.data.invoiceviewdetails.products[i].product_name,
                          description: response.data.invoiceviewdetails.products[i].description,
                           quantity: response.data.invoiceviewdetails.products[i].quantity,
                            price: response.data.invoiceviewdetails.products[i].price,
                             tax_rate_id: response.data.invoiceviewdetails.products[i].tax_value,
                              total: totalamount + total
                    });
                }
                for (let i = 0; i < response.data.invoiceviewdetails.file.length; i++) {
                    let file = response.data.invoiceviewdetails.file[i];
                     this.bindfile.push({
                      name: file.file_name,
                       file_path: file.file_path
                    });
                    this.download_path = response.data.invoiceviewdetails.download_path;
                }
            })
              .finally(() => {
                this.setLoading(false);
              });
            for (let j = 0; j < this.arr.length; j++) {
                temp_subtotal += this.arr[j].quantity * this.arr[j].price
                 temp_totaltax += ((this.arr[j].quantity * this.arr[j].price) * (this.arr[j].tax_rate_id / 100));
                  temp_wholetotal += this.arr[j].total;
            }
            this.totaltax = temp_totaltax;
             this.subtotal = temp_subtotal;
              this.discountval = (this.subtotal * this.invoiceform.discount / 100);
               this.wholetotal = (temp_wholetotal - this.discountval);
                this.balance = this.invoiceform.balance;
                
        },

        getclient() {
          this.setLoading(true);
            let uri = '/invoice/' + this.$route.query.id;
             axios.get(uri).then((response) => {
                this.client = response.data.clientdetails;
                 this.company = response.data.companydetails;
                  var momentObj = moment(response.data.InvoiceDate);
                   this.DateObj = new Date(momentObj);
                    this.invoiceform.date =this.DateObj;
                     this.maxDate = this.invoiceform.date;
                      const selectedDate = new Date(this.maxDate);
                       this.minDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate() + 10);
                        this.invoiceform.expires_on = this.minDate;
            })
             .finally(() => {
                this.setLoading(false);
              });
        },

        editclient() {
            if (this.$route.query.client_id != '' && this.$route.query.client_id != null) {
              this.setLoading(true);
                let url = '/Client/' + this.$route.query.client_id;
                 let formdata = new FormData();
                  formdata.append('client_name', this.client.client_name);
                   formdata.append('email', this.client.email);
                    formdata.append('address', this.client.address);
                     formdata.append('city', this.client.city);
                      formdata.append('state', this.client.state);
                       formdata.append('postal_code', this.client.postal_code);
                        formdata.append('country', this.client.country);
                         formdata.append('phone_number', this.client.phone_number);
                          formdata.append('fax_number', this.client.fax_number);
                           formdata.append('mobile_number', this.client.mobile_number);
                            formdata.append('web_site', this.client.web_site);
                             formdata.append('default_currency', this.client.default_currency);
                              formdata.append('tax_code', this.client.tax_code);
                axios.put(url, this.client).then((response) => {
                        if (response.data.status == 1) {
                         this.$buefy.toast.open({
                          duration: 4000,
                            message: response.data.message,
                              type: "is-success",
                               position: "is-top-right"
                            });
                            //this.$router.push(this.uri);
                        } else {
                            this.$buefy.toast.open({
                                duration: 4000,
                                 message: response.data.message,
                                  position: "is-top-right",
                                   type: "is-danger",
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {
                      this.setLoading(false);
                });
             }
          },

        getpayment() {
              this.setLoading(true);
            let uri = '/paymentview/' + this.$route.query.id;
             axios.get(uri).then((response) => {
              this.item = response.data.paymentviewDetails;
            })
             .finally(() => {
                this.setLoading(false);
              }); 
        },

        getInvoicestatus() {
             this.setLoading(true);
            let uri = '/invoicestatus';
             axios.get(uri).then((response) => {
              this.invoice_status = response.data.invoice_statusDetails;
            })
            .finally(() => {
                this.setLoading(false);
              });
        },

        savefile() {
             this.setLoading(true);
            let currentObj = this;
             axios.get('/pdfview', {
              query: {
                invoice_id: this.$route.query.id
                }
            }).then((response) => {
                var link = document.createElement('a');
                 link.href = response.data.data.outputfile;
                  link.target = "_blank";
                   link.download = response.data.name;
                    link.dispatchEvent(new MouseEvent('click'));
            })
             .finally(() => {
                this.setLoading(false);
              });
        },
    }, 

    computed: {
  ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

        priceError() {
            if (this.invoiceform.terms == "")
                return this.validterms
        },

        footerError() {
            if (this.invoiceform.footer == "") {
                return this.validfooter
            }
        },

        nameError() {
            if (this.client.client_name == "")
                return this.validname
            else
                return this.validalphaspaces
        },

        addressError() {
            if (this.client.address == "")
                return this.validaddress
        },

        cityError() {
            if (this.client.city == "")
                return this.validcity
            else
                return this.validalphaspaces
        },

        stateError() {
            if (this.client.state == "")
                return this.validstate
            else
                return this.validalphaspaces
        },

        postalcodeError() {
            if (this.client.postal_code == "")
                return this.validpostalcode
            else
                return this.numberAllowed
        },

        countryError() {
            if (this.client.country == "")
                return this.validcountry
            else
                return this.validalphaspaces
        },

        taxcodeError() {
            if (this.client.tax_code == "")
                return this.validtax_code
        },

        wholeTotal() {
            return this.wholetotal.toString(this.currencydecimal).replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
        },

        Subtotal() {
            return this.subtotal.toString(this.currencydecimal).replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
        },

        Discountval() {
            return this.discountval.toString(this.currencydecimal).replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
        },
 
        Totaltax() {
            return this.totaltax.toString(this.currencydecimal).replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
        },

        Balance() {
            return this.balance.toString(this.currencydecimal).replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
        },

        

      paymentDataArray: function() {
       var self = this;
        return this.item.filter(function(cust) {
         return (
          cust.paymenttype_id.toLowerCase().indexOf(self.search.toLowerCase()) >=
            0 
        );
      });
    },

        filteredDataArray() {
            if (this.data != null && this.data != "") {
                let temp_data = '';
                  temp_data = this.data.filter((option) => {
                    return option
                     .toString()
                      .toLowerCase()
                       .indexOf(this.arr[this.index].product_name.toLowerCase()) >= 0
                })
                let selected_item = this.selectedproduct
                 temp_data = temp_data.filter(function(option) {
                  return !selected_item.includes(option);
                })
                this.products_store = temp_data;
                return (this.products_store);
            }
        },

        calculatedFromAmount() {

            let temp_subtotal = 0;
             let temp_discountval = 0;
              let temp_discount = 0;
               let temp_totaltax = 0;
                let temp_wholetotal = 0;
                 let temp_balance = 0;
                  let arr_subtotal = [];
                   let arr_discountval = [];
                    let arr_discount = [];
                     let arr_totaltax = [];
                      let arr_wholetotal = [];
                       let arr_balance = [];
                        let i = this.index;

            for (let i = 0; i < this.arr.length; i++) {
                totalamount = (this.arr[i].quantity * this.arr[i].price);
                 total = (totalamount * this.arr[i].tax_rate_id / 100);
                  this.arr[i].total = totalamount + total;
            }
            for (let j = 0; j < this.arr.length; j++)
            {
             temp_subtotal = this.arr[j].quantity * this.arr[j].price;
              temp_discount = (temp_subtotal * this.invoiceform.discount / 100);
               temp_discountval = (temp_subtotal - temp_discount);
                temp_totaltax = (temp_discountval * this.arr[j].tax_rate_id / 100);
                 temp_wholetotal = this.arr[j].total;
                  arr_subtotal[j] = temp_subtotal;
                   arr_discount[j] = temp_discount;
                    arr_discountval[j] = temp_discountval;
                     arr_totaltax[j] = temp_totaltax;
                      arr_wholetotal[j] = temp_wholetotal;
            }
            temp_subtotal = 0;
             temp_discount = 0;
              temp_discountval = 0;
               temp_totaltax = 0;
                temp_wholetotal = 0;
            for (let k = 0; k < this.arr.length; k++) {
                temp_subtotal += arr_subtotal[k];
                 temp_discount += arr_discount[k];
                  temp_discountval += arr_discountval[k];
                   temp_totaltax += arr_totaltax[k];
                    temp_wholetotal += arr_wholetotal[k];
            }
            this.totaltax = (temp_totaltax).toFixed(this.currencydecimal);
             this.subtotal = (temp_subtotal).toFixed(this.currencydecimal);
              this.discountval = (this.subtotal * this.invoiceform.discount / 100).toFixed(this.currencydecimal);
               this.wholetotal = ((temp_subtotal + Number(this.totaltax)) - Number(this.discountval)).toFixed(this.currencydecimal);
                this.balance = (this.wholetotal - this.invoiceform.paid).toFixed(this.currencydecimal);
              
        }
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
   }.dropdown-content {
   float: left;
   }.sectionadd {
    padding: 1rem 1.5rem !important;
}

.drop-special .card-content
{
       padding-top: 5px!important;

}
</style>
