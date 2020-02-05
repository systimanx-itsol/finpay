<template>
  <section class="hero is-fullheight dashboard dashboarding is-default is-bold">
    <layout-header></layout-header>
    <br />
    <section class="container is-clearfix">
      <div class="level is-marginless">
        <div class="level-left">
          <div class="level-item">
            <div class="title texts is-size-7 is-uppercase">
              <i class="fa fa-tachometer"></i> Dashboard
            </div>
          </div>
        </div>
      </div>
      <div class="columns form-sections">
        <div class="column spac-sec">
          <div class="cont">
            <p class="is-pulled-right is-size-7 is-uppercase bold-sec">Invoice Summary</p>
            <a @click="isImageModalActive = true" class="is-size-7 is-uppercase has-text-dark">
              <i class="fas fa-plus"></i> Create invoice
            </a>

            <b-dropdown v-model="dropdowninvoice" @input="change">
              <button
                class="button is-size-7 is-uppercase butn-border"
                type="button"
                slot="trigger"
              >
                <template v-if="isPublic">
                  <i class="fas fa-calendar-alt icon1"></i>
                  <span>{{ dropdowninvoice }}</span>
                </template>

                <b-icon icon="menu-down"></b-icon>
              </button>
              <b-dropdown-item value="Year To Date" @click="yeartodate">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>Year To Date</h3>
                    <small>Year To Date about description</small>
                  </div>
                </div>
              </b-dropdown-item>
              <b-dropdown-item value="This Quarter" @click="Quarter">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>This Quarter</h3>
                    <small>Quarter about description</small>
                  </div>
                </div>
              </b-dropdown-item>

              <b-dropdown-item value="All Time" @click="alltime">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>All Time</h3>
                    <small>Time about description</small>
                  </div>
                </div>
              </b-dropdown-item>

              <b-dropdown-item value=" Date Range" @click="isImageModalActive2 = true">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>Custom Date Range</h3>
                    <small>Time Custom about description</small>
                  </div>
                </div>
              </b-dropdown-item>
            </b-dropdown>

            <button v-if = dateI
             
              type="button"
              class="button is-small time-calc is-hidden-mobile"
            >{{dateI}} - {{newdateI}}</button>
          </div>
          <br />
          <div class="columns section box box-1 is-mobile is-clearfix">
            <div class="column"  @click="filterInvoice('Draft')">
              <router-link to class="has-text-dark">
                <div class="side-text">
                  <div class="box notification is-primary" >
                    <div class="heading has-text-white">Draft Invoices</div>
                    <div
                      class="title is-size-4 is-size-5-mobile has-text-white"
                    >{{currencyplacement==0 ? currencysymbol : ""}} {{ (invoicedraft).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands) }} {{currencyplacement==1 ? currencysymbol :""}}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                    </div> -->
                  </div>

                  <a class="verical"></a>
                </div>
              </router-link>
              <router-link to="/invoice" class="has-text-white">
                <div class="side-text">
                  <div class="box notification is-danger">
                    <div class="heading">Overdue Invoices</div>
                    <div
                      class="title is-size-4 is-size-5-mobile"
                    >{{currencyplacement==0 ? currencysymbol : ""}} {{ (DueDate).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands) }} {{currencyplacement==1 ? currencysymbol :""}}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                   <a class="verical"></a>
                </div>
              </router-link>
            </div>
            <div class="column" @click="filterInvoice('Sent')">
              <router-link to  class="has-text-white">
                <div class="side-text">
                  <div class="box notification is-warning">
                    <div class="heading">Sent Invoices</div>
                    <div
                      class="title is-size-4 is-size-5-mobile"
                    >{{currencyplacement==0 ? currencysymbol : ""}} {{ (sentinvoice).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands) }} {{currencyplacement==1 ? currencysymbol :""}}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading"></div>
                          <div class="title is-5"></div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <a class="verical"></a>
                </div>
              </router-link>
              <router-link to="/payments" class="has-text-dark">
                <div class="side-text">
                  <div class="box notification is-info">
                    <div class="heading has-text-white">Payments Collected</div>
                    <div
                      class="title is-size-4 is-size-5-mobile has-text-white"
                    >{{currencyplacement==0 ? currencysymbol : ""}} {{ (dashboard_details).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands) }} {{currencyplacement==1 ? currencysymbol :""}}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white"></div>
                          <div class="title is-5 has-text-white"></div>
                        </div>
                      </div>
                    </div> -->
                  </div>

                  <a class="verical"></a>
                </div>
              </router-link>
            </div>
          </div>
        </div>
        <div class="column spac-sec">
          <div class="cont">
            <p class="is-pulled-right is-size-7 is-uppercase bold-sec">Quote Summary</p>
            <a @click="isImageModalActive1 = true" class="is-size-7 is-uppercase has-text-dark">
              <i class="fas fa-plus"></i> Create Quote
            </a>
            <b-dropdown v-model="dropdownquote" @input="change">
              <button
                class="button is-size-7 is-uppercase butn-border"
                type="button"
                slot="trigger"
              >
                <template v-if="isPublic">
                  <i class="fas fa-calendar-alt icon1"></i>
                  <span>{{ dropdownquote }}</span>
                </template>

                <b-icon icon="menu-down"></b-icon>
              </button>
              <b-dropdown-item value="Year To Date" @click="yeartodateQ">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>Year To Date</h3>
                    <small>Year To Date about description</small>
                  </div>
                </div>
              </b-dropdown-item>
              <b-dropdown-item value="This Quarter" @click="quarter">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>This Quarter</h3>
                    <small>Quarter about description</small>
                  </div>
                </div>
              </b-dropdown-item>

              <b-dropdown-item value="All Time" @click="alltimeQ">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>All Time</h3>
                    <small>Time about description</small>
                  </div>
                </div>
              </b-dropdown-item>

              <b-dropdown-item value=" Date Range" @click="isImageModalActive3 = true">
                <div class="media">
                  <b-icon class="media-left fas fa-calendar-alt icon1 is-size-6">
                    <i class="fas fa-calendar-alt icon1"></i>
                  </b-icon>
                  <div class="media-content">
                    <h3>Custom Date Range</h3>
                    <small>Time Custom about description</small>
                  </div>
                </div>
              </b-dropdown-item>
            </b-dropdown>
            <button v-if = newdateQ
              type="button"
              class="button is-small time-calc is-hidden-mobile"
            >{{dateQ}} - {{newdateQ}}</button>
          </div>
          <br />
          <div class="columns is-mobile section box box-1 is-clearfix">
            <div class="column is-half" >
              <div @click="filterQuote('Draft')">
              
              <router-link to class="has-text-dark">
                <div class="side-text" >
                  <div class="box notification is-primary">
                    <div class="heading has-text-white">Draft Quotes</div>
                    <div
                      class="title is-size-4 is-size-5-mobile has-text-white"
                    >{{currencyplacement==0 ? currencysymbol:"" }} {{(quotesdraft).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands)}} {{currencyplacement==1 ? currencysymbol: "" }}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Sales $</div>
                          <div class="title is-5 has-text-white">250K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Overall $</div>
                          <div class="title is-5 has-text-white">750K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Sales %</div>
                          <div class="title is-5 has-text-white">25%</div>
                        </div>
                      </div>
                    </div> -->
                  </div>

                  <a class="verical"></a>
                </div>
              </router-link>
              </div>
              <div @click="filterQuote('Rejected')" >
              <router-link to class="has-text-white">
                <div class="side-text" >
                  <div class="box notification is-danger">
                    <div class="heading">Rejected Quotes</div>
                    <div
                      class="title is-size-4 is-size-5-mobile"
                    >{{currencyplacement==0 ? currencysymbol:"" }} {{(quotesrejected).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands)}} {{currencyplacement==1 ? currencysymbol: "" }}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading">Rev Prod $</div>
                          <div class="title is-5">30%</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading">Rev Serv $</div>
                          <div class="title is-5">25%</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading">Exp %</div>
                          <div class="title is-5">45%</div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <a class="verical"></a>
                </div>
              </router-link>
            </div>
              </div>  

            <div class="column" >
              <div @click="filterQuote('Sent')">
              <router-link to class="has-text-white">
                <div class="side-text" >
                  <div class="box notification is-warning">
                    <div class="heading">Sent Quotes</div>
                    <div
                      class="title is-size-4 is-size-5-mobile"
                    >{{currencyplacement==0 ? currencysymbol: "" }} {{(quotessent).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands)}} {{currencyplacement==1 ? currencysymbol: "" }}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading">Sales $</div>
                          <div class="title is-5">250K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading">Overall $</div>
                          <div class="title is-5">750K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading">Sales %</div>
                          <div class="title is-5">25%</div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  

                  <a class="verical"></a>
                </div>
                
              </router-link>
              </div>

              <div @click="filterQuote('Approved')">
              <router-link to class="has-text-dark">
                <div  class="side-text">
                  <div class="box notification is-info">
                    <div class="heading has-text-white">Approved Quotes</div>
                    <div
                      class="title is-size-4 is-size-5-mobile has-text-white"
                    >{{currencyplacement==0 ? currencysymbol: "" }} {{(quotesapproved).toFixed(currencydecimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, currencythousands)}} {{currencyplacement==1 ? currencysymbol: "" }}</div>
                    <!-- <div class="level">
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Orders $</div>
                          <div class="title is-5 has-text-white">425K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Returns $</div>
                          <div class="title is-5 has-text-white">106K</div>
                        </div>
                      </div>
                      <div class="level-item">
                        <div class>
                          <div class="heading has-text-white">Success %</div>
                          <div class="title is-5 has-text-white">+ 28,5%</div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <a class="verical"></a>
                </div>
              </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="columns">
        <!-- Request start -->
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">Revenue By Client</p>
              <a href="#" class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <!-- <i class="fas fa-ellipsis-h"></i> -->
                </span>
              </a>
            </header>
            <div class="card-content">
              <!-- <div class="content">
                                            <div class="columns">
                                                    <div class="pie" data-start="0" data-value="30"></div>
                                                    <div class="pie highlight" data-start="30" data-value="30"></div>
                                                    <div class="pie" data-start="60" data-value="40"></div>
                                                    <div class="pie big" data-start="100" data-value="260"></div>
                                      </div>
              </div>-->
              <pie-chart :data="chartData"></pie-chart>
            </div>
          </div>
        </div>
        <!-- Request end -->
        <!-- customer start -->
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">Revenue By Month</p>
            </header>
            <div class="card-content">
              <div class="content">
                <bar-chart :data="chartData"></bar-chart>
              </div>
            </div>
          </div>
        </div>
        <!-- customer end -->
      </div>
    </section>

    <template>
      <section>
        <b-modal :active.sync="isImageModalActive" :width="340">
          <div class="card section sect ">
            <h4 class="has-text-grey-dark is-uppercase is-size-6 has-text-centered">Create Invoice</h4>

            <form id="app" @submit.prevent="saveInvoice">
              <div class="bd-notification is-info">
                <label>Client</label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <b-autocomplete
                      name="client_id"
                      v-model="client_id"
                      field="title"
                      :loading="isFetching"
                      @typing="getAsyncData"
                      :class="{ 'is-invalid': submitted && errors.has('client_id') }"
                      :data="filteredCustomers"
                      placeholder="client"
                      icon="magnify"
                      @select="option => selected = option"
                      v-validate="'required'"
                      v-on:input="logCreditLimit"
                    >
                      <template slot="empty">No results found</template>
                    </b-autocomplete>
                  </p>
                </div>
              </div>

              <div class="bd-notification is-info">
                <label>
                  Date
                  <span class="has-text-danger">*</span>
                </label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <b-datepicker
                      id="date"
                      name="date"
                      v-validate="'required'"
                      :date-formatter="formatDate"
                      v-model="dashboard.date"
                      :class="{ 'is-invalid': submitted && errors.has('date') }"
                      placeholder="enter date ..."
                      icon="calendar-today"
                    ></b-datepicker>
                  </p>
                </div>
              </div>

                <p class="bd-notification is-info">
                        <label>Company Name</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="company" id="company" v-model="dashboard.company"  v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('company') }">
                                 <option v-for="companies in company"  v-bind:value="companies.id">
                          {{companies.company_name}}
                             </option>
                              </select>
                           </div>
                        </div>
                     </div>
                     </p>

              <div class="bd-notification is-info">
                <label>Group</label>
                <div class="field has-addons">
                  <div class="control is-expanded">
                    <div class="select is-fullwidth">
                      <select
                        name="invoice_template"
                        id="group"
                        v-model="dashboard.invoice_template"
                        default="SystimaNX balde.pdf"
                        v-validate="'required'"
                        :class="{ 'is-invalid': submitted && errors.has('invoice_template') }"
                      >
                        <option value="0">SystimaNX balde.pdf</option>
                        <option value="1">Other blade.pdf</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <button class="button is-dark is-small is-pulled-right">Submit</button>
              <button4
                class="button has-background-light is-small is-pulled-right clearbuton"
                @click="isImageModalActive = false"
              >Cancel</button4>
            </form>
          </div>
        </b-modal>
      </section>
    </template>

    <template>
      <section>
        <form id="app" @submit.prevent="savequote">
          <b-modal :active.sync="isImageModalActive1 " :width="340">
            <div class="card section sect">
              <!-- <router-link
                  :to="{name: '/quote'}"
                  class="has-text-dark"
              >-->
              <h4 class="has-text-grey-dark is-uppercase is-size-6 has-text-centered">Create Quote</h4>
              <!-- </router-link> -->
            
                <div class="bd-notification is-info">
                  <label>Client</label>
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <!-- <input class="input" type="text" placeholder="Client" /> -->
                      <b-autocomplete
                        name="client_id"
                        v-model="client_id"
                        field="title"
                        :loading="isFetching"
                        @typing="getAsyncData"
                        :class="{ 'is-invalid': submitted && errors.has('client_id') }"
                        :data="filteredCustomers"
                        placeholder="client"
                        icon="magnify"
                        @select="option => selected = option"
                      >
                        <template slot="empty">No results found</template>
                      </b-autocomplete>
                    </p>
                  </div>
                </div>

                <div class="bd-notification is-info">
                  <label>
                    Date
                    <span class="has-text-danger">*</span>
                  </label>
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <!-- <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker> -->
                      <b-datepicker
                        id="date"
                        name="date"
                        v-model="dashboardQuotes.date"
                        v-validate="'required'"
                        :date-formatter="formatDate"
                        placeholder="enter date.."
                        icon="calendar-today"
                      ></b-datepicker>
                    </p>
                  </div>
                </div>

                 <p class="bd-notification is-info">
                        <label>Company Name</label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="company" id="company" v-model="dashboardQuotes.company"  v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('company') }">
                                 <option v-for="companies in company"  v-bind:value="companies.id" :key="companies.id">
                          {{companies.company_name}}
                             </option>
                              </select>
                           </div>
                        </div>
                     </div>
                     </p>

                <div class="bd-notification is-info">
                  <label>Group</label>
                  <div class="field has-addons">
                    <div class="control is-expanded">
                      <div class="select is-fullwidth">
                        <!-- <select name="country">
                        <option value></option>
                        <option value></option>
                        </select>-->
                        <select
                          name="quote_template"
                          v-model="dashboardQuotes.quote_template"
                          default
                          :class="{ 'is-invalid': submitted && errors.has('quote_template') }"
                        >
                          <option value="0">SystimaNX balde.pdf</option>
                        <option value="1">Other blade.pdf</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <br />
             
                  <button class="button is-dark is-small is-pulled-right">Submit</button>
               

                <button
                  @click="isImageModalActive1 = false"
                  class="button has-background-light is-small is-pulled-right clearbuton"
                >Cancel</button>
              
            </div>
          </b-modal>
        </form>
      </section>
    </template>

    <template>
      <section>
        <b-modal :active.sync="isImageModalActive2 " :width="340">
          <div class="card section sect">
            <h4
              class="has-text-grey-dark is-uppercase is-size-6 has-text-centered"
            >Custom Date Range</h4>
            <form>
              <div class="bd-notification is-info">
                <label>
                  From Date
                  <span class="has-text-danger">*</span>
                </label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <b-datepicker
                      placeholder="06/12/2019"
                      icon="calendar-today"
                      id="from_date"
                      v-model="dashboard.from_date"
                      name="from_date"
                    ></b-datepicker>
                  </p>
                </div>
              </div>
              <div class="bd-notification is-info">
                <label>
                  To Date
                  <span class="has-text-danger">*</span>
                </label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <b-datepicker
                      placeholder="06/12/2019"
                      icon="calendar-today"
                      id="to_date"
                      v-model="dashboard.to_date"
                      name="to_date"
                    ></b-datepicker>
                  </p>
                </div>
              </div>

              <button1 class="button is-dark is-small is-pulled-right" @click="customdate">Save</button1>
              <button3
                class="button has-background-light is-small is-pulled-right clearbuton"
                @click="isImageModalActive2 = false" 
              >Cancel</button3>
            </form>
          </div>
        </b-modal>
      </section>
    </template>
    <template>
      <section>
        <b-modal :active.sync="isImageModalActive3 " :width="340">
          <div class="card section sect">
            <h4
              class="has-text-grey-dark is-uppercase is-size-6 has-text-centered"
            >Custom Date Range</h4>
            <form>
              <div class="bd-notification is-info">
                <label>
                  From Date
                  <span class="has-text-danger">*</span>
                </label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <!-- <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker> -->
                    <b-datepicker
                      id="from_date"
                      name="from_date"
                      v-model="dashboardQuotes.from_date"
                      placeholder="enter date.."
                      icon="calendar-today"
                    ></b-datepicker>
                  </p>
                </div>
              </div>
              <div class="bd-notification is-info">
                <label>
                  To Date
                  <span class="has-text-danger">*</span>
                </label>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <!-- <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker> -->

                    <b-datepicker
                      id="to_date"
                      name="to_date"
                      v-model="dashboardQuotes.to_date"
                      placeholder="enter date.."
                      icon="calendar-today"
                    ></b-datepicker>
                  </p>
                </div>
              </div> 

              <br />
              <router-link to="/">
                <button
                  class="button is-dark is-small is-pulled-right"
                  @click="customdaterange"
                >Save</button>
              </router-link>

              <button class="button has-background-light is-small is-pulled-right clearbuton">Cancel</button>
            </form>
          </div>
        </b-modal>
      </section>
    </template>
    <br />
    <layout-footer></layout-footer>
  </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import PieChart from "../components/PieChart.js";
