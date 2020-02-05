<template>
  <div class="hero-head has-background-white">
    <div v-if="loading" class="loading">
      <my-name name="ball-clip-rotate-multiple" color="#285565" scale="1.5"></my-name>
    </div>
    <div :class="{ 'overlay': isOpen }" @click="isOpen= !isOpen, isOpenmenu = !isOpenmenu"></div>
    <div class="columns is-marginless">
      <div class="container">
        <div class="column is-padding-custom logo_header">
          <div class="is-pulled-left">
            <a class="admin_logo" href="/home">
              <img src="../../assets/logo1.png" width="120px" height="20" style="margin-left: 0;" />
            </a>
          </div>
          <div class="is-pulled-right is-pulled-mobile">
            <div class="navbar-item is-paddingless vertical_center">
              <div class="navbar-menu profile_menu">
                <!-- <div
                  class="field has-addons is-marginless search_block"
                  v-bind:class="{'opensearch':isopensearch}"
                >
                  <div :class="{ 'overlay': isopensearch}" @click="isopensearch= !isopensearch"></div>
                  <div class="control searchblock">
                    <input
                      v-bind:class="{'opensearch':isopensearch}"
                      class="input is-rounded searchbox"
                      type="search"
                      placeholder="Search..."
                    />
                  </div>
                 <div class="control searchicon">
                    <a
                      class="button is-rounded is-light search_icon"
                      @click="isopensearch = !isopensearch"
                    >
                      <span class="icon is-small">
                        <svg
                          class="svg-inline--fa fa-search fa-w-16"
                          aria-hidden="true"
                          data-fa-processed
                          data-prefix="fas"
                          data-icon="search"
                          role="img"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 512 512"
                        >
                          <path
                            fill="currentColor"
                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"
                          />
                        </svg> 
                        <i class="fas fa-search"></i>
                       </span>
                    </a>
                  </div>  
                </div>-->
                <div class="field has-addons is-marginless">
                  <div class="navbar-item has-dropdown logo_header_left">
                    <router-link to="/login" class="navbar-link">
                      <figure class="is-mobile-left is-flex" style="margin-right:.5em;">
                        <img src="https://avatars1.githubusercontent.com/u/7221389?v=4&amp;s=32" />
                        <p class="admin_name">{{username}}</p>
                      </figure>
                    </router-link>
                  </div>
                </div>

                <div class="field has-addons is-marginless is-line-height-custom">
                  <b-dropdown aria-role="list">
                    <a slot="trigger">
                      <!-- <router-link to="/login"> -->
                      <i class="far fa-bell"></i>
                    </a>
                    <b-dropdown-item
                      aria-role="listitem"
                      v-for="(list,index) in Notification"
                      :key="index"
                    >{{list.client_name}}: {{message3}} {{list.invoice_number}} {{message2}} {{ list.expires_on}}</b-dropdown-item>
                  </b-dropdown>

                  <span v-if="danger == 1" class="pulse bg-danger"></span>
                  <!-- </router-link> -->
                </div>
                <!-- <div class="field has-addons is-marginless is-line-height-custom">
                  <router-link to="/login">
                    <i class="fas fa-cog"></i>
                    <span class="pulse bg-danger"></span>
                  </router-link>
                </div>-->

                <!-- <div class="field has-addons is-marginless is-line-height-custom">
                  <router-link to="/login">
                    <i class="fas fa-cog"></i>
                    <span class="pulse bg-danger"></span>
                  </router-link>
                </div>-->

                <!-- <div class="navbar-item has-dropdown is-hoverable sub-menu-parent">
                  <a
                    class="navbar-link"
                    @click="isOpenmenu = !isOpenmenu
                 isOpenmenuremove = !isOpenmenuremove"
                  >
                    <i class="fas fa-cog"></i>
                    <i class="fa fa-chevron-down"></i>
                  </a>
                  <div
                    class="navbar-dropdown sub-menu"
                    v-bind:class="{'is-active-menu': isOpenmenu,
                'is-active-remove': isOpenmenuremove}"
                  >
                    <router-link class="navbar-item" to="/Currencies">Currencies</router-link>
                    <router-link class="navbar-item" to="/Company">Company Profile</router-link>
                    <router-link class="navbar-item" to="/Paymentmethod">Payment Methods</router-link>
                    <router-link class="navbar-item" to="/Tax">Tax Rates</router-link>
                    <router-link class="navbar-item" to="/Account">User Accounts</router-link>
                    <router-link class="navbar-item" to="/System">System Settings</router-link>
                  </div>
                </div>
                <div class="field has-addons is-marginless is-line-height-custom">
                  <a @click="logout()">
                    <i class="fa fa-power-off logout_power"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
                </div>-->

                <div
                  class="field has-addons is-marginless is-line-height-custom has-dropdown is-hoverable sub-menu-parent"
                >
                  <a
                    class="navbar-link"
                    @click="isOpenmenu = !isOpenmenu
                 isOpenmenuremove = !isOpenmenuremove"
                  >
                    <i class="fas fa-cog icones1"></i>
                  </a>
                  <div
                    class="navbar-dropdown sub-menu"
                    v-bind:class="{'is-active-menu': isOpenmenu,
                'is-active-remove': isOpenmenuremove}"
                  >
                    <router-link class="navbar-item" to="/Currencies">Currencies</router-link>
                    <router-link class="navbar-item" to="/Company">Company Profile</router-link>
                    <router-link class="navbar-item" to="/Paymentmethod">Payment Methods</router-link>
                    <router-link class="navbar-item" to="/Tax">Tax Rates</router-link>
                    <router-link class="navbar-item" to="/Account">User Accounts</router-link>
                    <router-link class="navbar-item" to="/System">System Settings</router-link>
                  </div>
                </div>
                <div class="field has-addons is-marginless is-line-height-custom">
                  <a @click="logout()">
                    <i class="fa fa-power-off logout_power"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
      <div class="container">
        <div class="navbar-brand">
          <a
            role="button"
            class="navbar-burger burger"
            aria-label="menu"
            aria-expanded="false"
            data-target="navbarBasicExample"
            @click="isOpen = !isOpen"
            v-bind:class="{'is-active': isOpen}"
          >
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu" v-bind:class="{'is-active': isOpen}">
          <div class="navbar-start">
            <router-link to="/home" class="navbar-item">
              <i class="fas fa-tachometer-alt"></i>Dashboard
            </router-link>
            <router-link to="/Clienttable" class="navbar-item">
              <i class="fas fa-user"></i> Clients
            </router-link>
            <div class="navbar-item has-dropdown is-hoverable sub-menu-parent">
              <a
                class="navbar-link"
                @click="isOpenmenu = !isOpenmenu
                 isOpenmenuremove = !isOpenmenuremove"
              >
                <i class="fa fa-laptop"></i> Products
                <i class="fa fa-chevron-down"></i>
              </a>
              <div
                class="navbar-dropdown sub-menu"
                v-bind:class="{'is-active-menu': isOpenmenu,
                'is-active-remove': isOpenmenuremove}"
              >
                <router-link class="navbar-item" to="/Categorytable">Category</router-link>
                <router-link class="navbar-item" to="/Productunitstable">Product Units</router-link>
                <router-link class="navbar-item" to="/Producttable">Products</router-link>
              </div>
            </div>

            <!-- <router-link class="navbar-item">
               <i class="fa fa-laptop"></i> Category 
            </router-link>-->
            <router-link to="/Quote" class="navbar-item">
              <i class="far fa-file"></i> Quotes
            </router-link>
            <router-link to="/Invoice" class="navbar-item">
              <i class="fas fa-file-alt"></i> Invoices
            </router-link>
            <!-- <router-link to="/Recurringinvoice" class="navbar-item">
              <i class="fas fa-sync-alt"></i> Recurring Invoices
            </router-link>-->
            <router-link to="/Payments" class="navbar-item">
              <i class="fas fa-credit-card"></i> Payments
            </router-link>

            <div class="navbar-item has-dropdown is-hoverable sub-menu-parent">
              <a
                class="navbar-link"
                @click="isOpenmenu = !isOpenmenu
                 isOpenmenuremove = !isOpenmenuremove"
              >
                <i class="fas fa-chart-bar"></i> Reports
                <i class="fa fa-chevron-down"></i>
              </a>
              <div
                class="navbar-dropdown sub-menu"
                v-bind:class="{'is-active-menu': isOpenmenu,
                'is-active-remove': isOpenmenuremove}"
              >
                <router-link class="navbar-item" to="/ClientStatement">Client Statement</router-link>
                <router-link class="navbar-item" to="/RevenueClient">Revenue By Client</router-link>
                <!-- <router-link class="navbar-item" to>Profit and Loss</router-link> -->
                <router-link class="navbar-item" to="/PaymentsCollected">Payments Collected</router-link>
              </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable sub-menu-parent">
              <a
                class="navbar-link"
                @click="isOpenmenu = !isOpenmenu
                isOpenmenuremove = !isOpenmenuremove"
              >
                <i class="fas fa-cog"></i>Settings
                <i class="fa fa-chevron-down"></i>
              </a>
              <div
                class="navbar-dropdown sub-menu"
                v-bind:class="{'is-active-menu': isOpenmenu,
                'is-active-remove': isOpenmenuremove}"
              >
                <router-link class="navbar-item" to="/Currencies">Currencies</router-link>
                <router-link class="navbar-item" to="/Company">Company Profile</router-link>
                <router-link class="navbar-item" to="/Paymentmethod">Payment Methods</router-link>
                <router-link class="navbar-item" to="/Tax">Tax Rates</router-link>
                <!-- <router-link class="navbar-item" to="/Account">User Accounts</router-link> -->
                <router-link class="navbar-item" to="/System">System Settings</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import "vue-loaders/dist/vue-loaders.css";
