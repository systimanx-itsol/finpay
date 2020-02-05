<template>
   <form id="app" @submit.prevent="handleSubmit" >
      <section class="hero is-fullheight is-default is-bold drop-special ">
         <layout-header></layout-header>
         <div class="container containeg breadcrums1">
            <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Quotes</h6>
            <div class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
               <!-- <button1 class="button has-background-dark has-text-white is-size-7" :disabled="submitted==false" @click="savefile"><i
                  class="fas fa-print icon1"></i>
                  PDF
               </button1> -->
               <b-dropdown hoverable>
                  <button class="button has-background-dark has-text-white is-size-7" slot="trigger">
                  <span>OTHERS</span>
                  <span style="padding-left:8px"><i class="fas fa-caret-down"></i> </span></button>
                  <b-dropdown-item class="has-text-dark is-size-7 has-text-left"  @click="quotescopy" validate><i class="fas fa-copy icon1"></i>Copy</b-dropdown-item>
                  <b-dropdown-item class="has-text-dark is-size-7 has-text-left" @click="destory"><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item>
               </b-dropdown>
               <button class="button has-background-dark has-text-white is-size-7">
                  <router-link to="/Quote" class="has-text-white"> <i class="fas fa-backward icon1"></i> BACK
                  </router-link>
               </button>
               <button class="button has-background-dark has-text-white is-size-7" ><i class="far fa-save icon1"></i>SAVE</button>
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
                                 <!-- <a href="#" class="card-header-icon" slot="trigger" aria-label="more options">
                                 <span class="icon">
                                 <i class="fas fa-angle-down" aria-hidden="true"></i>
                                 </span>
                                 </a> -->
                                 <!-- <b-dropdown-item> <i class="fas fa-file icon1"></i> Save</b-dropdown-item> -->
                                 <!-- <b-dropdown-item><i class="fas fa-edit icon1"></i> Edit</b-dropdown-item> -->
                                 <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                              </b-dropdown>
                           </header>
                           <div class="card-content">
                              <div class="content">
                                 <h6 class="is-size-6 name-title">{{company.company_name}}</h6>
                                 <p class="address">
                                 {{company.address}},
                              <br/>{{company.city}}-
                                 {{company.zipcode}},
                                <br/>{{company.state}}<br/>
                               {{company.country}},
                         Mobile: {{company.mobile}},<br/>
                        Website: {{company.website}}.

                                    <!-- <br>Phone:984595454
                                    <br>Email: demo@fusioninvoice.com -->
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
                                    <a  @click="isClientModalActive=true; client (this.$route.query.id)" class="has-text-dark" >
                              <!-- <router-link :to="{name: 'quoteform', query: { id : this.$route.query.id, popup: true }}" class="has-text-dark"> -->
                                    <i class="fas fa-edit icon1"></i> Edit 
                                    <!-- </router-link>  -->
                                  </a>
                                    </b-dropdown-item>
                                 <!-- <b-dropdown-item><i class="fas fa-trash-alt icon1"></i>Delete</b-dropdown-item> -->
                              </b-dropdown>
                           </header>
                           <div class="card-content">
                              <div class="content">
                                 <h6 class="is-size-6 name-title">{{client.client_name}}</h6>
                                 <p class="address">
                                    {{client.address}},
                               <br/>{{client.city}},
                                     -{{client.postal_code}},
                                 <br/>Phone: {{client.phone_number}},
                                    <br/>E-mail: {{client.email}}.
                                 <p class="address">
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
      

        <b-modal :active.sync="isClientModalActive" :width="1000">
           
                      <div class="card section sect">
 <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Edit Client</h4>
  <form id="app" @submit.prevent="clientSubmit" validate>                    

               
                    
     <div class="columns ">
          <div class="column">
            <p class="bd-notification is-info">
              <label>Client Name <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="client_name" name="client_name" v-model="client.client_name" v-validate="'required|alpha_spaces'" 
                    placeholder=" Name">
                </p>
                 <span v-show="errors.has('client_name')" class="invalid-feedback">{{nameError}}</span> 
               
              </div>
            </p>      

             <p class="bd-notification is-info">
              <label>Email <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="email" name="email" v-model="client.email" v-validate="'required|email'"
                   placeholder="Email" disabled>
                </p>
                 <span v-show="errors.has('email')" class="invalid-feedback">{{validEmail}}</span> 
              </div>
            </p>

            <p class="bd-notification is-info">
              <label>Address <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <textarea placeholder="Address" class="textarea is-small is-shadowless" id="address" name="address" v-model="client.address" v-validate="'required'"
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
                  <input class="input" type="text" id="city" name="city" v-model="client.city" v-validate="'required|alpha_spaces'"
                   placeholder="City">
                </p>
                 <span v-show="errors.has('city')" class="invalid-feedback">{{cityError}} </span> 
              </div>
            </p>

             <p class="bd-notification is-info">
              <label>State <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="state" name="state" v-model="client.state" v-validate="'required|alpha_spaces'"
                    placeholder="State">
                </p>
               <span v-show="errors.has('state')" class="invalid-feedback">{{stateError}}</span>
              
              </div>
              </p>
    
         <p class="bd-notification is-info">
              <label>Postal Code <span class="has-text-danger	">*</span>
              </label>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input" type="text" id="postal_code" name="postal_code" v-model="client.postal_code"
                   v-validate="'required|numeric'" placeholder="Postal Code">
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
                   v-validate="'required|alpha_spaces'"  placeholder="Country">
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
                   id="phone_number" name="phone_number" 
                  v-model="client.phone_number"
                   placeholder="phone number" 
                
                    >
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
                    <!-- <select name="default_currency" id="default_currency" >
                      <option value="0">SGD</option>
                      <option value="1">MYR</option>
                    </select> -->
 <select id="default_currency" name="default_currency" v-model="client.default_currency" class="select-defaultcurrency">
                      <option v-for="currencies in defaultcurrency" :key="currencies.id" v-bind:value="currencies.id">
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
                  <input class="input" type="text" id="tax_code" name="tax_code" v-model="client.tax_code"
                     placeholder="Tax Number">
                </p>
               
              
              </div>
            </p>
           
         </div>
      </div>

<button  class="button is-dark is-small is-pulled-right" @click="isClientModalActive = false">Submit</button >
<a class="button has-background-light is-small is-pulled-right clearbuton">Cancel</a>
</form>
</div>           
 </b-modal>
 </section>
