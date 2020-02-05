<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>
  
    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List  Recurring Invoices
          </h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
         

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Recurring Invoices</a>
          </li>
        </ul>
      </nav>
    </div>
 
    <section class="container forms-sec has-background-white box is-clearfix">
      <div class="field has-addons is-pulled-right ">
        <div class="control has-icons-left is-hidden-mobile">
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
        <div class="control is-hidden-mobile">
          <a class="button is-info is-samll has-background-grey-darker">Search</a>
        </div>
        <a  @click="isImageModalActive = true"
         
          class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
        >Add</a>
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
        :data="filteredCustomers"
        :paginated="isPaginated"
        :per-page="perPage"
        :current-page.sync="currentPage"
        :pagination-simple="isPaginationSimple"
        :default-sort-direction="defaultSortDirection"
        default-sort="Client"
      >
        <template slot-scope="props">
          <b-table-column
            field="id"
            class="is-size-7-mobile"
            label="ID"
            width="40"
            sortable
            numeric
          >{{ props.row.id }}</b-table-column>

           <b-table-column
            field="Client"
            class="is-size-7-mobile"
            label="Client"
            sortable
          >{{ props.row.Client }}</b-table-column>


          <b-table-column
            field="Date"
            class="is-size-7-mobile"
            label="Date"
            sortable
          >{{ props.row.Date }}</b-table-column>

          <b-table-column
            field="Expires"
            class="is-size-7-mobile"
            label="Expires Date"
            sortable
          >{{ props.row.Expires }}</b-table-column>

         
  <b-table-column
            field="every"
            class="is-size-7-mobile"
            label="Every"
            sortable
          >{{ props.row.every }}</b-table-column>

          <b-table-column
            field="total"
            class="is-size-7-mobile"
            label="Total Amount"
            sortable
          >{{ props.row.total }}</b-table-column>

          <b-table-column
            field="status"
            class="is-size-7-mobile"
            label="status"
            sortable
          >{{ props.row.status }}</b-table-column>
         
         
        
         <b-table-column field="Options" class="is-size-7-mobile" label="Options" sortable>
            <!-- <a href=""><i class="fas fa-pencil-alt spaces has-text-grey-dark	"></i>  </a>
        <a href=""><i class="fa fa-trash spaces has-text-grey-dark	" aria-hidden="true"></i> </a>
            -->
            <b-dropdown hoverable>
              <button class="button is-small has-background-grey-darker has-text-white" slot="trigger">
                <span>Options</span>
                <i class="fas fa-caret-down drops"></i>
              </button>

              <b-dropdown-item>
                <i class="fas fa-edit icon1"></i> Edit
              </b-dropdown-item>
              
            
              <b-dropdown-item>
                <i class="fas fa-trash-alt icon1"></i>Delete
              </b-dropdown-item>


             
            </b-dropdown>
          </b-table-column>
        </template>
      </b-table>
    </section>
<template>
    <section>
      

        <b-modal :active.sync="isImageModalActive " :width="340">
           
                      <div class="card section sect">
 <h4 class="has-text-grey-dark	is-uppercase is-size-6 has-text-centered	">Create Recurring Invoices</h4>
                      
<form >
               <p class="bd-notification is-info">
                        <label>Client


                          </label>
                          <div class="field">

                            <p class="control has-icons-left has-icons-right">
                              <input class="input" type="text" placeholder="Client">
                             
              
                            </p>
                          </div>
                     </p>

                     




  <p class="bd-notification is-info">
                        <label>Group</label>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                              <div class="select is-fullwidth">
                                <select name="country">
                                 
                                  <option value=""></option>
                                    <option value=""></option>

                                </select>
                              </div>
                            </div>
                          </div>
                    
           </p>
<p class="bd-notification is-info">
                 <label>Date <span class="has-text-danger">*</span>
                 </label>
              <div class="field">
                 <p class="control has-icons-left has-icons-right">
                    <b-datepicker
                       placeholder="06/12/2019"
                       icon="calendar-today">
                    </b-datepicker>
                 </p>
              </div>
              </p>

                <p class="bd-notification is-info">
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
           </p>

              <p class="bd-notification is-info">
                 <label>	EXPIRES DATE <span class="has-text-danger">*</span>
                 </label>
              <div class="field">
                 <p class="control has-icons-left has-icons-right">
                    <b-datepicker
                       placeholder="06/12/2019"
                       icon="calendar-today">
                    </b-datepicker>
                 </p>
              </div>
              </p>



 <router-link to="/Recurringinvoiceform">
             
<a class="button is-dark is-small is-pulled-right">Submit</a>
           </router-link>

<button class="button has-background-light is-small is-pulled-right clearbuton">Cancel</button>
</form>
                      </div>           
        </b-modal>

       
    </section>
</template>


    <layout-footer></layout-footer>
  </section>
</template>

<script>
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
export default {
  components: {
    LayoutHeader,
    LayoutFooter
  },

  data() {
    return {
       isImageModalActive: false,
      isCardModalActive: false,
      search: "",
      data: [
        {
          id: 1,
        
          Date: "11-06-1998",
          Client: "dummy",
          total: "56",
          Expires: "31-06-1999",
every:"1 Month",
          status: "Active"
        },
        {
          id: 2,
        
          Date: "11-06-1998",
          Client: "dummy",
          total: "56",
          Expires: "31-06-1999",
every:"1 Month",

          status: "Active"
        },
        {
          id: 3,
         
          Date: "11-06-1998",
          Client: "dummy",
          total: "56",
          Expires: "31-06-1999",
every:"1 Month",

          status: "Active"
        }
      ],

      isPaginated: true,
      isPaginationSimple: false,
      defaultSortDirection: "asc",
      currentPage: 1,
      perPage: 5
    };
  },
  computed: {
    filteredCustomers: function() {
      var self = this;
      return this.data.filter(function(cust) {
        return cust.Client.toLowerCase().indexOf(self.search.toLowerCase()) >= 0;
      });
    }
  }
};
</script>





<style>
.sect {
    padding: 3rem 1.5rem;
    padding-top: 2rem !important;
}
</style>

