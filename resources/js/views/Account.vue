<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">List User Account</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-active is-size-7">
            <a href="#" aria-current="page">Users Account</a>
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
          >{{ props.row.id }}</b-table-column>

          <b-table-column
            field="Name"
            class="is-size-7-mobile"
            label="  Name"
            sortable
          >{{ props.row.name }}</b-table-column>

          <b-table-column
            field="email"
            class="is-size-7-mobile"
            label="  Email"
            sortable
          >{{ props.row.email }}</b-table-column>

          <b-table-column
            field="type"
            class="is-size-7-mobile"
            label="  Type"
            sortable
          >{{ props.row.type }}</b-table-column>

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
                <router-link to="/Accountform" class="has-text-dark">
                  <i class="fas fa-edit icon1"></i> Edit
                </router-link>
              </b-dropdown-item>

              <b-dropdown-item>
                <i class="fas fa-trash-alt icon1"></i>Delete
              </b-dropdown-item>
            </b-dropdown>
          </b-table-column>
        </template>
      </b-table>
    </section>

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
      search: "",
      data: [
        {
          id: 1,
          name: "dummy text",

          email: "demo@gmail.com",
          type: "demo",

          status: "Active"
        },
        {
          id: 2,
          name: "dummy text",

          email: "demo@gmail.com",
          type: "demo",
          status: "Active"
        },
        {
          id: 3,
          name: "dummy text",
          email: "demo@gmail.com",
          type: "demo",
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
        return cust.name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0;
      });
    }
  }
};
</script>






