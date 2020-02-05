<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List Product Units</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Products</a>
          </li>

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Product Unit</a>
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
          to="/Productunitsform"
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
            width="40"
            sortable
            numeric
            :row-class="(row,index)"
          >{{ props.index + 1 }}</b-table-column>

          <b-table-column
            field="name"
            class="is-size-7-mobile"
            label="  Name"
            sortable
          >{{ props.row.name }}</b-table-column>

          <b-table-column
            field="Unit"
            class="is-size-7-mobile"
            label="Unit"
            sortable
          >{{ props.row.unit }}</b-table-column>

          <b-table-column
            field="Status"
            class="is-size-7-mobile"
            label="Status"
            sortable
          >{{ props.row.status }}</b-table-column>

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
                  :to="{name: 'productunitsform', query: { id: props.row.id }}"
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
      product: [],

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
      return this.product.filter(function(cust) {
        return (
          cust.name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.unit.toLowerCase().indexOf(self.search.toLowerCase()) >= 0 ||
          cust.status.toLowerCase().indexOf(self.search.toLowerCase()) >= 0
        );
      });
    }
  },
  mounted: function() {
    this.editgetProduct();
  },
  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    editgetProduct() {
      this.setLoading(true);
      let url = "/ProductUnit";
      this.loading = true;
      axios
        .get(url)
        .then(response => {
          this.product = response.data.product_unitDetails;
        })
        .finally(() => {
          this.setLoading(false);
        });
    },
    //   goToEdit(id){
    //   this.$router.push({ name: "GuestUserAdd", params: { id: userId } });
    // },

    goToDelete(id) {
      this.$buefy.dialog.confirm({
        message: "Are you sure you want to delete this record?",
        onConfirm: () => this.destroy(id)
      });
    },

    destroy(id) {
      this.setLoading(true);
      let url = "/ProductUnit/";
      this.loading = true;
      axios
        .delete(url + id)
        .then(resp => {
          if (resp.data.status == 1) {
            this.$buefy.toast.open({
              duration: 4000,
              message: resp.data.message,
              title: "deleted success",
              type: "is-success",
              position: "is-top-right"
            });
            this.editgetProduct();
            // alert('success');
            // this.user = '';
          } else {
            this.$buefy.toast.open({
              duration: 1000,
              message: resp.data.message,
              title: "deleted failed",
              position: "is-top-right",
              type: "is-danger"
            });
            // alert('failed');
          }
          //  alert(resp.data.message);
          // this.fetchuser();
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

