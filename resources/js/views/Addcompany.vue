<template>
  <section class="hero is-fullheight is-default is-bold">
    <form id="app" @submit.prevent="handleSubmit" novalidate>
      <layout-header></layout-header>

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

        <div class="columns">
          <div class="column">
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
                />
              </p>
            </div>

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
                ></textarea>
              </p>
            </div>

            <p class="bd-notification is-info">
              <label>
                Default Quote Template
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select id="default_quote_template" name="default_quote_template">
                    <option value>default.blade.php</option>
                    <option value>custom.blade.php</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="column">
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
                />
              </p>
            </div>

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
                />
              </p>
            </div>

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
                  v-model="company.zipcode"
                  placeholder="zipcode"
                />
              </p>
            </div>
          </div>
          <div class="column">
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
                />
              </p>
            </div>

            <p class="bd-notification is-info">
              <label>Phone Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="phone"
                  class="input"
                  type="text"
                  v-model="company.phone"
                  placeholder="Phone Number"
                  name="phone"
                />
              </p>
            </div>

            <p class="bd-notification is-info">
              <label>Fax Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="fax"
                  class="input"
                  type="text"
                  v-model="fax"
                  placeholder="Fax Number"
                  name="fax"
                />
              </p>
            </div>
          </div>
          <div class="column">
            <p class="bd-notification is-info">
              <label>Mobile Number</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="mobile"
                  class="input"
                  type="text"
                  v-model="mobile"
                  placeholder="Mobile Number"
                  name="mobile"
                />
              </p>
            </div>

            <p class="bd-notification is-info">
              <label>Website Address</label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="website"
                  class="input"
                  type="text"
                  v-model="website"
                  placeholder="Website Address"
                  name="website"
                />
              </p>
            </div>

            <p class="bd-notification is-info">
              <label>
                Default Invoice Template
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select id="Default Invoice Template" name="default_invoice_template">
                    <option value>default.blade.php</option>
                    <option value>custom.blade.php</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button class="button is-dark is-pulled-right is-small">Submit</button>
        <button class="button has-background-light is-small is-pulled-right clearbuton">Clear</button>
      </section>

      <layout-footer></layout-footer>
    </form>
  </section>
</template>

<script>
import LayoutHeader from "./layouts/Header.vue";
import LayoutFooter from "./layouts/Footer.vue";
export default {
  data() {
    return {
      company: [
        {
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
        }
      ],
      submitted: false,
      validAlphaSpaces: "The field is required ",

      validfield: " please enter the item",
      validfield2: " please enter the cost",
      validfield3: "please enter the quantity"
    };
  },

  methods: {
    handleSubmit(e) {
      this.submitted = true;
      this.$validator.validate().then(valid => {
        if (valid) {
          let url = "/Company";
          let config = {
            headers: {
              "content-type": "application/json"
            }
          };

          let formdata = new FormData();
          formdata.append("company_name", this.company.company_name);
          formdata.append("address", this.company.address);
          formdata.append(
            "default_quote_template",
            this.company.default_quote_template
          );
          formdata.append("city", this.company.city);
          formdata.append("state", this.company.state);
          formdata.append("zipcode", this.company.zipcode);
          formdata.append("country", this.company.country);
          formdata.append("phone", this.company.phone);
          formdata.append("fax", this.company.fax);
          formdata.append("mobile", this.company.mobile);
          formdata.append(
            "default_invoice_template",
            this.company.default_invoice_template
          );
          formdata.append("website", this.company.website);

          axios
            .post(url, formdata, config)
            .then(response => {
              // console.log(response);
              //alert(11111);
              if (response.status === 1) {
                alert("success");
                this.company = "";
              } else {
                alert("success");
              }
            })
            .catch(error => {
              if (error.response.data.errors) {
                alert(error.response.data.errors);
              }
            });
        }
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
</style>