</template>
                  <div class="card">
                     <header class="card-header">
                        <p class="card-header-title">Items</p>
                        <div  v-if="editMode === false" class="has-text-right	 is-full">
                           <div id="button"  >
                              <button type="button" class="button is-dark  is-small delete-row"  @click="addCurrent">Add
                              a row</button>
                           </div>
                        </div>
                        <!-- <p class="card-header-title">Items</p> -->
                        <a href="#" class="card-header-icon" aria-label="more options">
                           <!-- <span class="icon">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                              </span> -->
                        </a>
                     </header>
                     <div class="card-content">
                        <div v-if="editMode == false" class="columns addandremove" v-for="(el,index) in arr" :key="index">
                           <div class="columns">
                              <div class="column is-2">
                                 <div class="bd-notification is-info">
                                    <label>
                                    Product
                                    <span class="has-text-danger">*</span>
                                    </label>
                                    <div class="field">
                                       <p class="control has-icons-left has-icons-right">
                                          <b-autocomplete id="product_name" name="product_name" v-model="el.product_name"
                                             field="title" @select="getPrice" :key="el.index" @typing="getAsyncData(index)"
                                             :data="filteredDataArray" v-validate="'required'"
                                             placeholder="product" icon="magnify">
                                             <template slot="empty">No results found</template>
                                             <!-- <option v-for="(product_id,index) in product" :key="index" :value="product.product_id">{{product.product_name}}</option> -->
                                          </b-autocomplete>
                                       </p>
                                         <span  v-if="arr.length-1 == index" v-show="errors.has('product_name')" class="invalid-feedback">{{"Productname is required"}}</span> 
                                    </div>
                                    <!-- <span v-show="errors.has('product_name')" class="invalid-feedback">{{requiredproductname}}</span> -->
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
                                          <textarea id="description" name="description" v-model="el.description" 
                                             placeholder="Comments" class="textarea is-small is-shadowless para-des" readonly ></textarea>
                                       </p>
                                       <span v-show="errors.has('description')" class="invalid-feedback">{{"Description is required"}}</span>
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
                                          <input id="quantity" name="quantity" v-model="el.quantity" class="input" type="text" v-validate="'required'"
                                             placeholder="Quantity">
                                       </p>
                                      
                                    </div>
                                     <span  v-if="arr.length-1 == index" v-show="errors.has('quantity')" class="invalid-feedback">Field is required</span>
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
                                          <input id="'price" name="price" v-model="el.price" class="input" type="text" 
                                             placeholder="Price" readonly>
                                       </p>
                                       <span  v-if="arr.length-1 == index"  v-show="errors.has('price')" class="invalid-feedback">Field is required</span>
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
                                             <select id="'tax_rate_value" name="tax_rate_value" v-model="el.tax_rate_value" v-validate="'required'"
                                                class="select-tax">
                                                <option v-for="tax_rate in tax" v-bind:value="tax_rate.percentage">
                                                   {{tax_rate.percentage}}%
                                                </option>
                                                <!-- <option value="Active">0%</option>
                                                   <option value="Inactive">10%</option> -->
                                             </select>
                                               <span  v-if="arr.length-1 == index"  v-show="errors.has('tax_rate_value')" class="invalid-feedback">Field is required</span> 
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
                                          <input id="total" name="total" class="input" type="text" v-onchange="calculatedFromAmount"
                                             v-model="el.total" readonly>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <!-- <div class="column"> -->
                              <!-- <div  v-if="editMode === false" class="has-text-right  is-full">
                                 <div id="button_container_1">
                                    <button type="button" class="button is-dark  is-small delete-row" @click="addRow">Add a row</button> -->
                              <div class="colms" v-if="index != 0">
                                 <button type="button" class="delete  is-small delete-row"  @click="data=''; deleteFiles(index)">
                                 </button>
                              </div>
                           </div>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="columns" v-for="(el,index) in arr" :key="index"> -->
                        <!-- cut form hear --> 
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
                                             <textarea id="terms" name="terms" v-model="quoteform.terms" v-validate="'required'"  placeholder="Terms & Conditions"
                                                class="textarea is-small is-shadowless"></textarea>
                                          </p>
                                             <span v-show="errors.has('footer')" class="invalid-feedback">{{termsError}}</span>
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
                                             <textarea id="footer" name="footer" v-model="quoteform.footer" v-validate="'required'" placeholder="Footer"
                                                class="textarea is-small is-shadowless"></textarea>
                                          </p>
                                          <span v-show="errors.has('footer')" class="invalid-feedback">{{footerError}}</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </b-tab-item>
                           <b-tab-item label="Notes">
                              
                              <template>
                                 <section>
                                    <ul class="list-unstyled chat-sections1">
                                       <li>
                                          <p class="is-size-7 datetime is-pulled-right">
                                             {{ new Date().getDate() }}/
                                             {{ new Date().getMonth()+1 }}/
                                             {{ new Date().getFullYear() }}
                                             <!-- <text id="summary" name="summary" v-model ="quoteform.summary"> -->
                                          </p>
                                          <br>
                                          <i class="fas fa-user icons1 is-size-5"></i> <span class="files">
                                          <i class="fas fa-caret-left"></i>
                                          Type Notes </span>
                                       </li>
                                       <li v-for="(file, index) in note" :key="index" class=" is-primary">
                                          <p class="is-size-7 datetime is-pulled-right">
                                             {{ new Date().getDate() }}/
                                             {{ new Date().getMonth()+1 }}/
                                             {{ new Date().getFullYear() }}
                                             <button class="delete is-small" type="button" @click="deleteelement(index); deleteFile(index); ">
                                             </button>
                                          </p>
                                          <br>
                                          <i class="fas fa-user icons1 is-size-5"></i> <span class="files">
                                          <i class="fas fa-caret-left"></i>
                                          {{file}}</span>
                                       </li>
                                    </ul>
                                    <b-field label="Notes" class="is-size-7 is-shadowless	">
                                       <b-taginput class="is-shadowless" v-model="note">
                                       </b-taginput>
                                    </b-field>
                                 </section>
                              </template>
                           </b-tab-item>
                           <b-tab-item label="Attachments">
                              <p class="bd-notification is-info">
                                 <label>Files
                                 </label>
                              <table class="table is-striped filetable" style="width:100%;">
                                 <thead>
                                    <!-- <tr>
                                       <th scope="col">File Name</th>
                                       <th scope="col">Date</th>
                                       <th scope="col">Delete</th>
                                       </tr> -->
                                 </thead>
                                 <tbody>
                                    <tr v-for="(file, index) in bindfile" :key="index" class=" is-primary">
                                       <td scope="row" class="is-size-7 is-uppercase" style="font-weight:400">
                                          <a v-if="file.file_path" :href="download_path + file.name">{{file.name}}</a>
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
                                    <tr v-for="(file, index) in quoteform.file_name" :key="index" class=" is-primary">
                                       <td scope="row" class="is-size-7 is-uppercase" style="font-weight:400">
                                          <a v-if="file.file_path" :href="download_path + file.name">{{file.name}}</a>
                                          <a v-else> {{file.name}}</a>
                                       </td>
                                       <td class="is-size-7">
                                          {{ new Date().getDate() }}/
                                          {{ new Date().getMonth()+1 }}/
                                          {{ new Date().getFullYear() }}
                                       </td>
                                       <td> <button class="delete is-small" type="button" @click="deleteDropFile(index);">
                                          </button>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <b-field class="file">
                                 <b-upload v-model="quoteform.file_name" multiple drag-drop>
                                    <section class="section">
                                       <div class="content has-text-centered">
                                          <p class="is-marginless">
                                             <b-icon><i class="fas fa-cloud-upload-alt is-size-2"></i>
                                             </b-icon>
                                          </p>
                                          <p class="is-size-7">Drop your files here or click to upload</p>
                                       </div>
                                    </section>
                                 </b-upload>
                              </b-field>
                              </p>
                           </b-tab-item>
                        </b-tabs>
                     </section>
                  </template>
               </div>
               <div class="column">
                  <div class="card section sectionadd is-clearfix form-quote">
                     <ul class="amounsec">
                        <li class="has-text-darker has-text-weight-semibold ">Subtotal <span class="has-text-weight-normal is-pulled-right"> {{currencyplace==0 ? currencysymbol : ''}} {{subtotal}} {{currencyplace==1 ? currencysymbol : ''}}  </span></li>
                        <li class="has-text-darker has-text-weight-semibold ">Discount <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{discount}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
                        <li class="has-text-darker has-text-weight-semibold ">Tax <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{taxtot}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
                        <li class="has-text-darker has-text-weight-semibold ">Total <span class="has-text-weight-normal is-pulled-right">{{currencyplace==0 ? currencysymbol : ''}} {{wholeTotal}} {{currencyplace==1 ? currencysymbol : ''}}</span></li>
                        <!-- <li class="has-text-darker has-text-weight-semibold " >Paid <span class="has-text-weight-normal is-pulled-right">{{paid}}</span></li>
                           <li class="has-text-darker has-text-weight-semibold " >Balance <span class="has-text-weight-normal is-pulled-right">{{balance}}</span></li> -->
                     </ul>
                  </div>
                  <br>
                  <div class="card section sectionadd is-clearfix form-quote">
                     <div class="bd-notification is-info">
                        <label>
                        Quote No
                        <span class="has-text-danger">*</span>
                        </label>
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <input id="quote_no" name="quote_no" v-model="quoteform.quote_no"  v-validate="'required'"  @blur="getquote"
                                 class="input" type="text" placeholder="Quote No">
                           </p>
                           <span v-show="errors.has('quote_no')" class="invalid-feedback">{{quotenoError}}</span>
                        </div>
                     </div>
                     <div class="bd-notification is-info">
                        <label>
                        Date
                        <span class="has-text-danger">*</span>
                        </label>
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <b-datepicker id="date" name="date" class="control has-icons-left has-icons-right" v-model="quoteform.date" @input="dateDisplay" 
                             :date-formatter="formatDate"   icon="calendar-today"
                                  placeholder="select" ></b-datepicker>
                           </p>
                           <!-- <span v-show="errors.has('date')" class="invalid-feedback">{{dateError}}</span> -->
                        </div>
                     </div>
                     <div class="bd-notification is-info">
                        <label>
                        Expires On
                        <span class="has-text-danger">*</span>
                        </label>
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <b-datepicker  name="expires_on" class="control has-icons-left has-icons-right"
                                 v-model="quoteform.expires_on" :date-formatter="formatDate"   
                                 placeholder="select" icon="calendar-today">
                              </b-datepicker>
                           </p>
                           <!-- <span v-show="errors.has('expires_on')" class="invalid-feedback">{{expiresonError}}</span> -->
                        </div>
                     </div>
                     <div class="bd-notification is-info">
                        <label>
                        Discount
                        <span class="has-text-danger"></span>
                        </label>
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <input id="discountpercentage" name="discountpercentage" v-model="quoteform.discountpercentage" class="input" 
                                 type="text" placeholder="Discount">
                           </p>
                           <!-- <span v-show="errors.has('discountpercentage')" class="invalid-feedback">{{discountpercentageError}}</span> -->
                        </div>
                     </div>
                     <div class="bd-notification is-info">
                        <label>Currency <span class="has-text-danger	">*</span></label>
                        <div class="field has-addons">
                           <div class="control is-expanded">
                              <div class="select is-fullwidth">
                                 <select id="currencies_id" name="currencies_id" v-model="quoteform.currencies_id" v-validate="'required'"
                                    @change="calculatedSymbol" class="select-currency">
                                    <!-- <option v-for="currencies in currency" v-bind:value="currencies.id"> -->
                                    <option :key="i" v-for="(currencies,i) in currency" v-bind:value="currencies.id" :selected="i===0">
                                       {{currencies.name}}
                                    </option>
                                 </select>
                                   <span v-show="errors.has('currencies_id')" class="invalid-feedback">{{currencyError}}</span>  
                              </div>
                           </div>
                         
                        </div>
                     </div>
                     <div class="bd-notification is-info">
                        <label>Staus <span class="has-text-danger	">*</span></label>
                        <div class="field has-addons">
                           <div class="control is-expanded">
                              <div class="select is-fullwidth">
                                 <select id="quotes_status_id" name="quotes_status_id" v-model="quoteform.quotes_status_id" v-validate="'required'"
                                    class="select-status">
                                    <option v-for="quotes_status_master in statuses" v-bind:value="quotes_status_master.quotesstatus_id">
                                       {{ quotes_status_master.quotesstatus }}
                                    </option>
                                 </select>
                                   <span v-show="errors.has('quotes_status_id')" class="invalid-feedback">{{statusError}}</span>   
                              </div>
                           </div>
                         
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section has-text-centered">
            <button  class="button has-background-light is-small  clearbuton" @click="clear">Clear</button>
            <button type="submit" class="button is-dark  is-small">Save</button>
         </div>
         <layout-footer></layout-footer>
      </section>
   </form>
