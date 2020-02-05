<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Currencies</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Currencies</a>
          </li>
        </ul>
      </nav>
    </div>

    <section class="container forms-sec has-background-white box">
      <a href="Currencies" class="has-text-grey-dark backsection">
        <i class="fas fa-arrow-left"></i>Back
      </a>
      <form app="id" @submit.prevent="handleSubmit">
        <div class="columns is-multiline is-mobile">
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Name
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  class="input"
                  id="name"
                  name="name"
                  v-model="currencies.name"
                  v-validate="'required|alpha_spaces'"
                  type="text"
                  placeholder="Name"
                />
              </p>

              <span v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Symbol Placement
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select
                    id="placement"
                    name="placement"
                    v-model="currencies.placement"
                    v-validate="'required'"
                  >
                    <option value="0">Before Amount</option>
                    <option value="1">After Amount</option>
                  </select>

                  <span v-show="errors.has('placement')" class="invalid-feedback">{{placementError}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Code
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="code"
                  name="code"
                  v-model="currencies.code"
                  v-validate="'required'"
                  class="input"
                  type="text"
                  placeholder="Code"
                />
              </p>
              <span v-show="errors.has('code')" class="invalid-feedback">{{codeError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Decimal Point
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="decimal"
                  class="input"
                  type="text"
                  name="decimal"
                  v-model="currencies.decimal"
                  v-validate="'required'"
                  placeholder="Decimal Point"
                />
              </p>

              <span v-show="errors.has('decimal')" class="invalid-feedback">{{decimalError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Symbol
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  class="input"
                  id="symbol"
                  name="symbol"
                  type="text"
                  v-model="currencies.symbol"
                  v-validate="'required'"
                  placeholder="Symbol"
                />
              </p>

              <span v-show="errors.has('symbol')" class="invalid-feedback">{{symbolError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Thousands Separator
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="thousands"
                  class="input"
                  type="text"
                  name="thousands"
                  v-model="currencies.thousands"
                  v-validate="'required'"
                  placeholder="Thousands Separator"
                />
              </p>

              <span v-show="errors.has('thousands')" class="invalid-feedback">{{thousandsError}}</span>
            </div>
          </div>
        </div>

        <button type="submit" class="button is-dark is-pulled-right is-small">Submit</button>
        <button4
          class="button has-background-light is-small is-pulled-right clearbuton"
          @click="clear"
        >Clear</button4>
      </form>
    </section>

    <layout-footer></layout-footer>
  </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import { Validator } from "vee-validate";
export default {
  components: {
    LayoutHeader,
    LayoutFooter
  },
  name: "app",

  data() {
    return {
      submitted: false,
      //  loading:false,
      currencies: {
        name: "",
        code: "",
        symbol: "",
        placement: "",
        decimal: "",
        thousands: ""
      },
      editMode: false,

      validalphaspaces: "Only alphabet value accepted",
      numberAllowed: "Only numeric value accepted",
      validname: "Name is required",
      validsymbol: "Symbol is required",
      validplacement: "Placement is required",
      validdecimal: "Decimal is required",
      validcode: "Code is required",
      validthousands: "Thousands is required"
    };
  },
  computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
    nameError() {
      if (this.currencies.name == "") return this.validname;
      else return this.validalphaspaces;
    },
    decimalError() {
      if (this.currencies.decimal == "") return this.validdecimal;
      else return this.numberAllowed;
    },
    symbolError() {
      if (this.currencies.symbol == "") return this.validsymbol;
    },
    placementError() {
      if (this.currencies.placement == "") return this.validplacement;
    },
    codeError() {
      if (this.currencies.code == "") return this.validcode;
    },
    thousandsError() {
      if (this.currencies.thousands == "") return this.validthousands;
    }
  },

  mounted: function() {
    if (this.$route.query.id != "" && this.$route.query.id != null)
      this.editgetcurrency();
  },

  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    clear() {
      this.currencies = {
        name: "",
        code: "",
        symbol: "",
        placement: "",
        decimal: "",
        thousands: ""
      };
    },

    // doSomething() {
    //   // we only continue if not clicked before
    //   if (this.submitted) {
    //     return;
    //   }
    //   this.submitted = true;

    //   // do something to process the like

    //   // at some point release the 'clicked' state
    //   this.submitted = false;

    //   // or if you want to release the clicked state after a second (for whatever reason)
    //   setTimeout(
    //     function() {
    //       this.submitted = false;
    //     }.bind(this),
    //     1000
    //   );
    // },

    handleSubmit(e) {
      //alert("sdsds");
      let context = this;
      context.submitted = true;
      if (context.$route.query.id != "" && context.$route.query.id != null) {
        context.editMode = true;
        context.setLoading(true);

        context.$validator.validate().then(valid => {
          if (valid) {
            let url = "/Currencies/" + context.$route.query.id;

            axios
              .put(url, context.currencies)
              .then(response => {
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "updated success",
                    type: "is-success",
                    position: "is-top-right"
                  });
                  context.$router.push("/currencies");
                } else {
                  context.$buefy.toast.open({
                    duration: 1000,
                    message: response.data.message,
                    title: "updated failed",
                    position: "is-top-right",
                    type: "is-danger"
                  });
                }
              })
              .catch(error => {
                console.log(error);
              })
              .finally(() => {
                context.setLoading(false);
              });
          }
        });
      } else {
        context.submitted = true;
        context.setLoading(true);
        context.$validator.validate().then(valid => {
          // alert(JSON.stringify(valid));
          if (valid) {
            let url = "/Currencies";
            //  context.loading=true;
            let config = {
              headers: {
                Authorization: "Bearer " + sessionStorage.getItem("token"),
                "content-type": "multipart/form-data",
                "content-type": "application/json"
              }
            };
            let formdata = new FormData();
            formdata.append("name", context.currencies.name);
            formdata.append("code", context.currencies.code);
            formdata.append("symbol", context.currencies.symbol);
            formdata.append("decimal", context.currencies.decimal);
            formdata.append("thousands", context.currencies.thousands);
            formdata.append("placement", context.currencies.placement);
            axios
              .post(url, formdata, config)
              .then(response => {
                //  console.log(response.data.status)
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    type: "is-success",
                    position: "is-top-right"
                  });
                  context.$router.push("/currencies");
                } else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: "submitted failed",
                    position: "is-top-right",
                    type: "is-danger"
                  });
                }
              })

              .catch(error => {
                console.log(error);
              })

              .finally(() => {
                context.setLoading(false);
              });

            // .finally(()=>{
            //   context.loading=false;
            // });
          }
          context.setLoading(false);
        });
      }
    },
    editgetcurrency() {
      this.setLoading(true);
      let url = "/Currencies/" + this.$route.query.id;
      axios
        .get(url)
        .then(response => {
          this.currencies = response.data.currency_methodDetails;
        })
        .finally(() => {
          this.setLoading(false);
        });
    }
  }
};
</script>