import { mapState, mapActions, mapGetters } from "vuex";
export default {
  data: function() {
    return {
      isOpen: false,
      overlay: false,
      isopensearch: false,
      isOpenmenu: false,
      isOpenmenuremove: false,
      username: "",
      Notification: [],
      message1: "",
      message2: "",
      message3: "",
      danger: ""
    };
  },
  mounted: function() {
    this.username = sessionStorage.getItem("name");

    this.getNotification();
  },

  computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    })
  },

  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    formatter(date) {
      return moment(new Date(date)).format(this.systemValue);
    },
    bell() {
      this.danger = 0;
    },
    getNotification() {
      this.setLoading(true);
      let url = "/getDashboard";
      axios
        .get(url)
        .then(response => {
          if (response) {
            this.Notification = response.data.notification;
            this.message1 = response.data.notification2[0];
            this.message2 = response.data.notification2[1];
            this.message3 = response.data.notification2[2];

            if (response.data.notification == "") {
              this.danger = 0;
            } else {
              this.danger = 1;
            }
          }
        })
        .finally(() => {
          this.setLoading(false);
        });
    },
    logout() {
      this.$buefy.dialog.confirm({
        message: "Are you sure you want to Logout ?",
        onConfirm: () => this.logoutConfirm()
      });
    },
    logoutConfirm() {
      this.$store.dispatch("logout");
      this.$router.push("/");
    }
  }
};
</script>
<style lang="scss" scoped>
/* nav scroll start */
@media (min-width: 1200px) and (max-width: 2560px) {
  .active.darkcolor {
    color: #807b80 !important;
  }

  .lightcolor {
    color: #fff !important;
  }
  .justify-content-end {
    -ms-flex-pack: end !important;
    justify-content: flex-end !important;
  }
  .justify-content-end {
    transition: transform 0.4s;
    transform: translateX(50%);
    left: -50%;
  }
  // .navbar-start.justify-content-end
  // {
  //   transform: translateX(0);
  //     left: -18px;
  // }
  // .navbar-start
  // {
  //       transition: transform 0.4s;
  //     transform: translateX(50%);
  //     left: -50%;
  // }
  .toggle_scoll {
    position: absolute;
    top: 20px;
    color: #fff;
    left: 12px;
    z-index: 9999;
  }
  .o-hidden {
    width: 100% !important;
    overflow: hidden;
    -ms-flex-positive: 1 !important;
    flex-grow: 1 !important;
  }

  .flex-shrink-0 {
    -ms-flex-negative: 0 !important;
    flex-shrink: 0 !important;
  }
  .nav_scroll {
    /*  overflow: hidden;
    width: 100%; */
    position: relative;
    margin-left: auto;

    margin-right: auto;
    width: 80%;
    overflow: hidden;
    top: 10px;
    left: -48%;
    /*  overflow: hidden;
   width: 82%; */
  }

  .toggle_scoll .fa-angle-left {
    left: 0;
    position: absolute;
  }
  .toggle_scoll .fa-angle-right {
    right: 0;
    position: absolute;
  }

  /* nav scroll end */
  .overlay {
    /* Height & width depends on how you want to reveal the overlay (see JS below) */
    height: 100%;
    width: 100%;
    position: fixed;
    /* Stay in place */
    z-index: 11;
    /* Sit on top */
    left: 0;
    top: 0;
    /* Black fallback color */
    background-color: rgba(0, 0, 0, 0.5);
    /* Black w/opacity */
    overflow-x: hidden;
    /* Disable horizontal scroll */
    transition: 0.5s;
    /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
  }
  .navbar-dropdown {
    width: auto;
  }
}
@media (min-width: 1024px) and (max-width: 1087px) {
  .is-pulled-mobile {
    float: right !important;
  }

  .container {
    // width: 90%;
  }
  .logo_header {
    width: 100% !important;
  }
  .navbar.is-primary .navbar-burger {
    color: #363636;
  }
  .hero .navbar {
    /* width: 13%; */
    // background: #fff !important;
    // float: left;
    // z-index: 999;
    // width: 100%;
  }
  .navbar-menu {
    -webkit-box-shadow: none;
    box-shadow: none;
    padding: 0;
  }

  .navbar-menu.profile_menu {
    display: block;
  }

  .profile_menu .has-addons {
    float: left;
  }

  .logo_header_left .navbar-link {
    padding: 0px 1px;
  }
  .logo_header_left figure img {
    vertical-align: middle;
    padding-right: 2px;
  }
  .logo_header_left .navbar-link:not(.is-arrowless)::after {
    display: none;
  }
  .logo_header {
    /*      width: 100%; */
    /* float: left; */
    width: 100%;
    float: right;
    position: relative;
  }

  .search_icon {
    background-color: transparent !important;
  }

  .navbar-menu.is-active {
    position: relative;
    width: 100%;
    top: -95px;
    left: -16px;
  }
  .navbar-burger:hover {
    background-color: transparent;
  }
  .navbar {
    position: absolute;
    padding: 0px 15px;
    /* min-height: 12px !important; */

    height: 0px;
  }
  .navbar-burger {
    height: 2.2rem;
    width: 1.2rem;
    top: -40px;
    background-color: #fff !important;
  }
  .is-mobile-left {
    float: left;
  }
  .admin_name {
    width: 101px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    float: right;
    line-height: 27px;
    padding-left: 5px;
  }
}
@media (max-width: 1199px) and (min-width: 320px) {
  .flex-shrink-0 {
    display: none !important;
  }
}
@media (max-width: 1023px) and (min-width: 320px) {
  /* search box start*/
  .hero-head {
    //      position: fixed;
    // width: 100%;
    // z-index: 999;
  }
  .searchbox {
    padding: 4px 28px !important;
  }
  .searchblock {
    width: 80%;
  }

  .search_block .opensearch {
    position: absolute;
    z-index: 88888;
    width: 100%;
    padding: 11px 23px !important;
  }
  .opensearch .searchblock {
    z-index: 22222;
    position: absolute;
  }
  .opensearch .searchicon {
    z-index: 1111111;
    left: -6px;
    top: 0px;
  }
  .searchbox.opensearch,
  .search_icon {
    display: block;
    padding: 0px 11px;
  }
  .navbar.is-primary .navbar-burger {
    color: #363636;
  }
  .search_block.isopensearch {
    position: fixed;
    z-index: 9999;
  }
  .search_block.isopensearch .control {
    z-index: 9999;
  }
  #navbarBasicExample {
    //        position: fixed;
    // width: 42%;
    // height: 100vh;
    // left: 0;
    // right: 0;
    // bottom: 0;
    // top: 38px;
  }
  /* search box end*/
  .hero .navbar {
    /* width: 13%; */
    // background-color: #fff !important;
    // float: left;
    // z-index: 999;
    // width: 100%;
  }
  .navbar-menu {
    -webkit-box-shadow: none;
    box-shadow: none;
    padding: 0;
  }
  .navbar-menu.profile_menu {
    display: block;
  }

  .profile_menu .has-addons {
    float: left;
  }
  .is-pulled-mobile {
    float: left !important;
  }
  .logo_header_left .navbar-link {
    padding: 0px 1px;
  }
  .logo_header_left figure img {
    vertical-align: middle;
    padding-right: 2px;
  }
  .logo_header_left .navbar-link:not(.is-arrowless)::after {
    display: none;
  }
  .logo_header {
    /*      width: 100%; */
    /* float: left; */
    width: auto;
    float: right;
    position: relative;
  }
  .searchbox {
    display: none;
  }
  .search_icon {
    background-color: transparent !important;
  }
  .is-line-height-custom {
    display: none !important;
  }
  .navbar-brand .is-active {
    position: fixed;
    background-color: #fff !important;
    width: 160px;
    left: 0px;
  }
  .navbar-brand {
    //      background-color: #fff;
    // width: 100px;
  }
  .navbar-menu.is-active {
    // position: relative;
    // width: 127%;
    // top: -16px;
    // left: -16px;
    // overflow: auto;
    // height: 100vh;
    position: fixed;
    width: 160px;
    top: -6px;
    left: 0;
    overflow: auto;
    height: 100vh;
    transform: translate(0px, 39px);
  }
  .navbar-burger:hover {
    background-color: transparent;
  }
  .navbar {
    position: absolute;
    padding: 0px 15px;
    /* min-height: 12px !important; */

    height: 40px;
  }
  .navbar-burger {
    height: 2.2rem;
    width: 1.2rem;
  }
  .is-mobile-left {
    float: left;
  }
  .admin_name {
    width: 101px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    float: right;
    line-height: 27px;
    padding-left: 5px;
  }
  .is-active-menu {
    display: block;
  }
  .is-active-remove {
    display: none;
  }

  /* nav scroll end */
  .overlay {
    /* Height & width depends on how you want to reveal the overlay (see JS below) */
    height: 100%;
    width: 100%;
    position: fixed;
    /* Stay in place */
    z-index: 11;
    /* Sit on top */
    left: 0;
    top: 0;
    /* Black fallback color */
    background-color: rgba(0, 0, 0, 0.5);
    /* Black w/opacity */
    overflow-x: hidden;
    /* Disable horizontal scroll */
    transition: 0.5s;
    /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
  }
}
</style>

