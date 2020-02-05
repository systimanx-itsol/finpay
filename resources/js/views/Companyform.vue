<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>
    <form id="app" @submit.prevent="handleSubmit">
      <div class="container breadcrums1">
        <h6 class="form-name is-uppercase is-pulled-left is-size-6">ADD Company</h6>

        <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
          <ul>
            <li class="is-size-7">
              <a class="has-text-grey" href="#">Pages</a>
            </li>

            <li class="is-size-7 is-active">
              <a class href="#" aria-current="page">Company</a>
            </li>
          </ul>
        </nav>
      </div>

      <section class="container forms-sec has-background-white box">
        <router-link to="/Company" class="has-text-grey-dark backsection">
          <i class="fas fa-arrow-left"></i>Back
        </router-link>

        <div class="columns is-multiline is-mobile">
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Company Name
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="company_name"
                  class="input"
                  type="text"
                  v-model="company.company_name"
                  placeholder=" Name"
                  name="company_name"
                  v-validate="'required'"
                  :class="{ 'is-invalid': submitted && errors.has('company_name') }"
                />
              </p>
              <span
                v-show="errors.has('company_name')"
                class="invalid-feedback"
              >{{company_nameError}}</span>
            </div>
          </div>

          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Default Quote Template
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select
                    id="default_quote_template"
                    name="default_quote_template"
                    v-model="company.default_quote_template"
                    v-validate="'required'"
                    :class="{ 'is-invalid': submitted && errors.has('default_quote_template')}"
                  >
                    <option value="0">default.blade.php</option>
                    <option value="1">custom.blade.php</option>
                  </select>
                  <span
                    v-show="errors.has('default_quote_template')"
                    class="invalid-feedback"
                  >{{default_quote_templateError}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                City
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="city"
                  class="input"
                  type="text"
                  v-model="company.city"
                  placeholder="City"
                  name="city"
                  v-validate="'required|alpha_spaces'"
                  :class="{ 'is-invalid': submitted && errors.has('city') }"
                />
              </p>
              <span v-show="errors.has('city')" class="invalid-feedback">{{cityError}}</span>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                State
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="state"
                  class="input"
                  type="text"
                  v-model="company.state"
                  placeholder="State"
                  name="state"
                  v-validate="'required|alpha_spaces'"
                  :class="{ 'is-invalid': submitted && errors.has('state') }"
                />
              </p>
              <span v-show="errors.has('state')" class="invalid-feedback">{{stateError}}</span>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Postal Code
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="zipcode"
                  class="input"
                  type="text"
                  name="zipcode"
                  v-model="company.zipcode"
                  placeholder="zipcode"
                  v-validate="'required|numeric'"
                  pattern="[0-9]+"
                  title="Enter the valid postal number"
                  :class="{ 'is-invalid': submitted && errors.has('zipcode') }"
                />
              </p>
              <span v-show="errors.has('zipcode')" class="invalid-feedback">{{zipcodeError}}</span>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Country
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="country"
                  class="input"
                  type="text"
                  v-model="company.country"
                  placeholder="Country"
                  name="country"
                  v-validate="'required|alpha_spaces'"
                  :class="{ 'is-invalid': submitted && errors.has('country') }"
                />
              </p>
              <span v-show="errors.has('country')" class="invalid-feedback">{{countryError}}</span>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Phone Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  class="input"
                  type="text"
                  id="phone"
                  name="phone"
                  pattern="[0-9]+"
                  title="Enter the valid Phone number"
                  v-model="company.phone"
                  placeholder="Phone Number"
                />
              </p>
            </div>

            <div v-if="submitted && errors.has('phone')" class="invalid-feedback">{{invalid}}</div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Fax Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="fax"
                  class="input"
                  type="text"
                  v-model="company.fax"
                  placeholder="Fax Number"
                  name="fax"
                  pattern="[0-9]+"
                  title="Enter the valid Tax number"
                  :class="{ 'is-invalid': submitted && errors.has('fax') }"
                />
              </p>
            </div>
          </div>

          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Mobile Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="mobile"
                  class="input"
                  type="text"
                  v-model="company.mobile"
                  placeholder="Mobile Number"
                  name="mobile"
                  pattern="[0-9]+"
                  title="Enter valid phone number"
                />
              </p>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>Website Address</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="website"
                  class="input"
                  type="text"
                  v-model="company.website"
                  placeholder="Website Address"
                  name="website"
                  :class="{ 'is-invalid': submitted && errors.has('website') }"
                />
              </p>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Default Invoice Template
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select
                    id="default_invoice_template"
                    name="default_invoice_template"
                    v-model="company.default_invoice_template"
                    v-validate="'required'"
                    default="default.blade.php"
                    :class="{ 'is-invalid': submitted && errors.has('default_invoice_template') }"
                  >
                    <option value="0">default.blade.php</option>
                    <option value="1">custom.blade.php</option>
                  </select>

                  <span
                    v-show="errors.has('default_invoice_template')"
                    class="invalid-feedback"
                  >{{default_invoice_templateError}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="column is-3 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Address
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <textarea
                  id="address"
                  placeholder="Address"
                  v-model="company.address"
                  class="textarea is-small is-shadowless"
                  name="address"
                  v-validate="'required'"
                  :class="{ 'is-invalid': submitted && errors.has('address') }"
                ></textarea>
              </p>

              <span v-show="errors.has('address')" class="invalid-feedback">{{addressError}}</span>
            </div>
          </div>
        </div>

        <button class="button is-dark is-pulled-right is-small">Submit</button>
        <button1
          class="button has-background-light is-small is-pulled-right clearbuton"
          @click="resetform"
        >Clear</button1>
      </section>

      <layout-footer></layout-footer>
    </form>
  </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
import { Validator } from "vee-validate";
export default {
  data() {
    return {
      submitted: false,
      company: {
        company_name: "",
        address: "",
        default_quote_template: "0",
        city: "",
        state: "",
        zipcode: "",
        country: "",
        phone: "",
        fax: "",
        mobile: "",
        default_invoice_template: "0",
        website: ""
      },
      editMode: false,
      validalphaspaces: "Only charecters allowed",
      numberAllowed: " Only numbers allowed",
      validcompany: "Field is required",
      validaddress: "Field is required",
      validcity: "Field is required",
      validstate: "Field is required",
      validinvoicetemplate: "Field is required",
      validzipcode: "Field is required",
      validcountry: "Field is required",
      validwebsite: "Field is required",
      validquote_template: "Field is required"
    };
  },

  computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),

    company_nameError() {
      if (this.company.company_name == "") return this.validcompany;
    },

    addressError() {
      if (this.company.address == "") return this.validaddress;
    },

    default_quote_templateError() {
      if (this.company.default_quote_template == "")
        return this.validquote_template;
    },

    cityError() {
      if (this.company.city == "") return this.validcity;
      else return this.validalphaspaces;
    },

    stateError() {
      if (this.company.state == "") return this.validstate;
      else return this.validalphaspaces;
    },

    zipcodeError() {
      if (this.company.zipcode == "") return this.validzipcode;
      else return this.numberAllowed;
    },

    countryError() {
      if (this.company.country == "") return this.validcountry;
      else return this.validalphaspaces;
    },

    default_invoice_templateError() {
      if (this.company.default_invoice_template == "")
        return this.validinvoicetemplate;
    }
  },

  created: function() {
    if (this.$route.query.id != "" && this.$route.query.id != null) {
      this.getcompany();
    }
  },

  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),
    resetform() {
      this.company = {
        company_name: "",
        address: "",
        default_quote_template: "",
        city: "",
        state: "",
        zipcode: "",
        country: "",
        phone: "",
        fax: "",
        mobile: "",
        default_invoice_template: "",
        website: ""
      };
    },

    handleSubmit() {
      let context = this;
      context.setLoading(true);
      if (context.$route.query.id != "" && context.$route.query.id != null) {
        context.editMode = true;
        context.submitted = true;

        context.$validator.validate().then(valid => {
          if (valid) {
            let uri = "/Company/" + context.$route.query.id;
            axios
              .put(uri, context.company)
              .then(response => {
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: " updated successfully",
                    type: "is-danger",
                    position: "is-top-right"
                  });
                } else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: " updated successfully",
                    position: "is-top-right",
                    type: "is-success"
                  });
                }

                context.$router.push("/Company");
              })
              .finally(() => {
                context.setLoading(false);
              });
          } else {
            context.setLoading(false);
          }
        });
      } else {
        context.submitted = true;
        context.$validator.validate().then(valid => {
          if (valid) {
            let url = "/Company";

            let config = {
              headers: {
                Authorization: "Bearer " + sessionStorage.getItem("token"),
                "content-type": "multipart/form-data",
                "content-type": "application/json"
              }
            };

            let formdata = new FormData();
            formdata.append("company_name", context.company.company_name);
            formdata.append("address", context.company.address);
            formdata.append(
              "default_quote_template",
              context.company.default_quote_template
            );
            formdata.append("city", context.company.city);
            formdata.append("state", context.company.state);
            formdata.append("zipcode", context.company.zipcode);
            formdata.append("country", context.company.country);
            formdata.append("phone", context.company.phone);
            formdata.append("fax", context.company.fax);
            formdata.append("mobile", context.company.mobile);
            formdata.append(
              "default_invoice_template",
              context.company.default_invoice_template
            );
            formdata.append("website", context.company.website);

            axios
              .post(url, formdata, config)
              .then(response => {
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    type: "is-danger",
                    position: "is-top-right"
                  });
                } else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    position: "is-top-right",
                    type: "is-success"
                  });
                  context.$router.push("/Company");
                }
              })
              .finally(() => {
                context.setLoading(false);
              });
          } else {
            context.setLoading(false);
          }
        });
      }
    },

    getcompany() {
      this.setLoading(true);
      let uri = "/Company/" + this.$route.query.id;
      axios
        .get(uri)
        .then(response => {
          this.company = response.data.Companydetails;
        })
        .finally(() => {
          this.setLoading(false);
        });
    }
  },

  components: {
    LayoutHeader,
    LayoutFooter
  }
};
</script>
<style>
input.input {
  font-size: 13px !important;
  padding: 16px !important;
  border-right-color: #ddd !important;

  border-radius: 0px;
}

label {
  font-size: 14px;
  font-weight: 400;
  line-height: 2.5;
  color: #646367;
}

select {
  color: #ddd !important;
  font-size: 14px !important;
  font-weight: 400;
  height: 35px !important;
}

.select:not(.is-multiple):not(.is-loading)::after {
  top: 58% !important;

  width: 0 !important;
  border-color: #888 transparent transparent transparent !important;
  border-style: solid !important;
  border-width: 5px 4px 0 4px !important;
  height: 0 !important;
  transform: unset;
  border-radius: 0;
}

.forms-sec {
  box-shadow: 0 1px 15px 1px rgba(208, 201, 243, 0.5);
  padding: 35px;
}

select {
  color: #000 !important;
}

.invalid-feedback {
  color: red;
}
</style>