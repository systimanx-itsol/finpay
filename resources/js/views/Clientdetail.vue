<template>
    <section class="hero is-fullheight is-default is-bold">
        <layout-header></layout-header>

        <div class="container breadcrums1">
            <h6 class="form-name is-uppercase is-pulled-left is-size-6">
                Client Details
            </h6>


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

        <section
            class="container forms-sec has-background-white box detsection2"
        >
            <b-tabs v-model="activeTab">
                <b-tab-item label="Details" class="det-list">
                    <h3>Details</h3>
                    <div class="columns">
                        <div class="column">
                            <ul>
                                <li>Client Name <span>: {{client.client_name}}</span></li>
                                <li>Email <span>: {{client.email}}</span></li>
                                <li>City <span>: {{client.city}}</span></li>
                                <li>State <span>: {{client.state}}</span></li>
                                <li>Postal Code <span>: {{client.postal_code}}</span></li>
                                <li>Country <span>: {{client.country}}</span></li>
                                <li>Phone Number <span> : {{client.phone_number}}</span></li>
                            </ul>
                        </div>
                        <div class="column">
                            <ul>
                                <li>Fax Number <span>: {{client.fax_number}}</span></li>
                                <li>Mobile Number <span>: {{client.mobile_number}}</span></li>
                                <li>
                                    Website Address
                                    <span>: {{client.web_site}}</span>
                                </li>
                                <!-- <li>Default Currency <span>: {{client.default_currency}}</span></li> -->
                                <li>Tax Number <span> : {{client.tax_code}}</span></li>
                                <li>
                                    Address
                                    <span>: {{client.address}}</span>
                                </li>
                                <!-- <li>Status <span>: {{client.status}}</span></li> -->
                            </ul>
                        </div>
                    </div>
                </b-tab-item>

                <b-tab-item label="Quotes">
                    <section class=" is-clearfix">
                        <div class="field has-addons is-pulled-right ">
                            <div
                                class="control has-icons-left is-hidden-mobile"
                            >
                                <input
                                    type="text"
                                    class="input is-info is-small"
                                    v-model="search"
                                    placeholder="Filter..."
                                />
                                <span class="icon is-medium is-left">
                                    <i class="fa fa-futbol-o"></i>
                                </span>
                            </div>
                            <div class="control is-hidden-mobile">
                                <a
                                    class="button is-info is-samll has-background-grey-darker"
                                    >Search</a
                                >
                            </div>
                            <!-- <a
                                @click="isImageModalActive = true"
                                class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
                                >Add</a
                            > -->
                        </div>
                        <b-field grouped group-multiline>
                            <b-select
                                v-model="perPage"
                                :disabled="!isPaginated"
                            >
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="15">15 per page</option>
                                <option value="20">20 per page</option>
                            </b-select>
                            <div class="control is-flex">
                                <b-switch
                                    v-model="isPaginated"
                                    class="is-size-7 is-uppercase"
                                    >Paginated</b-switch
                                >
                            </div>
                        </b-field>
                        <b-table
                            class="table is-bordered is-striped is-fullwidth search-table inner"
                            :data="filteredCustomers"
                            :paginated="isPaginated"
                            :per-page="perPage"
                            :current-page.sync="currentPage"
                            :pagination-simple="isPaginationSimple"
                            :default-sort-direction="defaultSortDirection"
                            default-sort=""
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
                                    >{{ props.index + 1 }}</b-table-column
                                >
                                <b-table-column
                                    field="quote_no"
                                    class="is-size-7-mobile"
                                    label=" Quote No"
                                    sortable
                                    >{{ props.row.quote_no }}</b-table-column
                                >
                                <b-table-column
                                    field="date"
                                    class="is-size-7-mobile"
                                    label="Date"
                                    sortable
                                    >{{ formatter (props.row.date) }}</b-table-column
                                >
                                <b-table-column
                                    field="expires_on"
                                    class="is-size-7-mobile"
                                    label="ExpiresOn"
                                    sortable
                                    >{{ formatter (props.row.expires_on) }}</b-table-column
                                >
                                <b-table-column
                                    field="client_name"
                                    class="is-size-7-mobile"
                                    label="Client Name"
                                    sortable
                                    >{{ props.row.client_name }}</b-table-column
                                >
                                <b-table-column
                                    field="totalamount"
                                    class="is-size-7-mobile"
                                    label="Total Amount"
                                    sortable
                                    > {{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}{{ (props.row.totalamount).toFixed(props.row.currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencies_thousands) }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column
                                >
                             
                                <b-table-column
                                    field="quotesstatus"
                                    class="is-size-7-mobile"
                                    label="status"
                                    sortable
                                    >{{ props.row.quotesstatus }}</b-table-column
                                >
                                <b-table-column
                                    field="Options"
                                    class="is-size-7-mobile"
                                    label="Options"
                                    sortable
                                > 
                                    <!-- <a href=""><i class="fas fa-pencil-alt spaces has-text-grey-dark	"></i>  </a>
                     <a href=""><i class="fa fa-trash spaces has-text-grey-dark	" aria-hidden="true"></i> </a>
                         -->
                                 <b-dropdown hoverable>
                                        <button
                                            class="button is-small has-background-grey-darker has-text-white"
                                            slot="trigger"
                                        >
                                            <span>Options</span>
                                            <i
                                                class="fas fa-caret-down drops"
                                            ></i>
                                        </button>
                                         <b-dropdown-item >
                   <router-link :to="{name: 'quoteform', query: { id : props.row.quotes_id, edit: true }}" class="has-text-dark">
                        <i class="fas fa-edit icon1" ></i> Edit 
                        </router-link>
                     </b-dropdown-item>

                      <b-dropdown-item @click="goToDelete(props.row.quotes_id)">
                        <i class="fas fa-trash-alt icon1"></i>Delete
                     </b-dropdown-item>
                                      
<!--                                        
                <b-dropdown-item>
                        <i class="fas fa-download icon1" ></i>Download PDF
                     </b-dropdown-item> -->
                     </b-dropdown>
                                </b-table-column> 
                            </template>
                              <template slot="empty">
          <h4>
            <center>{{"No record found"}}</center>
          </h4>
        </template> 
                        </b-table>
                    </section>
                </b-tab-item>

                <b-tab-item :visible="showBooks" label="Invoices">
                    <section class="is-clearfix">
                        <div class="field has-addons is-pulled-right ">
                            <div
                                class="control has-icons-left is-hidden-mobile"
                            >
                                <input
                                    type="text"
                                    class="input is-info is-small"
                                    v-model="search"
                                    placeholder="Filter....."
                                />
                                <span class="icon is-medium is-left">
                                    <i class="fa fa-futbol-o"></i>
                                </span>
                            </div>
                            <div class="control is-hidden-mobile">
                                <a
                                    class="button is-info is-samll has-background-grey-darker"
                                    >Search</a
                                >
                            </div>
                            <!-- <a
                                @click="isImageModalActive = true"
                                class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
                                >Add</a
                            > -->
                        </div>
                        <b-field grouped group-multiline>
                            <b-select
                                v-model="perPage"
                                :disabled="!isPaginated"
                            >
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="15">15 per page</option>
                                <option value="20">20 per page</option>
                            </b-select>
                            <div class="control is-flex">
                                <b-switch
                                    v-model="isPaginated"
                                    class="is-size-7 is-uppercase"
                                    >Paginated</b-switch
                                >
                            </div>
                        </b-field>
                        <b-table
                            class="table is-bordered is-striped is-fullwidth search-table inner"
                            :data="filteredDataArray"
                            :paginated="isPaginated"
                            :per-page="perPage"
                            :current-page.sync="currentPage"
                            :pagination-simple="isPaginationSimple"
                            :default-sort-direction="defaultSortDirection"
                            default-sort=""
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
                                    >{{ props.index + 1 }}</b-table-column
                                >
                                <b-table-column
                                    field="invoice_number"
                                    class="is-size-7-mobile"
                                    label=" Invoice No"
                                    sortable
                                    >{{ props.row.invoice_number }}</b-table-column
                                >
                                <b-table-column
                                    field="date"
                                    class="is-size-7-mobile"
                                    label="Date"
                                    sortable
                                    >{{formatter (props.row.date) }}</b-table-column
                                >   <b-table-column
                                    field="expires_on"
                                    class="is-size-7-mobile"
                                    label="DUE DATE"
                                    sortable
                                    ><span :style="props.row.is_date == 1?'color: red;':''" > {{ formatter (props.row.expires_on) }}</span> </b-table-column
                                >
                            
                                <b-table-column
                                    field="client_name"
                                    class="is-size-7-mobile"
                                    label="Client"
                                    sortable
                                    >{{ props.row.client_name }}</b-table-column
                                >
                                <b-table-column
                                    field="total"
                                    class="is-size-7-mobile"
                                    label="Total Amount"
                                    sortable
                                    >{{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}{{ (props.row.total).toFixed(props.row.currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencies_thousands)}}{{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column
                                >
                                 <b-table-column
                                    field="balance"
                                    class="is-size-7-mobile"
                                    label="BALANCE"
                                    sortable
                                    >{{props.row.currencies_placement==0 ? props.row.currencies_id : ''}}{{ (props.row.balance).toFixed(props.row.currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, props.row.currencies_thousands) }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column
                                >
                                <b-table-column
                                    field="status"
                                    class="is-size-7-mobile"
                                    label="status"
                                    sortable
                                    >{{ props.row.status }}</b-table-column
                                >
                                <b-table-column
                                    field="Options"
                                    class="is-size-7-mobile"
                                    label="Options"
                                    sortable
                                >
                                    <!-- <a href=""><i class="fas fa-pencil-alt spaces has-text-grey-dark	"></i>  </a>
                     <a href=""><i class="fa fa-trash spaces has-text-grey-dark	" aria-hidden="true"></i> </a>
                         -->
                                    <b-dropdown hoverable>
                                        <button
                                            class="button is-small has-background-grey-darker has-text-white"
                                            slot="trigger"
                                        >
                                            <span>Options</span>
                                            <i
                                                class="fas fa-caret-down drops"
                                            ></i>
                                        </button>
                                        <b-dropdown-item>
                                            <router-link  :to="{name: 'invoiceform', query: { id: props.row.invoice_id, currency: props.row.currency_id, edit :true }}"  class="has-text-dark">
                                            <i class="fas fa-edit icon1"></i>
                                            Edit
                                            </router-link>
                                        </b-dropdown-item>
                                        <b-dropdown-item @click="goInvoiceDelete(props.row.invoice_id)">
                                            <i
                                                class="fas fa-trash-alt icon1"
                                            ></i
                                            >Delete
                                        </b-dropdown-item>
                                        <!-- <b-dropdown-item>
                                            <i class="fas fa-download icon1"></i
                                            >Download PDF
                                        </b-dropdown-item> -->

                                        <b-dropdown-item v-if="props.row.status != 'Draft' && props.row.status != 'Cancelled'">
                                          
                                              <a  @click="isImageModalActive2=true;  payment(props.row.invoice_id,props.row.balance,props.row.currency_id)"  class="has-text-dark">
                                                <i class="fas fa-credit-card icon1"></i>Payments
                                            </a>
                                        </b-dropdown-item>
                                    </b-dropdown> 
                             </b-table-column>
                            </template>
                              <template slot="empty">{{"No Record Found"}}</template>
                        </b-table>
                    </section>
                </b-tab-item>

                <b-tab-item :visible="showBooks" label="Payments">
                    <section class="is-clearfix">
      <div class="field has-addons is-pulled-right ">
        <div class="control has-icons-left is-hidden-mobile">
          <input
            type="text"
            class="input is-info is-small"
            v-model="search"
            placeholder="Filter....."
          />
          <span class="icon is-medium is-left">
            <i class="fa fa-futbol-o"></i>
          </span>
        </div>
        <div class="control is-hidden-mobile">
          <a class="button is-info is-samll has-background-grey-darker"
            >Search</a
          >
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
          <b-switch v-model="isPaginated" class="is-size-7 is-uppercase"
            >Paginated</b-switch
          >
        </div>
      </b-field> 

      <b-table
        class="table is-bordered is-striped is-fullwidth search-table inner"
        :data="filteredpaymentArray"
        :paginated="isPaginated"
        :per-page="perPage"
        :current-page.sync="currentPage"
        :pagination-simple="isPaginationSimple"
        :default-sort-direction="defaultSortDirection"
        default-sort="invoice"
      >
        <template slot-scope="props">
          <b-table-column field="id" class="is-size-7-mobile" label="ID" width="40" sortable numeric :row-class="(row,index)">
                  {{ props.index + 1 }}
               </b-table-column>

          <b-table-column
            field="payment_date"
            class="is-size-7-mobile"
            label="Payment Date"
            sortable
            >{{ formatter (props.row.payment_date) }}</b-table-column
          >

          <b-table-column
            field="invoice_number"
            class="is-size-7-mobile"
            label=" Invoice Number"
            sortable
            >{{ props.row.invoice_number }}</b-table-column
          >

          <b-table-column
            field="date"
            class="is-size-7-mobile"
            label="	 Date"
            sortable
            >{{ formatter (props.row.date) }}</b-table-column
          >

          <b-table-column
            field="client_name"
            class="is-size-7-mobile"
            label="Client"
            sortable
            >{{ props.row.client_name }}</b-table-column
          >
          <b-table-column
            field="payment_amount"
            class="is-size-7-mobile"
            label="AMOUNT PAID"
            sortable
            >{{props.row.currencies_placement==0 ? props.row.currencies_id : ''}} {{ props.row.payment_amount }} {{props.row.currencies_placement==1 ? props.row.currencies_id : ''}}</b-table-column
          >
          <b-table-column
            field="payment_name"
            class="is-size-7-mobile"
            label="Payment Method"
            sortable
            >{{ props.row.paymenttype_id }}</b-table-column
          >
          <b-table-column
            field="note"
            class="is-size-7-mobile"
            label="Notes"
            sortable
            >{{ props.row.note }}</b-table-column
          >

         

          <b-table-column
            field="Options"
            class="is-size-7-mobile"
            label="Options"
            sortable
          >
            <!-- <a href=""><i class="fas fa-pencil-alt spaces has-text-grey-dark	"></i>  </a>
        <a href=""><i class="fa fa-trash spaces has-text-grey-dark	" aria-hidden="true"></i> </a>
            -->
            <b-dropdown hoverable>
              <button
                class="button is-small has-background-grey-darker has-text-white"
                slot="trigger"
              >
                <span>Options</span>
                <i class="fas fa-caret-down drops"></i>
              </button>

              <b-dropdown-item @click="isImageModalActive3=true; getpayment(props.row.payment_id)">
                <i class="fas fa-edit icon1"  ></i> Edit
              </b-dropdown-item>

              <b-dropdown-item @click="goPaymentDelete(props.row.payment_id)">
                <i class="fas fa-trash-alt icon1"></i>Delete
              </b-dropdown-item>
            </b-dropdown>
          </b-table-column>
        </template>
          <template slot="empty">
          <h4>
            <center>{{"No record found"}}</center>
          </h4>
        </template>
      </b-table>
    </section> 
                </b-tab-item>
            </b-tabs>
        </section>
         <template>
         <section>
            <form id="app" @submit.prevent="handlesubmit" validate>
               <b-modal :active.sync="isImageModalActive2" :width="340">
                  <div class="card section sect">
                     <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Enter Payment</h4>
                     <p class="bd-notification is-info">
                        <!-- quick -->
                        <label>Amount Balance: {{currencies_placement==0 ? currencies_id : ''}}  {{ (paymentBalance).toFixed(currencies_decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencies_thousands) }} {{currencies_placement==1 ? currencies_id : ''}}
                        </label>
                     <div class="field">
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
                        <span v-show="errors.has('paymentdate')" class="invalid-feedback">Field is required</span>
                     </div>
                     </p>
                     <p class="bd-notification is-info">
                        <label>Payment Method <span class="has-text-danger">*</span> </label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="paymentmethod" id="paymentmethod" v-model="invoice.paymentmethod"  v-validate="'required'"
                                 :class="{ 'is-invalid': submitted && errors.has('paymentmethod') }">
                                 <option v-for="paymentmethod in name"  v-bind:value="paymentmethod.id" :key="paymentmethod.id">
                                    {{paymentmethod.name}} 
                                 </option>
                              </select>
                              <span
                                 v-show="errors.has('paymentmethod')"
                                 class="invalid-feedback"
                                 >Paymentmethod is required</span>
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
                     <span v-if="balanceError != null"> {{ balanceError }} </span>
                     <button class="button is-dark is-small is-pulled-right"
                        >Submit</button>
                     <button2 class="button has-background-light is-small is-pulled-right clearbuton" @click="isImageModalActive2 = false" >Cancel</button2>
                  </div>
               </b-modal>
            </form>
         </section>
      </template>

       <template>
   
         <section>
		 <form id="app" @submit.prevent="paymentSubmit">
            <b-modal :active.sync="isImageModalActive3" :width="340">
               <div class="card section sect">
                  <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Enter Payment</h4>
                
                     <p class="bd-notification is-info">
                        <label>Amount
                        </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
							
                           <input class="input" type="text" placeholder="Amount" id="amount" v-model="invoice.amount" name="amount" v-validate="'required'"
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
                              <select name="paymentmethod" id="paymentmethod" v-model="invoice.paymentmethod"  v-validate="'required'"
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
                              " class="textarea is-small is-shadowless" id="paymentnotes" v-model="invoice.paymentnotes" name="paymentnotes" 
                    :class="{ 'is-invalid': submitted && errors.has('paymentnotes') }"></textarea>                             
                        </p>
                     </div>
                     </p>
             
                      <button class="button is-dark is-small is-pulled-right" >Submit</button>
                     
                     <button1 class="button has-background-light is-small is-pulled-right clearbuton"  @click="isImageModalActive3 = false" >cancel</button1>
               
               </div>
            </b-modal>
		 </form>
         </section>

      </template>

        <layout-footer> </layout-footer>
       
    </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import moment from 'moment'
export default {
    components: {
        LayoutHeader,
        LayoutFooter,
        moment
    },
    data() {
        return {
            system:"",
            systemDate:"",
            isImageModalActive: false,
            isImageModalActive2: false,
            isImageModalActive3: false,

            paymentSymbol: '',
            balanceError: null,
            paymentBalance: 0,

            isCardModalActive: false,
             
           systemquantities: [],
           systemtaxrounding:[],
            bind_file_name: [],
            copy: '',
            subtotal: 0,
            discount: 0,
            taxtot: 0,
            wholetotal:0,
            index: 0,
           
          
            currency: [],
            note: [],
            bindfile: [],
            search: "",
            data: [],

          paymentdetails:{
          client_name: "",
          payment_date:"",
          invoice_number:"",
          date:"",
          payment_amount:"",
          paymenttype_id:"",
        },
       
      client:
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
          status: '',

        },
          
             quotesdetails: 
            {
               quote_no: "",
               date: "",
               expires_on: "",
               client_name: "",
               total_amount: "",
               quotesstatus: "",
            },
            invoicedetails: {
                invoice_number: "",
                total_amount: "",
                paid: "",
                date: "",
                expires_on: "",
                currency_id: "",
                invoicestatus: "",
            },
          quoteform:
            {
               file_name: [],
               quote_no: "",
               date: "",
               expires_on: "",
               currencies_id: "",
               discountpercentage: 0,
               download_path: "",
               terms: "",
               footer: "",
               quotes_status_id: "",
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
             invoice: {
                client_id: "",
                date: new Date(),
                company:"",
                amount: "",
                invoice_template: "SystimaNX balde.pdf",
                paymentdate: new Date(),
                paymentmethod: "",
                paymentnotes: "", 
            },

            
           
            details: [],
            statuses: [],
            selectedproduct: [],
            invoicedetail:[],
            quotesdetail:[],
            paymentdetail:[],
            isPaginated: true,
            name:[],
            isPaginationSimple: false,
            defaultSortDirection: "asc",
            currentPage: 1,
            perPage: 5
        };
    },

     mounted: function () {
       this.customFormatter();
      if (this.$route.query.id != '' && this.$route.query.id != null){ 
      this.editgetUser();
      this.fetchquotes();
      
     
      }
       this.paymentMethod();
        this.formatter();
     
       
           
    },
    methods:{
       ...mapActions({
      setLoading: "setLoading"
    }),
      customFormatter() {
         this.setLoading(true);
            let url = '/systemdate';
            axios.get(url).then(response => {
                this.system = response.data.systemDate;
                this.systemValue = response.data.systemValue;
                console.log(this.systemValue,'ddd')

            })
            .finally(() => {
                this.setLoading(false);
              });
        },
       getpayment(id) {
      this.setLoading(true);
  this.payment_id= id;
      let uri = '/Payment/' + id;
      console.log(uri);
      axios.get(uri).then((response) => {
	 
        this.invoice = response.data.paymentdetails;
		
		var dateMomentObj = response.data.paymentdetails.paymentdate;
		console.log(dateMomentObj );
          var DateObj = moment(dateMomentObj);
		 
          this.invoice.paymentdate = new Date(DateObj);
		
        
      })
      .finally(() => {
                this.setLoading(false);
              });
    },
        
        formatter(date) {
          console.log("MYDATE",this.systemValue);
            return moment(new Date(date)).format(this.systemValue);
        },
        paymentMethod() {
            this.setLoading(true);
            let uri = '/PaymentMethod';
            console.log(uri);
            axios.get(uri).then((response) => {
                this.name = response.data.payment_methodDetails;

            })
              .finally(() => {
                this.setLoading(false);
              });
        },
         payment(id, balance, symbol) {
             this.setLoading(true);
            this.invoice_id = id;
            this.paymentBalance = Number(balance);
            this.paymentSymbol = symbol;
            // console.log(this.invoice_id);
            let uri = '/invoice';
            axios.get(uri)
                .then((response) => {
                      this.invoice.amount = Number(this.paymentBalance);
                  
                })
                .finally(() => {
                this.setLoading(false);
              });
                    
            // console.log(this.invoice.amount, 'invoice');

        },

             paymentSubmit( ) {
     this.setLoading(true);
   this.submitted = true;
        if (this.payment_id != '' && this.payment_id != null) {
      this.$validator.validate().then(valid => {
        if (valid) {
          let url = '/Payment/' +this.payment_id;
          let config = {
            headers: {
              'content-type': 'application/json'
            }
          }



          let formdata = new FormData();
          formdata.append('amount', this.invoice.amount);
          if (this.invoice.paymentdate != '') {
              var dateObj = new Date(this.invoice.paymentdate);
              var momentObj = moment(dateObj);
              var momentString = momentObj.format('YYYY-MM-DD');
              this.invoice.paymentdate = momentString;
              formdata.append('date', this.invoice.paymentdate);
            }
          formdata.append('paymentmethod', this.invoice.paymentmethod);
          formdata.append('paymentnotes', this.invoice.paymentnotes);
         
          axios.put(url, this.invoice, config).then(response => {
            //console.log(response);
            //alert(11111);
           if (response.data.status == 1) {
            
          this.$buefy.toast.open({
            duration: 4000,
            message: response.data.message,
            type: "is-danger",
            position: "is-top-right"
          });
      //    this.getdata();
	  
        } else {
          this.invoice = [];
           this.fetchquotes();
          this.$buefy.toast.open({
            duration: 4000,
            message: response.data.message,
            position: "is-top-right",
            type: "is-success"
          });
        }
      })
       .finally(() => {
                this.setLoading(false);
              });
        }
      });
      }
             
           this.isImageModalActive3 = false;


    },

      



         handlesubmit() {
            this.setLoading(true);
            this.submitted = true;
            this.balanceError = null;
            if (Number(this.paymentBalance) < Number(this.invoice.amount)) {
                this.balanceError = "Amount is larger then Balance"
                return

            }
            if (this.balanceError == null) {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        let url = '/paymentinvoice/' + this.invoice_id;
                        let config = {

                            headers: {

                                Authorization: 'Bearer ' + sessionStorage.getItem('token'),
                                'content-type': 'multipart/form-data'
                            }
                        }



                        let formdata = new FormData();

                        formdata.append('amount', this.invoice.amount);
                        if (this.invoice.paymentdate != '') {
                            var dateObj = new Date(this.invoice.paymentdate);
                            var momentObj = moment(dateObj);
                            var momentString = momentObj.format('YYYY-MM-DD');
                            this.invoice.paymentdate = momentString;
                            formdata.append('paymentdate', this.invoice.paymentdate);
                        }
                        formdata.append('paymentmethod', this.invoice.paymentmethod);
                        formdata.append('paymentnotes', this.invoice.paymentnotes);




                        axios.post(url, formdata, config).then(response => {

                            console.log(this.invoice_id);


                            if (response.data.status == 1) {

                                this.isImageModalActive2 = false;
                                // this.fetchdata();
                                 window.location.href = "";
                                this.invoice = [];
                                this.invoice.date = new Date();
                                this.invoice.company = [];
                                this.invoice.invoice_template = "SystimaNX balde.pdf";
                                this.invoice.paymentdate = new Date();


                                this.$buefy.toast.open({
                                    duration: 4000,
                                    message: response.data.message,
                                    type: "is-success",
                                    position: "is-top-right"
                                });




                            } else {
                                this.$buefy.toast.open({
                                    message: response.data.message,
                                    position: "is-top-right",
                                    type: "is-danger"
                                });


                            }
                        })
                        .finally(() => {
                this.setLoading(false);
              });
                    }
                });
               
            this.isImageModalActive1=false
            }
        },
                 editgetUser() {
                       this.setLoading(true);
        // this.editMode = true,
        let url = '/Client/' + this.$route.query.id;
        axios.get(url).then((response) => {
          this.clientdetails = response.data.clientDetails;
          this.client.client_name = response.data.clientDetails.client_name;
               this.client.email = response.data.clientDetails.email;
               this.client.address = response.data.clientDetails.address;
               this.client.phone_number = response.data.clientDetails.phone_number;
               this.client.state = response.data.clientDetails.state;
               this.client.city = response.data.clientDetails.city;
               this.client.postal_code = response.data.clientDetails.postal_code;
               this.client.country = response.data.clientDetails.country;
               this.client.default_currency = response.data.clientDetails.default_currency;
               this.client.status = response.data.clientDetails.status;
               this.client.fax_number = response.data.clientDetails.fax_number;
               this.client.tax_code = response.data.clientDetails.tax_code;
               this.client.web_site = response.data.clientDetails.web_site;
               this.client.mobile_number = response.data.clientDetails.mobile_number;
        })
         .finally(() => {
                this.setLoading(false);
              });
      },
      fetchquotes(){
         this.setLoading(true);
            let url = '/quotesclient/'+ this.$route.query.id;
            axios.get(url).then(response => {
              //  console.log(response);
            this.quotesdetail = response.data.quotesdetails;

              //   var dateMomentObj = response.data.quotesdetails.date;
              //  var DateObj = moment(dateMomentObj);
              // this.quoteform.date = new Date(DateObj);

            console.log("quotesdetails",response.data.quotesdetail);
           this.invoicedetail = response.data.invoicedetails; 
           this.paymentdetail = response.data.payments; 
          })
           .finally(() => {
                this.setLoading(false);
              });
      },
  

          goToDelete(id) {
             
          this.$buefy.dialog.confirm({
            message: 'Are you sure you want to delete this record?',
            onConfirm: () => this.destroy(id)
          })
        },
    
    destroy(id){
      this.setLoading(true);
      let url = '/Quotes/' ;
      // console.log("URL",url);
      
        axios
        .delete(url+id)
        .then(resp =>{
          if (resp.data.status == 1) {
                      this.$buefy.toast.open({
                      duration: 4000,
                      message: resp.data.message,
                      title: "deleted successfully",
                      type: 'is-success',
                      position: "is-top-right",
                    });
                 
                  }
                  else {
                      this.$buefy.toast.open({
                      duration: 1000,
                      message: resp.data.message,
                      title: "deleted failed",
                      position: "is-top-right",
                      type: 'is-danger'
                    });
                    // alert('failed');
                  }
         this.formatter();
        })
        .catch(error => {
            console.log(error);
          })
           .finally(() => {
                this.setLoading(false);
              });
      
    },
      goInvoiceDelete(id) {
              alert(1);
          this.$buefy.dialog.confirm({
            message: 'Are you sure you want to delete this record?',
            onConfirm: () => this.invoicedestroy(id)
          })
        },
    
    invoicedestroy(id){
       this.setLoading(true);
      let url = '/invoice/' ;
      // console.log("URL",url);
      
        axios
        .delete(url+id)
        .then(resp =>{
          if (resp.data.status == 1) {
                      this.$buefy.toast.open({
                      duration: 4000,
                      message: resp.data.message,
                      title: "deleted successfully",
                      type: 'is-success',
                      position: "is-top-right",
                    });
                  
                  }
                  else {
                      this.$buefy.toast.open({
                      duration: 1000,
                      message: resp.data.message,
                      title: "deleted failed",
                      position: "is-top-right",
                      type: 'is-danger'
                    });
                    // alert('failed');
                  }
        this.formatter();
        })
        .catch(error => {
            console.log(error);
          })
           .finally(() => {
                this.setLoading(false);
              });
      
    },
  
       goPaymentDelete(id){ 
	  
     this.$buefy.dialog.confirm({
        message: 'Are you sure you want to delete this record?',
        onConfirm: () => this.paymentdestroy(id)
      })  
    },

 
 paymentdestroy(id) {  
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
        window.location.href = "";
        } else {
          this.$buefy.toast.open({
            duration: 4000,
            message: resp.data.message,
            position: "is-top-right",
            type: "is-success"
          });
        }
          this.formatter();
			  
            })

            .catch(error => {
              console.log(error);
            })
             .finally(() => {
                this.setLoading(false);
              });
        }
      },

   computed: {
      ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
        filteredCustomers: function() {
            var self = this;
            return this.quotesdetail.filter(function(cust) {
                return (
              cust.quote_no.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
              cust.date.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
              cust.expires_on.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
              cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0||
              cust.total_amount.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
              cust.quotesstatus.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 
                );
            });
        },
         filteredDataArray: function() {
      var self = this;
     
         return this.invoicedetail.filter(function(cust) {
         return (
            cust.invoice_number.toLocaleString().indexOf(self.search.toLowerCase()) >=
               0 || 
            cust.date.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
            cust.expires_on.toLocaleString().indexOf(self.search.toLowerCase()) >=
               0 ||
                cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >=
               0 ||
                cust.total_amount.indexOf >=
               0 ||
                cust.balance.indexOf >= 0||
                cust.status.toLocaleString().indexOf(self.search.toLowerCase()) >=
               0
         );
         });
      
     
   },
   filteredpaymentArray: function(){
       var self = this;
      return this.paymentdetail.filter(function(cust){
        return( 
        cust.client_name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
         cust.payment_date.indexOf >= 0 ||
           cust.invoice_number.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
             cust.date.toLocaleString().indexOf(self.search.toLowerCase()) >= 0 ||
               cust.payment_amount.indexOf >= 0 ||
                 cust.paymenttype_id.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
                   cust.note.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 
        );
        });
   }
    }
};
</script>