</template>
<script>
   import { mapState, mapActions, mapGetters } from "vuex";
   import LayoutHeader from "./layouts/Header.vue";
   import LayoutFooter from "./layouts/Footer.vue";
   import { Validator } from "vee-validate";
   import moment from 'moment';
   import Vue from 'vue';
   import Router from 'vue-router'
   
   
   var productIndex = -1;
   var symbolIndex = -1;
   var totalcal;
   var totalamt;
   
 export default {
      components: {
         LayoutHeader,
         LayoutFooter
      },
     
     data() {
       return {
          tax:[],
          defaultcurrency: [],
           isClientModalActive: false,
           currencyplace:'',
           currencythousands: '',
           currencydecimal:[],
           systemquantities: [],
           systemtaxrounding:[],
            bind_file_name: [],
            copy: '',
            subtotal: 0,
            discount: 0,
            taxtot: 0,
            wholetotal:0,
            index: 0,
           
            currencysymbol: '',
            currency: [],
            note: [],
            bindfile: [],
            quote_template: [],
           
            current: {
            },
           tags: [],
      
         
            client_id: '',
            clientdata: '',
            quoteitem: '',
          
         client:
            {
               client_name: '',
               email: '',
               address: '',
               phone_number: '',
               city: '',
               state: '',
               postal_code: '',
               country: '',
               mobile_number: '',
               fax_number: '',
               web_site: '',
               default_currency: '',
               tax_code: '',
                status: 1,
            },

            quote:
            {
               date: '',
            },

            company:
            {
               company_name:'',
               address:'',
               phone:'',
               city: '',
               state: '',
               country: '',
               phone: '',
               zipcode:'',
               website: '',
            },
   
            quoteform:
            {
               file_name: [],
               quote_no: "",
               date: new Date(),
               expires_on: new Date(),
               currencies_id: "",
               discountpercentage: 0,
               download_path: "",
               terms: "",
               footer: "",
               quotes_status_id: "",
            },
   
            details: [],
            statuses: [],
            selectedproduct: [],
            submitted: false,
            editMode: false,
   
            arr: [{ product_id: '', product_name: '', tax_rate_id: '', description: '', quantity: '', tax_rate_value: '', price: '', total: '' }],
          
            data: [],
   
            isPaginated: true,
            isPaginationSimple: false,
            defaultSortDirection: "asc",
            currentPage: 1,
            perPage: 5,
            isFetching: false,
   
            validalphaspaces: "Only alphabet value accepted ",
            numberAllowed: "Only numeric value accepted",
  
         validname: "Client Name is required",
        validEmail: "Email is required",
        validaddress: "Address is required",
        validcity: "City is required",
        validstate: "State is required",
        validpostalcode: "Postal code is required",
        validcountry: "Country is required",
        validtax_code: "Taxvalue is required",
            validterms: "terms",
            validfooter: "footer",
            validquoteno: "quoteno",
            validdate: "date",
            // validexpires_on: "expireson",
            // validdiscountpercentage: "discount",
            // validquantity: "quantity",
            // validprice: "price",
            validcurrency: "Currency is required",
            validstatus: "Status is required",
            validproductname: "product_name",
            validdescription: "description",
            validquantity: "quantity",
            validprice: "price",
          }
      },
   
   
      mounted: function () {
          
         
         if (this.$route.query.client_id != null && this.$route.query.client_id != '') {
          this.client_id = this.$route.query.client_id;
           this.getclient();
         }
         this.gettax();
         this.getStatus();
         this.quantities();
         this.taxrounding();
         this.customFormatter();
         this.getcurrency();
         this.getdefaultcurrency();
         this.dateDisplay(new Date(),10);
    },
   
      created: function () {
         if( this.$route.query.edit.toString() == 'true')
            this.editgetquotes();
      },
   
        
     
     methods: {
         ...mapActions({
      setLoading: "setLoading"
    }),
        dateDisplay(theDate, days) {
         var dateObj = new Date(this.quoteform.date);
         var momentObj1 = this.quoteform.date
         var dateObj1 = moment(momentObj1);
         var myDate = new Date(theDate.getTime() + (10 * 24 * 60 * 60 * 1000));
         this.quoteform.expires_on = new Date(myDate);
       },
   
   destory() {
  //alert(10);
   this.setLoading(true);
    let uri = '/Quotes/' + this.$route.query.id;

    axios
     .delete(uri)
     .then(resp => {
      if (resp.data.status == 1) {
       this.$buefy.toast.open({
        duration: 4000,
        message: resp.data.message,
        type: "is-success",
        position: "is-top-right"
       });
       //   this.getdata();
      } else {
       this.$buefy.toast.open({
        duration: 4000,
        message: resp.data.message,
        position: "is-top-right",
        type: "is-danger"
       });
       // this.fetchdata();
      }
      this.$router.push('/quote');
     })

     .catch(error => {
      console.log(error);
     })
     .finally(() => {
                this.setLoading(false);
              });
   },

            getdefaultcurrency() {
             //  alert(1);
              this.setLoading(true);
            let url = '/listcurrencies';
             axios.get(url).then((response) => {
               this.defaultcurrency = response.data.currenciesDetail;
               // console.log("defaultcurrencies",response.data.currencyDetail);
            })
            .finally(() => {
                this.setLoading(false);
              });
         },
         clientSubmit(){
        //  alert(this.$route.query.client_id);
                 this.setLoading(true);
               if (this.$route.query.client_id != '' && this.$route.query.client_id != null) {
                  this.submitted = true;
                  
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
            //   if(this.user.mobile_number != undefined)
              formdata.append('mobile_number', this.client.mobile_number);
              formdata.append('web_site', this.client.web_site);
              formdata.append('default_currency', this.client.default_currency);
              formdata.append('tax_code', this.client.tax_code);
            //  formdata.append('status', this.client.status);
           //  console.log("status",this.client.status);
          axios.put(url,this.client).then((response) => {
            if (response.data.status == 1) {
              this.$buefy.toast.open({
                duration: 4000,
                message: response.data.message,
                title: "client details updated successfully",
                type: "is-success",
                position: "is-top-right",
              });
                //this.$router.push('/quoteform');
           }
            else {
              this.$buefy.toast.open({
                duration: 1000,
                message: response.data.message,
                title: "updated failed",
                position: "is-right-right",
                type: "is-danger"
              });

            }
          
          })
            .catch( error => { console.log(error); })
             .finally(() => {
                this.setLoading(false);
              });
       }
         
         },

   //    doSomething() {
   //          if (this.submitted) {
   //             return;
   //          }
   //         this.submitted = true;
   
   //    // do something to process the like
   
   //    // at some point release the 'clicked' state
   //    this.submitted = false;
   
   //    // or if you want to release the clicked state after a second (for whatever reason)
   //    setTimeout(
   //      function() {
   //        this.submitted = false;
   //      }.bind(this),
   //      1000
   //    );
   //  },
   
     formatter(date){
           return moment(new Date(date)).format(this.systemValue);
         },
         customFormatter(){
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
   
      formatDate(date){
          //  console.log("dataeformat",dt.toLocaleDateString(this.system));
          //  return dt.toLocaleDateString(this.system);
              return moment(new Date(date)).format(this.systemValue);
              
         },
       
         clear() {
            this.quoteform = {
               quote_no: "",
               date: "",
               expires_on: "",
               discount: 0,
               terms: "",
               footer: "",
               currencies_id: "",
               discountpercentage: "",
               download_path: "",
               quotes_status_id: "",
   
            }
            this.note = "";
            // this.file_name= "";
            this.file_name = []
           
           this.client = {
                client_name: '',
                email: '',
                address: '',
                client_id: '',
                phone_number: '',
           }
          this.arr = [{ product_id: '', product_name: '', description: '', quantity: '', price: '',tax_rate_id: '', tax_rate_value: '',  total: '' }]
        },
   
       quantities(){
           this.setLoading(true);
          let url = '/systemquantities';
           axios.get(url).then(response => {
            this.systemquantities = response.data.systemQuantities;
         })
         .finally(() => {
                this.setLoading(false);
              });
       },
      taxrounding(){
          this.setLoading(true);
         let url='/taxrounding';
           axios.get(url).then(response => {
            this.systemtaxrounding = response.data.systemTaxrounding;
         })
         .finally(() => {
                this.setLoading(false);
              });
      },
      
       
      
       
       deleteelement(index) {
           this.setLoading(true);
           let url = '/deletenote';
            axios.post(url, { id: this.$route.query.id, note: this.note[index] }).then(response => {
           this.quotenotedetail = response.data.quotenote;
           
               if (response.data.status == 1) {
                  this.$buefy.toast.open({
                     duration: 4000,
                     message: response.data.message,
                     type: "is-success",
                     position: "is-top-right"
                  });
               } else {
                  this.$buefy.toast.open({
                     duration: 4000,
                     message: response.data.message,
                     position: "is-top-right",
                     type: "is-danger"
                  });
                  this.quoteform.quote_no = "";
               }
            })
             .finally(() => {
                this.setLoading(false);
              });
         },
   
     getquote() {
            // let url = '/getquoteno';
            // axios.post(url, { quote_no: this.quoteform.quote_no }).then(response => {
            //  if (response.data.status == 1) {
            //       this.$buefy.toast.open({
            //          duration: 4000,
            //          message: response.data.message,
            //          type: "is-success",
            //          position: "is-top-right"
            //       });
            //    } else {
            //       this.$buefy.toast.open({
            //          duration: 4000,
            //          message: response.data.message,
            //          position: "is-top-right",
            //          type: "is-danger"
            //       });
            //       this.quoteform.quote_no = "";
            //    }
            // });
              let url = '/getquoteno';
                this.setLoading(true);
            axios.post(url, { quote_no: this.quoteform.quote_no }).then(response => {
             if (response.data.status == 0) {
                  this.$buefy.toast.open({
                     duration: 4000,
                     // message: response.data.message,
                     // type: "is-success",
                     // position: "is-top-right"
                  });
                  this.quoteform.quote_no = "";
               } 
            })
             .finally(() => {
                this.setLoading(false);
              });
         },
   
   
         getAsyncData(index) {
            this.index = index;
            if (Object.keys(this.arr[index].product_name).length > 1) {
               this.isFetching = true
               let url = '/autoProduct'
          axios.get(url,{ 
           query:{ 
           product_name: this.arr[index].product_name 
          }
           }).then(response => {
             this.data = response.data.product;
           
          })
          .catch((error) => {
               this.data = []
               console.log("AutoProduct :"+error);
            })
            .finally(() => {
               this.isFetching = false
            });
            }
         },
   
   
         handleSubmit(e) {
              let context = this;
            if (context.$route.query.id != '' && context.$route.query.id != null) {
               context.$validator.validate().then(valid => {

                    if (valid) {
               // console.log("aaaaa", context.arr.length);
               // for (let i = 0; i < context.arr.length; i++) {
               //    // console.log("product_id", context.arr[i].product_id);
               //    // console.log("product_name", context.arr[i].product_name);
               //    // console.log("description", context.arr[i].description);
               //    // console.log("quantity", context.arr[i].quantity);
               //    // console.log("price", context.arr[i].price);
               //    // console.log("tax_rate_value", context.arr[i].tax_rate_value);
               //    // console.log("total", context.arr[i].total);
               // }
               context.editMode = context.$route.query.edit.toString() == 'true'?true:false;
               context.note = context.note;
               context.submitted = true;
                context.setLoading(true);
   
   
               let url = '/quoteUpdate';
               // console.log("URL", url);
               let config = {
                  headers: {
                      Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                      'content-type': 'multipart/form-data'
                  }
               };
               let formdata = new FormData();
               context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;
   
   
             
               if (context.editMode === true) {
                  let url = '/updatequotedetails';
                  let config = {
                     headers: {
                          Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                      'content-type': 'multipart/form-data'
                     }
                  };
                  let formdata = new FormData();
                  context.response = process.env.MIX_QUOTES_UPDATE_RESPONSE;
                  // alert("its me")
                  formdata.append('number_of_products', context.arr.length);
                  for (let i = 0; i < context.arr.length; i++) {
                     formdata.append('products' + i + 'product_id', context.arr[i].product_id);
                     formdata.append('products' + i + 'product_name', context.arr[i].product_name);
                     formdata.append('products' + i + 'description', context.arr[i].description);
                     formdata.append('products' + i + 'quantity', context.arr[i].quantity);
                     formdata.append('products' + i + 'price', context.arr[i].price);
                     formdata.append('products' + i + 'tax_rate_value', context.arr[i].tax_rate_value);
                     formdata.append('products' + i + 'tax_rate_id', context.arr[i].tax_rate_id);
                     formdata.append('products' + i + 'total', context.arr[i].total);
                  }
                  formdata.append('note', context.note);
                  for (let i = 0; i < context.bindfile.length; i++) {
                     context.bind_file_name.push(context.bindfile[i].name);
                  }
                  formdata.append('bindfile', context.bind_file_name);
   
                  formdata.append('quote_no', context.quoteform.quote_no);
                  if (context.quoteform.date != '') {
                     var dateObj = new Date(context.quoteform.date);
                     var momentObj = moment(dateObj);
                     var momentString = momentObj.format('YYYY-MM-DD');
                     context.quoteform.date = momentString;
                     formdata.append('date', context.quoteform.date);
                  }
                  if (context.quoteform.expires_on != '') {
                     var dateObj1= new Date(context.quoteform.expires_on);
                     var momentObj = moment(dateObj1);
                     var momentString = momentObj.format('YYYY-MM-DD');
                     context.quoteform.expires_on = momentString;
                     formdata.append('expires_on', context.quoteform.expires_on);
   
                  }
               //  formdata.append('date', context.quoteform.date);
               //    formdata.append('expires_on', context.quoteform.expires_on);
                  formdata.append('discountpercentage', context.quoteform.discountpercentage);
                  formdata.append('currencies_id', context.quoteform.currencies_id);
                  formdata.append('quotes_status_id', context.quoteform.quotes_status_id);
                  formdata.append('terms', context.quoteform.terms);
                  formdata.append('footer', context.quoteform.footer);
                  formdata.append('subtotal', context.subtotal);
                  formdata.append('discount', context.discount);
                  formdata.append('taxtot', context.taxtot);
                  formdata.append('wholetotal', context.wholetotal);
               
   
                  formdata.append('id', context.$route.query.id);
                  if (context.quoteform.file_name) {
                     context.quoteform.file_name.forEach(file => {
                        formdata.append("images[]", file);
                     });
                  }
   
   
                  axios.post(url, formdata, config).then(response => {
                     
                     if (response.data.status == 1) {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           title: "submitted success",
                           type: "is-success",
                           position: "is-top-right"
                        });
                        context.$router.push('/quote');
                     } else {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           position: "is-bottom-right",
                           type: "is-danger"
                        });
                        context.$router.push('/quote');
                     }
                  })
                  .finally(() => {
                context.setLoading(false);
              });
   
               }
               else {
                //  alert(10);
                  context.$validator.validate().then(valid => {
                      context.setLoading(true);
                    if (valid) {
                 
                  let url = '/quoteUpdate';
                  // console.log("URL", url);
                  let config = {
                     headers: {
                          Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                          'content-type': 'multipart/form-data',
                          // 'content-type': 'application/json'
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
                     formdata.append('products' + i + 'tax_rate_value', context.arr[i].tax_rate_value);
                     formdata.append('products' + i + 'total', context.arr[i].total);
                  }
                  // formdata.append('note', context.note);
                  // for (let i = 0; i < context.bindfile.length; i++) {
                  //     context.bind_file_name.push(context.bindfile[i].name);
                  //    }
                  // formdata.append('bindfile',context.bind_file_name);
   
                  formdata.append('quote_no', context.quoteform.quote_no);
                  if (context.quoteform.date != '') {
                     var dateObj = new Date(context.quoteform.date);
                     var momentObj = moment(dateObj);
                     var momentString = momentObj.format('YYYY-MM-DD');
                     context.quoteform.date = momentString;
                     formdata.append('date', context.quoteform.date);
                  }
   
                   if (context.quoteform.expires_on != '') {
                     var dateObj= new Date(context.quoteform.expires_on);
                     // console.log("expiredate",dateObj);
                     var momentObj = moment(dateObj);
                     var momentString = momentObj.format('YYYY-MM-DD');
                     context.quoteform.expires_on = momentString;
                     formdata.append('expires_on', context.quoteform.expires_on);
              
                  }
                  
                  formdata.append('discountpercentage', context.quoteform.discountpercentage);
                  formdata.append('currencies_id', context.quoteform.currencies_id);
                  formdata.append('quotes_status_id', context.quoteform.quotes_status_id);
                  formdata.append('terms', context.quoteform.terms);
                  formdata.append('footer', context.quoteform.footer);
                  formdata.append('subtotal', context.subtotal);
                  formdata.append('discount', context.discount);
                  formdata.append('taxtot', context.taxtot);
                  formdata.append('wholetotal', context.wholetotal);
   
                  formdata.append('id', context.$route.query.id);
               //   formdata.append('client_id',context.$route.query.client_id);
                  if (context.quoteform.file_name) {
                     context.quoteform.file_name.forEach(file => {
                        formdata.append("images[]", file);
                     });
                  }
                    formdata.append('note', context.note);
                  // for (let i = 0; i < context.bindfile.length; i++) {
                  //     context.bind_file_name.push(context.bindfile[i].name);
                  //    }
                  // formdata.append('bindfile',context.bind_file_name);
                  axios.post(url, formdata, config).then(response => {
                     // console.log("quotesitemid",context.quotes_item_id);
                     if (response.data.status == 1) {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           title: "updated successfully",
                           type: "is-success",
                           position: "is-top-right"
                        });
                        context.$router.push('/quote');
                     } else {
                        context.$buefy.toast.open({
                           duration: 4000,
                           message: response.data.message,
                           position: "is-top-right",
                           type: "is-danger"
                        });
                        // context.$router.push('/quote');
                     }
                  })
                   .finally(() => {
                context.setLoading(false);
              });
                    }
                     context.setLoading(false);
                  });
               }
               }
                context.setLoading(false);
                });
            }
         },
         gettax() {
              this.setLoading(true);
            let url = '/Taxrate';
            // console.log(url);
            axios.get(url).then((response) => {
               this.tax = response.data.TaxRateDetails;
               // console.log(response.data.TaxRateDetails);
               // console.log(this.tax);
            })
             .finally(() => {
                this.setLoading(false);
              });
         },
   
         calculatedSymbol() {
            let temp = this.quoteform.currencies_id;
            for (let i in this.currency) {
               if (temp == this.currency[i].id) {
                 this.currencysymbol = this.currency[i].symbol;
                 this.currencyplace = this.currency[i].placement;
               //   this.currencythousands = this.currency[i].thousands;
               //   this.currencydecimal = this.currency[i].decimal;
              }
            }
       },
   
         // getcurrency() {
         //    let url = '/listCurrency';
       
         //    axios.get(url).then((response) => {
         //       this.currency = response.data.currencyDetails;
              

         //       console.log(this.currency , 'this.currency this.currency ')
          
             
         //       this.quoteform.currencysymbol = this.currency[0].symbol;
              
         //       this.quoteform.currencyplace =this.currency[0].placement;
         //       this.currencydecimal= this.currency[0].decimal;
         //       this.currencythousands = this.currency[0].thousands;
         //        //this.quoteform.currencies_id = this.currency[0].id;
         //    });
         // },
      getcurrency() {
         this.setLoading(true);
            let url = '/Currencies';
       
            axios.get(url).then((response) => {
               this.currency = response.data.currenciesDetails;
              

               // console.log(this.currency , 'this.currency this.currency ')
          
             
               this.quoteform.currencysymbol = this.currency[0].symbol;
              
               this.quoteform.currencyplace =this.currency[0].placement;
               this.currencydecimal= this.currency[0].decimal;
               this.currencythousands = this.currency[0].thousands;
                //this.quoteform.currencies_id = this.currency[0].id;
            })
             .finally(() => {
                this.setLoading(false);
              });
         },
     
   
   
         getStatus() {
             this.setLoading(true);
            let url = '/listStatus';
            axios.get(url).then((response) => {
            this.statuses = response.data.statusDetails;
            // this.quoteform.quotes_status_id = this.statuses[0].quotesstatus_id;
         })
         .finally(() => {
                this.setLoading(false);
              });
         },
        
          editgetquotes() {
              this.setLoading(true);
            let temp_subtotal = 0;
            let temp_totaltax = 0;
            let temp_wholetotal = 0;
          //   alert(5);
            let url = '/edit/' + this.$route.query.id;
            // console.log(url);
            axios.get(url).then(response => {
               this.details = response.data.quotesdetails;
               this.companydetails = response.data.companyDetail;

               this.company.company_name = response.data.companyDetail.company_name;
               this.company.city = response.data.companyDetail.city;
                this.company.address = response.data.companyDetail.address;
                  this.company.zipcode = response.data.companyDetail.zipcode;
                   this.company.state = response.data.companyDetail.state;
                  this.company.country = response.data.companyDetail.country;
                    this.company.mobile = response.data.companyDetail.mobile;
                      this.company.website = response.data.companyDetail.website;
   
               this.client.client_name = this.details.client_name;
               this.client.email = this.details.email;
               this.client.address = this.details.address;
               this.client.phone_number = response.data.quotesdetails.phone_number;
               this.client.state = response.data.quotesdetails.state;
               this.client.city = response.data.quotesdetails.city;
               this.client.postal_code = response.data.quotesdetails.postal_code;
               this.client.country = response.data.quotesdetails.country;
               this.client.default_currency = response.data.quotesdetails.default_currency;
               this.client.status = response.data.quotesdetails.status;
               this.client.fax_number = response.data.quotesdetails.fax_number;
               this.$route.query.client_id = this.details.client_id;
               this.client.tax_code = response.data.quotesdetails.tax_code;
               this.client.web_site = response.data.quotesdetails.web_site;
               this.client.mobile_number = response.data.quotesdetails.mobile_number;
               this.quoteform.quote_no = this.details.quote_no;
   
   
               var dateMomentObj = response.data.quotesdetails.date;
               var DateObj = moment(dateMomentObj);
              this.quoteform.date = new Date(DateObj);
   
            //  this.quoteform.date = this.details.date;
   
   
               var expiresonMomentObj = response.data.quotesdetails.expires_on;
               var dateObj1 = moment(expiresonMomentObj);
              this.quoteform.expires_on = new Date(dateObj1);
            //  this.quoteform.expires_on =this.details.expires_on;
   
               this.quoteform.terms = this.details.terms;
               this.quoteform.footer = this.details.footer;
               this.quoteform.discountpercentage = response.data.quotesdetails.discountpercentage;
              
   
   
               this.quoteform.currencies_id = this.details.currencies_id;
                this.currencyplace = response.data.quotesdetails.currency_placement;
               this.currencysymbol = response.data.quotesdetails.currency_symbol;
               // this.calculatedSymbol();
   
               this.quoteform.quotes_status_id = this.details.quotes_status_id;
   
   
               for (let i in response.data.quotesdetails.notes) {
   
                  this.note.push(response.data.quotesdetails.notes[i].note);
   
               }
   
               if (response.data.quotesdetails.products.length > 0) {
                  this.arr = [];
               }
   
                 for (var i = 0; i < response.data.quotesdetails.products.length; i++) {
                  this.selectedproduct.push(response.data.quotesdetails.products[i].product_name);
                  totalcal = (response.data.quotesdetails.products[i].quantity * response.data.quotesdetails.products[i].price);
                  totalamt = (totalcal * response.data.quotesdetails.products[i].tax_rate_value / 100);
   
                  this.arr.push({
                     product_id: response.data.quotesdetails.products[i].product_id,
                     product_name: response.data.quotesdetails.products[i].product_name,
                     description: response.data.quotesdetails.products[i].description,
                     quantity: response.data.quotesdetails.products[i].quantity,
                     price: response.data.quotesdetails.products[i].price,
                     tax_rate_id: response.data.quotesdetails.products[i].tax_rate_id,
                     tax_rate_value: parseInt(response.data.quotesdetails.products[i].tax_rate_value, 0),
                     total: totalcal + totalamt,
                  });
                 }
             
               for (let i = 0; i < response.data.quotesdetails.files.length; i++) {
                  let file = response.data.quotesdetails.files[i];
                   this.bindfile.push({
                     name: file.file_name,
                     file_path: file.file_path
                  });
                     this.download_path = response.data.quotesdetails.download_path;
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
            this.discount = (this.subtotal * this.quoteform.discountpercentage / 100);
            this.wholetotal = Number(temp_wholetotal) - Number(this.discount);
   
            },
   
   
         savefile() {
             this.setLoading(true);
          let currentObj = this;
            axios.get('/pdfviewquote', { query: { quotes_id: this.$route.query.id } }).then((response) => {
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
   
         getPrice(selected) {
            productIndex = -1;
            let url = '/autoProduct';
            axios.get(url).then((response) => {
               var product_id = response.data.product_details;
                  product_id.forEach(function (value, index) {
                  // console.log(value, index);
   
               });
               var product_name = response.data.product;
          
               product_name.forEach(function (value, index) {
                  if (value === selected) {
                     productIndex = index;
                  }
               });
               var description = response.data.description;
               var price = response.data.price
               this.product = response.data.product[productIndex];
               this.description = response.data.description[productIndex];
               this.price = response.data.price[productIndex];
             
             
               this.selectedproduct.push(
                  response.data.product[productIndex]
               );
   
             
               this.arr[this.index].description = response.data.description[productIndex];
               this.arr[this.index].price = response.data.price[productIndex];
               this.arr[this.index].product_id = response.data.product_details[productIndex];
             });
         },
         getclient() {
             this.setLoading(true);
            let url = '/Quotes/' + this.$route.query.id;
            axios.get(url).then((response) => {
               this.client = response.data.ClientDetails;
               this.company = response.data.companyDetails;
               var momentObj = moment(response.data.QuotesDate);
               var dateObj = new Date(momentObj);
               this.quoteform.date = dateObj;
             //  console.log("date", this.quoteform.date);
              var dateObj1 = moment(response.data.QuotesDate);
              var myDate = new Date( this.quoteform.date .getTime() + (10 * 24 * 60 * 60 * 1000));
              this.quoteform.expires_on = myDate;
           })
             .finally(() => {
                this.setLoading(false);
              });
          },


   quotescopy() {
   // alert(1);
    let context = this;
   //  console.log(this.$route.query.edit)
    if (context.$route.query.id != '' && context.$route.query.id != null) {


     for (let i = 0; i <= context.arr[i]; i++) {


       context.quoteform.product_name = context.arr[i].product_name;
               context.quoteform.description = context.arr[i].description;
               context.quoteform.quantity = context.arr[i].quantity;
               context.quoteform.price = context.arr[i].price;
               context.quoteform.tax_rate_value = context.arr[i].tax_rate_value;
                context.quoteform.tax_before_total = context.arr[i].tax_before_total;
      // context.note = context.note;
     }








     context.submitted = true;
   //   context.editMode = true;
      context.setLoading(true);
          
     let url = '/quotescopy'
     let config = {
      headers: {
       'content-type': 'application/json'
      }
     }


     let formdata = new FormData();
 

     if (context.editMode === false) {

      context.response = process.env.MIX_INVOICE_ADD_RESPONSE;
      if (context.arr) {
         formdata.append('number_of_products', context.arr.length);
         for (let i = 0; i < context.arr.length; i++) {
         formdata.append('products' + i + 'product_name', context.arr[i].product_name);
         formdata.append('products' + i + 'description', context.arr[i].description);
         formdata.append('products' + i + 'quantity', context.arr[i].quantity);
         formdata.append('products' + i + 'price', context.arr[i].price);
         formdata.append('products' + i + 'tax_rate_value', context.arr[i].tax_rate_value);
         formdata.append('products' + i + 'total', context.arr[i].total);
         }
         formdata.append('subtotal', context.subtotal);
         formdata.append('discount', context.discount);
         formdata.append('taxtot', context.taxtot);
         formdata.append('wholetotal', context.wholetotal);
         formdata.append('note', context.note);
      }
     } else if (context.editMode === true) {


      context.invoiceform.id = context.$route.query.id;
     
      formdata.append('number_of_products', context.arr.length);
      for (let i = 0; i < context.arr.length; i++) {
       formdata.append('products' + i + 'product_name', context.arr[i].product_name);
       formdata.append('products' + i + 'description', context.arr[i].description);
       formdata.append('products' + i + 'quantity', context.arr[i].quantity);
       formdata.append('products' + i + 'price', context.arr[i].price);
       formdata.append('products' + i + 'tax_rate_value', context.arr[i].tax_rate_value);
       formdata.append('products' + i + 'total', context.arr[i].total);
      }

                     formdata.append('subtotal', context.subtotal);
                     formdata.append('discount', context.discount);
                     formdata.append('taxtot', context.taxtot);
                     formdata.append('wholetotal', context.wholetotal);
                     formdata.append('note', context.note);
     }

     formdata.append('footer', context.quoteform.footer);
     formdata.append('terms', context.quoteform.terms);
     formdata.append('quotes_no', context.quoteform.quotes_no);
     if (context.quoteform.date != '') {
      var dateObj = new Date(context.quoteform.date);
      var momentObj = moment(dateObj);
      var momentString = momentObj.format('YYYY-MM-DD');
      context.quoteform.date = momentString;
      formdata.append('date', context.quoteform.date);
     }

     if (context.quoteform.expires_on != '') {
      var dateObj = new Date(context.quoteform.expires_on);
      var momentObj = moment(dateObj);
      var momentString = momentObj.format('YYYY-MM-DD');
      context.quoteform.expires_on = momentString;
      formdata.append('expires_on', context.quoteform.expires_on);

     }
    formdata.append('discountpercentage', context.quoteform.discountpercentage);
               formdata.append('currencies_id', context.quoteform.currencies_id);
               formdata.append('quotes_status_id', context.quoteform.quotes_status_id);
               formdata.append('subtotal', context.subtotal);
               formdata.append('discount', context.discount);
               formdata.append('taxtot', context.taxtot);
               formdata.append('wholetotal', context.wholetotal);
               formdata.append('note', context.note);
               formdata.append('quote_template','systimanx_quote');
         

     formdata.append('id', context.$route.query.id);
     if (context.quoteform.datafile) {
      context.quoteform.datafile.forEach(file => {
       formdata.append("images[]", file);
      });
     }

   
    // context.invoiceform.invoice_number ="";
     axios.post(url, formdata, config).then((response) => {


      if (response.data.status == 1) {
       context.$buefy.toast.open({
        duration: 4000,
        message: response.data.message,
        position: "is-top-right",
        type: "is-success",
       });
       context.$router.push('/quote');
      } else {
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
},

  deleteDropFile(index) {
            this.quoteform.file_name.splice(index, 1)
         },
        
         deleteDrop(index) {
            this.bindfile.splice(index, 1)
         },
         deleteFile(index) {
            this.note.splice(index, 1)
         },
         addCurrent(index) {
            if (this.arr[(this.arr.length)-1].product_name && this.arr[(this.arr.length)-1].quantity && this.arr[(this.arr.length)-1].tax_rate_value  != '' ) {     
            this.arr.push({ product_id: '', product_name: '', description: '', quantity: '', price: '',tax_rate_id: '', tax_rate_value: '',  total: '' }); 
            }else{
                this.$buefy.toast.open({
                duration: 4000,
                message: "Item Field is required",
                type: "is-danger",
                position: "is-top-right",
              });
            }
        },
         deleteFiles(index) {
           this.arr.splice(index,1);
       },
   },
   
      computed: {
          ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

        quotenoError(){
         
            if(this.quoteform.quote_no == "")
            return this.validquoteno
         
         },
         currencyError(){

            if(this.quoteform.currencies_id == "")
            return this.validcurrency
         },
         statusError(){
            if(this.quoteform.quotes_status_id == "")
            return this.validstatus
         },
      
         nameError(){
             if(this.client.client_name == "")
             return this.validname
         else
             return this.validalphaspaces
        },
         addressError(){
          if(this.client.address == "")
           return this.validaddress
        },
      cityError(){
         if(this.client.city == "")
         return this.validcity
       else
         return this.validalphaspaces
      },
      stateError(){
           if(this.client.state == "")
         return this.validstate
       else
         return this.validalphaspaces
      },
     postalcodeError(){
        if(this.client.postal_code == "")
         return this.validpostalcode
       else
         return this.numberAllowed
     },
    countryError(){
       if(this.client.country == "")
         return this.validcountry
       else
         return this.validalphaspaces
    },
    taxcodeError(){
       if(this.client.tax_code == "")
         return this.validtax_code
    },

     footerError(){
           if(this.quoteform.footer == "")
         return this.validfooter
       else
          return this.validalphaspaces
      },
   termsError(){
       if(this.quoteform.terms == "")
         return this.validterms
       else
          return this.validalphaspaces
   },

 wholeTotal(){
            return this.wholetotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, this.currencythousands);
         },
         filteredDataArray() {
            if(this.data !=null && this.data != "" ){
               let temp_data = '';
               temp_data = this.data.filter((option) => {
               
                  return option
                     .toString()
                     .toLowerCase()
                     .indexOf(this.arr[this.index].product_name.toLowerCase()) >= 0
               })
            
               let selected_item = this.selectedproduct
      
               temp_data = temp_data.filter(function (option) {
                  return !selected_item.includes(option);
               })
               return (temp_data);
            }
         },
   
         isDisabled() {
            return submitted == false
         },

   
     calculatedFromAmount() {
   
            let temp_subtotal = 0;
            let temp_discountvalue = 0;
            let temp_discount = 0;
            let temp_taxtot= 0;
            let temp_wholetotal = 0.0;
             let i = this.index;
           
   
            let arr_subtotal =[];
            let arr_discountvalue =[];
            let arr_discount=[];
            let arr_taxtot = [];
            let arr_wholetotal = [];   
           
          
           for(let i=0; i<this.arr.length; i++){
            totalcal = ((this.arr[i].quantity * this.arr[i].price));
            totalamt = (totalcal * this.arr[i].tax_rate_value / 100);
            this.arr[i].total = totalcal + totalamt;
           }
             
             for (let j = 0; j < this.arr.length; j++) {
               temp_subtotal = (this.arr[j].quantity * this.arr[j].price);
               
               temp_discount = (temp_subtotal * this.quoteform.discountpercentage / 100 );
               temp_discountvalue = (temp_subtotal - temp_discount);
               temp_taxtot = (temp_discountvalue * this.arr[j].tax_rate_value / 100);
               temp_wholetotal = Number(this.arr[j].total);
              
               arr_subtotal[j]=temp_subtotal;
               arr_discount[j]=temp_discount;
               arr_discountvalue[j]=temp_discountvalue;
               arr_taxtot[j]=temp_taxtot;
               arr_wholetotal[j]=temp_wholetotal;
               
           }
           
   
    temp_subtotal=0;
    temp_discount=0;
    temp_discountvalue=0;
    temp_taxtot=0;
    temp_wholetotal=0;
   
    for(let k=0;k < this.arr.length;k++){
      
       temp_subtotal += arr_subtotal[k];
       temp_discount += arr_discount[k];
       temp_discountvalue += arr_discountvalue[k];
       temp_taxtot += arr_taxtot[k];
       temp_wholetotal += arr_wholetotal[k];
    }
   
      this.taxtot = (temp_taxtot).toFixed(this.systemtaxrounding);
      this.subtotal = (temp_subtotal).toFixed(this.currencydecimal);
      this.discount= (this.subtotal * this.quoteform.discountpercentage / 100);
      this.wholetotal = ((temp_subtotal - Number(this.discount)) + Number(this.taxtot)).toFixed(this.currencydecimal);
     
   },
   }
   };
   
</script>
<style>
   .amounsec li {
   line-height: 33px;
   }
   .dropdown-content {
   float: left;
   }
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
   }
   .is-boxed ul li a span {
   font-size: 12px;
   text-transform: uppercase;
   }
   .filetable td {
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
   }
   .icons1 {
   border: 1px solid #000;
   padding: 4px 5px;
   border-radius: 33px;
   color: #aba4a4;
   }
   .taginput .taginput-container.is-focusable {
   box-shadow: unset !important;
   }
   ul.list-unstyled.chat-sections1 {
   box-shadow: 0px 0px 10px #ddd;
   padding: 10px 20px;
   padding-bottom: 41px;
   margin: 40px auto;
   height: 250px;
   overflow: auto;
   transform: translate(0, 0);
   }
   .datetime {
   margin-top: 20px;
   }
   .fa-caret-left:before {
   position: absolute;
   left: -8px;
   top: -4px;
   font-size: 41px;
   color: #ddd;
   }
   .delete-row {
   text-align: center;
   margin: 0 auto;
   display: block !important;
   margin-top: 50% !important;
   }
   .delete-row {
   background-color: #363636;
   }
   .sectionadd {
   padding: 1rem 1.5rem !important;
   }
   .drop-special .card-content {
   padding-top: 5px !important;
   }
</style>