import BarChart from "../components/BarChat.js";
import LineChart from "../components/LineChat.js";
import moment from "moment";
export default {
  components: {
    LayoutHeader,
    LayoutFooter,
    PieChart,
    BarChart,
    LineChart
  },
  data() {
    return {
      isImageModalActive: false,
      isImageModalActive1: false,
      isImageModalActive2: false,
      isImageModalActive3: false,

      submitted: false,

      isPublic: true,
      dropdowninvoice: "Year To Date",
      dropdownquote: "Year To Date",
      data: [],
      name: [],
      invoicesent: "",
      invoicepaid: "",
      fromdate: "",
      todate: "",
      dateI: "",
      newdateI: "",
      quotessent: 0,
      quotesdraft: 0,
      quotesapproved: 0,
      quotesrejected: 0,
      financial: "",
      dateQ: " ",  
      invoice_status: "",
      newdateQ: " ",
      invoice_id: "",
      client_id: "",
      invoicedraft: 0,
      sentinvoice: 0,
      dashboard_details: 0,
      DueDate: 0,
      currencysymbol: "",
      currencyplacement: "",
      currencydecimal: "",
      currencythousands: "",
      dashboard: {
        client_id: "",
        date: new Date(),
        company:"",
        invoice_template: "0",
        from_date: "",
        to_date: ""
      },

      dashboardQuotes: {
        client_id: "",
        quote_template: "0",
         company:"",
        date: new Date(),
        from_date: "",
        to_date: ""
      },
      chartData: {
        labels: ["Sent", "Paid"],

        isCardModalActive: false,
        BarchartData: null,

        datasets: [
          {
            // label: "Data One",
            label: ["Sent", "Paid"],
            backgroundColor: ["#00D8FF", "#ffdd57"],
            data: [100, 50]
          }
        ]
      }
    };
  },
  computed: {
     ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
    filteredCustomers: function() {
      return this.data.filter(option => {
        console.log(this.data, "sss");
        return (
          option
            .toString()
            .toLowerCase()
            .indexOf(this.client_id.toLowerCase()) >= 0
        );
      });
    }
  },
  mounted() {
    setInterval(this.generateData, 2000);
    // this.$router.go();
    this.getdetailsInvoice();
    this.customFormatterInvoice();
    this.getdetails();
    //this.getdetail();
    this.getdetailgraph();
    this.customFormatter();
    this.fetchdata();
    this.getInvoicestatus();
  },

  methods: {
      ...mapActions({
      setLoading: "setLoading"
    }),

    filterInvoice(status) {
      console.log(status);
      this.$router.push({ path: '/invoice', query: { status: status }})
    },
    filterQuote(status){
      console.log(status,'12345');
       this.$router.push({ path: '/Quote', query: { status: status }})
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
    getdetailgraph() {
        this.setLoading(true);
      let url = "/getstatus";
      axios.get(url).then(response => {
        if (response) {
          this.invoicesentQ = response.data.invoicesentQ;
          this.invoicepaid = response.data.invoicepaid;
          this.chartData.datasets[0].data = [
            response.data.invoicesentQ,
            response.data.invoicepaid
          ];
          // alert(JSON.stringify(this.chartData));
        }
      })
       .finally(() => {
                this.setLoading(false);
              });
    },
    generateData() {
      let newArray = [];
      for (let i = 0; i < 10; i++) {
        let randomValue = Math.floor(Math.random() * 10);
        newArray.push(randomValue);
      }

      this.BarchartData = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "Data One",
            backgroundColor: "#f87979",
            data: newArray
          }
        ]
      };
    },

