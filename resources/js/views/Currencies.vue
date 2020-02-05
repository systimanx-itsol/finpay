<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Currencies</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Currencies</a>
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
            placeholder="Filter....."
          />
          <span class="icon is-medium is-left">
            <i class="fa fa-futbol-o"></i>
          </span>
        </div>
        <div class="control is-hidden-mobile">
          <a class="button is-info is-samll has-background-grey-darker">Search</a>
        </div>
        <router-link
          to="/Currenciesform"
          class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform"
        >Add</router-link>
        <!-- <a class="has-background-grey-darker has-text-white is-uppercase is-size-7 addform">Add</a> -->
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
        default-sort="name"
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
          >{{ props.index + 1 }}</b-table-column>

          <b-table-column
            field="Name"
            class="is-size-7-mobile"
            label="  Name"
            sortable
          >{{ props.row.name }}</b-table-column>

          <b-table-column
            field="code"
            class="is-size-7-mobile"
            label="Code"
            sortable
          >{{ props.row.code }}</b-table-column>

          <b-table-column
            field="	symbol"
            class="is-size-7-mobile"
            label="symbol"
            sortable
          >{{ props.row.symbol }}</b-table-column>

          <b-table-column
            field="	point"
            class="is-size-7-mobile"
            label="	Decimal Point"
            sortable
          >{{ props.row.decimal }}</b-table-column>

          <b-table-column
            field="	sypl"
            class="is-size-7-mobile"
            label="Symbol Placement"
            sortable
          >{{ parseInt(props.row.placement)?'After Amount':'Before Amount' }}</b-table-column>
          <b-table-column
            field="	sep"
            class="is-size-7-mobile"
            label="Thousands Separator"
            sortable
          >{{ props.row.thousands }}</b-table-column>

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
                  :to="{name: 'currenciesform', query: { id: props.row.id }}"
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
        <template slot="empty">
          <h4>
            <center>{{"No record found"}}</center>
          </h4>
        </template>
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
      loading: true,
      search: "",
      currencies: [],
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
      return this.currencies.filter(function(cust) {
        return (
          cust.name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.code.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.symbol.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.placement.toLowerCase().indexOf(self.search.toLowerCase()) >=
            0 ||
          cust.thousands.toLowerCase().indexOf(self.search.toLowerCase()) >=
            0 ||
          cust.decimal.toLocaleString().indexOf(self.search.toLowerCase()) >= 0
        );
      });
    }
  },

  mounted: function() {
    this.editgetcurrencies();
  },
  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    editgetcurrencies() {
      this.setLoading(true);
      let url = "/Currencies";

      //  console.log(url);
      axios
        .get(url)
        .then(response => {
          this.currencies = response.data.currenciesDetails;
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
      let url = "/Currencies/";
      axios
        .delete(url + id)
        .then(response => {
          if (response.data.status == 1) {
            this.$buefy.toast.open({
              duration: 4000,
              message: response.data.message,
              title: "deleted success",
              type: "is-success",
              position: "is-top-right"
            });
            this.editgetcurrencies();
            // alert('success');
            // this.user = '';
          } else {
            this.$buefy.toast.open({
              duration: 1000,
              message: response.data.message,
              title: "deleted failed",
              position: "is-top-right",
              type: "is-danger"
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
  }
};
</script>






