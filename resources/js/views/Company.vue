<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Company</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Company Profile</a>
          </li>
        </ul>
      </nav>
    </div>

    <section class="container forms-sec has-background-white box is-clearfix">
      <div class="field has-addons is-pulled-right">
        <div class="control has-icons-left is-hidden-mobile">
          <input
            type="text"
            class="input is-info is-small"
            v-model="search"
            placeholder="Filter...."
          />
          <span class="icon is-medium is-left">
            <i class="fa fa-futbol-o"></i>
          </span>
        </div>
        <div class="control is-hidden-mobile">
          <a class="button is-info is-samll has-background-grey-darker">Search</a>
        </div>

        <router-link
          to="/Companyform"
          class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
        >Add</router-link>
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
        default-sort
      >
        <template slot-scope="props">
          <b-table-column
            field="id"
            class="is-size-7-mobile"
            label="ID"
            sortable
            numeric
            :row-class="(row,index)"
          >{{ props.index + 1 }}</b-table-column>

          <b-table-column
            field="company_name"
            class="is-size-7-mobile"
            label="Company Name"
            sortable
          >{{ props.row.company_name }}</b-table-column>

          <b-table-column
            field="city"
            class="is-size-7-mobile"
            label="City"
            sortable
          >{{ props.row.city }}</b-table-column>

          <b-table-column
            field="phone_number"
            class="is-size-7-mobile"
            label="Phone Number"
            sortable
          >{{ props.row.phone_number }}</b-table-column>

          <b-table-column field="Options" class="is-size-7-mobile" label="Options" sortable>
            <b-dropdown hoverable>
              <button
                class="button is-small has-background-grey-darker has-text-white"
                slot="trigger"
              >
                <span>Options</span>
                <i class="fas fa-caret-down drops"></i>
              </button>

              <b-dropdown-item>
                <router-link
                  :to="{name: 'companyform', query: { id: props.row.id }}"
                  class="has-text-dark"
                >
                  <i class="fas fa-edit icon1"></i> Edit
                </router-link>
              </b-dropdown-item>

              <b-dropdown-item @click="goToDelete(props.row.id)">
                <i class="fas fa-trash-alt icon1"></i>Delete
              </b-dropdown-item>
            </b-dropdown>
          </b-table-column>
        </template>
        <template slot="empty">{{"No Record Found"}}</template>
      </b-table>
    </section>

    <layout-footer></layout-footer>
  </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
export default {
  components: {
    LayoutHeader,
    LayoutFooter
  },

  data() {
    return {
      search: "",
      data: [],

      isPaginated: true,
      isPaginationSimple: false,
      defaultSortDirection: "asc",
      currentPage: 1,
      perPage: 5
    };
  },

  computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

    filteredCustomers: function() {
      var self = this;
      return this.data.filter(function(cust) {
        return (
          cust.company_name.toLowerCase().indexOf(self.search.toLowerCase()) >=
            0 ||
          cust.city.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.phone_number.toLowerCase().indexOf(self.search.toLowerCase()) >=
            0
        );
      });
    }
  },

  created: function() {
    this.fetchdata();
  },

  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    fetchdata() {
      this.setLoading(true);
      let uri = "/Company";
      axios
        .get(uri)
        .then(response => {
          console.log(response);
          this.data = response.data.CompanyDetails;
        })
        .finally(() => {
          this.setLoading(false);
        });
    },

    goToDelete(id) {
      this.$buefy.dialog.confirm({
        message: "Are you sure you want to delete this record?",
        onConfirm: () => this.destroy(id)
      });
    },

    destroy(id) {
      this.setLoading(true);
      let uri = "/Company/";
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
    }
  }
};
</script>