fetchdata() {
  this.setLoading(true);
            let uri = '/invoice';
            axios.get(uri)
                .then((response) => {
                    console.log("Test", response)
                    this.company = response.data.company;
                    console.log(this.data,"rrr")
                })
                 .finally(() => {
                this.setLoading(false);
              });
        },

    customdaterange() {
      this.dateQ = moment(this.dashboardQuotes.from_date).format(
        "MMMM DD, YYYY"
      );
      this.newdateQ = moment(this.dashboardQuotes.to_date).format(
        "MMMM DD, YYYY"
      );
      this.fromdate = moment(this.dashboardQuotes.from_date).format(
        "YYYY-MM-DD"
      );
      this.todate = moment(this.dashboardQuotes.to_date).format("YYYY-MM-DD");
      this.isImageModalActive3 = false;
      this.apiQ(this.fromdate, this.todate);
    },
    apiQ(from, todate) {
    this.setLoading(true);
      let formdata = new FormData();

      formdata.append("from", from);

      formdata.append("todate", todate);

      let url = "/customdaterange";
      axios.post(url, formdata).then(response => {
        if (response.data.yeartodatedraft != 0) {
          this.quotesdraft = response.data.yeartodatedraft;
          console.log(this.currencysymbol, "symbol");
        } else {
          this.quotesdraft = 0;
        }

        if (response.data.yeartodatesent != 0) {
          this.quotessent = response.data.yeartodatesent;
        } else {
          this.quotessent = 0;
        }

        if (response.data.yeartodateapproved != 0) {
          this.quotesapproved = response.data.yeartodateapproved;
        } else {
          this.quotesapproved = 0;
        }
        if (response.data.yeartodaterejected != 0) {
          this.quotesrejected = response.data.yeartodaterejected;
        } else {
          this.quotesrejected = 0;
        }
      })
      .finally(() => {
                this.setLoading(false);
              });
    },

    formatter(date) {
      this.dateQ = moment(this.system.financial_date).format("MMMM DD, YYYY");
      this.newDateQ = moment(this.system.financial_date).format("MMMM DD, YYYY");
    },
    //  getfinancialdate(){
    //       alert(2);
    //       let url = '/System';
    //        console.log("URL",url);
    //       axios.get(url).then(response => {
    //       this.system = response.data.system_unitDetails;
    //       });

    //       },

    formatDate(date) {
      //  console.log("dataeformat",dt.toLocaleDateString(this.system));
      //  return dt.toLocaleDateString(this.system);
      return moment(new Date(date)).format(this.systemValue);
    },

    customFormatter() {
      //alert(5);
        this.setLoading(true);
      let url = "/System";
      console.log("URL", url);
      axios.get(url).then(response => {
        this.system = response.data.system_unitDetails;
      })
       .finally(() => {
                this.setLoading(false);
              });
    },

    getAsyncData() {
      // alert(0);
      if (Object.keys(this.client_id).length > 1) {
        this.isFetching = true;
        let url = "/autoComplete";

        axios
          .get(url, { query: { client_name: this.client_id } })
          .then(response => {
            console.log(response);

            this.data = response.data.autocomplete;
          })
          .catch(error => {
            this.data = [];
            throw error;
          })
          .finally(() => {
            this.isFetching = false;
          });
      }
    },

    savequote() {
        this.setLoading(true);
      if (this.$route.query.id != "" && this.$route.query.id != null) {
        this.submitted = true;
        this.editMode = true;
        let url = "/Quotes";
        //  console.log(url);
        axios.put(url, this.dashboard).then(response => {
          if (response.data.status == 1) {
            this.$buefy.toast.open({
              duration: 4000,
              message: response.data.message,
              title: "updated success",
              type: "is-success",
              position: "is-bottom-right"
            });
            this.$router.push("/quoteform");
          } else {
            this.$buefy.toast.open({
              duration: 1000,
              message: response.data.message,
              title: "updated failed",
              position: "is-top-right",
              type: "is-danger"
            });
          }
          console.log(response);
        })
         .finally(() => {
                this.setLoading(false);
              });
      } else {
           this.setLoading(true);
        this.submitted = true;
        this.$validator.validate().then(valid => {
          if (valid) {
            let url = "/Quotes";
            // console.log(url);
            let config = {
              headers: {
                Authorization: "Bearer " + sessionStorage.getItem("token"),
                "content-type": "multipart/form-data"
                //  'content-type': 'application/json'
              }
            };
            let formdata = new FormData();
            formdata.append("client_id", this.client_id);
            formdata.append("quote_template", this.dashboardQuotes.quote_template);
             formdata.append("company", this.dashboardQuotes.company);

            if (this.dashboardQuotes.date != "") {
              var dateObj = new Date(this.dashboardQuotes.date);
              var momentObj = moment(dateObj);
              var momentString = momentObj.format("YYYY/MM/DD");
              console.log("moment", momentString);
              this.dashboardQuotes.date = momentString;
              // this.quote.date = new Date(this.quote.date);
              formdata.append("date", this.dashboardQuotes.date);
            }

            //   formdata.append('date',this.quote.date);

            axios.post(url, formdata, config).then(response => {
              this.quotes_id = response.data.id;

              console.log("client", this.client_id);
              if (response.data.status == 1) {
                this.$buefy.toast.open({
                  duration: 4000,
                  message: response.data.message,
                  type: "is-success",
                  position: "is-top-right"
                });
                this.$router.push({
                  name: "quoteform",
                  query: {
                    id: response.data.id,
                    client_id: response.data.client_id,
                    edit: false
                  }
                });
              } else {
                this.$buefy.toast.open({
                  message: response.data.message,
                  position: "is-top-right",
                  type: "is-danger"
                });
                this.$router.push("/quoteform");
              }
            })
            .finally(() => {
                this.setLoading(false);
              });
          }
        });
      }
    },

    // getdetail() {
    //   let url = "/getstatus";
    //   axios.get(url).then(response => {

    //   });
    // },
    //invoice
    saveInvoice() {
      this.setLoading(true);
      this.submitted = true;
      this.$validator.validate().then(valid => {
        if (valid) {
          let url = "/invoice";
          let config = {
            headers: {
              Authorization: "Bearer " + sessionStorage.getItem("token"),
              "content-type": "multipart/form-data",
              "content-type": "application/json"
            }
          };

          let formdata = new FormData();
          formdata.append("client_id", this.client_id);

          formdata.append("invoice_template", this.dashboard.invoice_template);
           formdata.append('company', this.dashboard.company);

          if (this.dashboard.date != "") {
            var dateObj = new Date(this.dashboard.date);
            var momentObj = moment(dateObj);
            var momentString = momentObj.format("YYYY-MM-DD");
            this.dashboard.date = momentString;
            formdata.append("date", this.dashboard.date);
          }

          axios.post(url, formdata, config).then(response => {
            this.invoice_id = response.data.id;

            if (response.data.status == 1) {
              this.$buefy.toast.open({
                duration: 4000,
                message: response.data.message,
                type: "is-success",
                position: "is-top-right"
              });

              this.$router.push({
                name: "invoiceform",
                query: {
                  id: response.data.id,
                  client_id: response.data.client_id,
                  edit: false
                }
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
    },

    quarter() {
      var now = new Date();
      var quarter = Math.floor(now.getMonth() / 3);
      var firstDate = new Date(now.getFullYear(), quarter * 3, 1);
      var endDate = new Date(
        firstDate.getFullYear(),
        firstDate.getMonth() + 3,
        0
      );
      this.fromdate = moment(firstDate).format("YYYY-MM-DD");
      this.todate = moment(endDate).format("YYYY-MM-DD");
      this.apiQ(this.fromdate, this.todate);
    },

    //invoice
    Quarter() {
      this.dateI = " ";
      this.newdateI = " ";

      var now = new Date();
      var quarter = Math.floor(now.getMonth() / 3);
      var firstDate = new Date(now.getFullYear(), quarter * 3, 1);
      var endDate = new Date(
        firstDate.getFullYear(),
        firstDate.getMonth() + 3,
        0
      );
      this.fromdate = moment(firstDate).format("YYYY-MM-DD");
      this.todate = moment(endDate).format("YYYY-MM-DD");
      this.api(this.fromdate, this.todate);
    },

    yeartodateQ() {
      this.dateQ = "";
      this.newdateQ = "";
      this.fromdate = moment(this.DateFrom).format("YYYY-MM-DD");
      this.todate = moment(this.DateTo).format("YYYY-MM-DD");
      this.apiQ(this.fromdate, this.todate);
    },

    //invoice
    yeartodate() {
      this.dateI = "";
      this.newdateI = "";
      this.fromdate = moment(this.DateFrom).format("YYYY-MM-DD");
      this.todate = moment(this.DateTo).format("YYYY-MM-DD");
      this.api(this.fromdate, this.todate);
    },

    alltimeQ() {
      this.dateQ = "";
      this.newdateQ = "";
      this.fromdate = 0;
      this.todate = 0;
      this.apiQ(this.fromdate, this.todate);
    },

    //invoice
    alltime() {
      this.dateI = "";
      this.newdateI = "";
      this.fromdate = 0;
      this.todate = 0;
      this.api(this.fromdate, this.todate);
    },

    //invoice
    customFormatterInvoice() {
       this.setLoading(true);
      let url = "/systemdate";
      axios.get(url).then(response => {
        this.system = response.data.systemDate;
        this.systemValue = response.data.systemValue;
      })
       .finally(() => {
                this.setLoading(false);
              });
    },

    //invoice
    customdate() {
      this.setLoading(true);
      this.dateI = moment(this.dashboard.from_date).format("MMMM DD, YYYY");
      this.newdateI = moment(this.dashboard.to_date).format("MMMM DD, YYYY");
      this.fromdate = moment(this.dashboard.from_date).format("YYYY-MM-DD");
      this.todate = moment(this.dashboard.to_date).format("YYYY-MM-DD");
      this.isImageModalActive2 = false;
      this.api(this.fromdate, this.todate);
    },
    api(from, todate) {
      
      let formdata = new FormData();
      formdata.append("from", from);

      formdata.append("todate", todate);

      let url = "/customdate";
      axios.post(url, formdata).then(response => {
        if (response.data.invoicedraft != 0) {
          this.invoicedraft = response.data.invoicedraft;
        } else {
          this.invoicedraft = 0;
        }

        if (response.data.invoicesent != 0) {
          this.sentinvoice = response.data.invoicesent;
        } else {
          this.sentinvoice = 0;
        }

        if (response.data.invoicepayment != 0) {
          this.dashboard_details = response.data.invoicepayment;
        } else {
          this.dashboard_details = 0;
        }

        if (response.data.duedate != 0) {
          this.DueDate = response.data.duedate;
        } else {
          this.DueDate = 0;
        }
      })
       .finally(() => {
                this.setLoading(false);
              });
    },

    getdetails() {
      let config = {
        headers: {
          Authorization: "Bearer " + sessionStorage.getItem("token"),
          "content-type": "multipart/form-data",
          "content-type": "application/json"
        }
      };
        this.setLoading(true);
      axios
        .get("/getstatus", config)
        .then(response => {
          if (response.data.yeartodatedraft != 0) {
            this.quotesdraft = response.data.yeartodatedraft;
          } else {
            this.quotesdraft = 0;
          }

          if (response.data.yeartodatesent != 0) {
            this.quotessent = response.data.yeartodatesent;
          } else {
            this.quotessent = 0;
          }

          if (response.data.yeartodateapproved != 0) {
            this.quotesapproved = response.data.yeartodateapproved;
          } else {
            this.quotesapproved = 0;
          }
          if (response.data.yeartodaterejected != 0) {
            this.quotesrejected = response.data.yeartodaterejected;
          } else {
            this.quotesrejected = 0;
          }

          this.datepick = response.data.system;
          // this.DateFrom = response.data.financial_date;
          // this.DateTo = new date();
        })
        .catch(error => {})
        .finally(() => {
                this.setLoading(false);
              });
    },

    //invoice
    getdetailsInvoice() {
       this.setLoading(true);
      let config = {
        headers: {
          Authorization: "Bearer " + sessionStorage.getItem("token"),
          "content-type": "multipart/form-data",
          "content-type": "application/json"
        }
      };
      axios
        .get("/getDashboard", config)
        .then(response => {
          if (response.data.invoicedraft != 0) {
            this.invoicedraft = response.data.invoicedraft;
          } else {
            this.invoicedraft = 0;
          }

          if (response.data.invoicesent != 0) {
            this.sentinvoice = response.data.invoicesent;
          } else {
            this.sentinvoice = 0;
          }

          if (response.data.invoicepayment != 0) {
            this.dashboard_details = response.data.invoicepayment;
          } else {
            this.dashboard_details = 0;
          }

          if (response.data.duedate != 0) {
            this.DueDate = response.data.duedate;
          } else {
            this.DueDate = 0;
          }

          this.currencysymbol = response.data.symbol;
          this.currencyplacement = response.data.placement;
          this.currencydecimal = response.data.decimal;
          this.currencythousands = response.data.thousands;
          this.financial = response.data.financial_year;

          this.datepick = response.data.system;
          this.DateFrom = response.data.financial_date;

          this.DateTo = new date();
          //invoice
        })
        .catch(error => {})
         .finally(() => {
                this.setLoading(false);
              });
    },

    change() {
      console.log("change");
    },

    //invoice
    generateData() {
      let newArray = [];
      for (let i = 0; i < 10; i++) {
        let randomValue = Math.floor(Math.random() * 10);
        newArray.push(randomValue);
      }

      this.BarchartData = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "Data One",
            backgroundColor: "#f87979",
            data: newArray
          }
        ]
      };
    }

    //invoice
  }
};
</script>
