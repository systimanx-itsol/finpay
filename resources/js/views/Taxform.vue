<template>
  <section class="hero is-fullheight is-default is-bold">
    <layout-header></layout-header>

    <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">Add Tax</h6>

      <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Tax Rates</a>
          </li>
        </ul>
      </nav>
    </div>

    <section class="container forms-sec has-background-white box">
      <a href="/Tax" class="has-text-grey-dark backsection">
        <i class="fas fa-arrow-left"></i>Back
      </a>
      <form id="app" @submit.prevent="handleSubmit" validate>
        <div class="columns is-multiline is-mobile">
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Tax Rate Name
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  id="name"
                  class="input"
                  type="text"
                  v-model="tax.name"
                  name="name"
                  placeholder="Tax Rate Name"
                  v-validate="'required'"
                  :class="{ 'is-invalid': submitted && errors.has('name') }"
                />
              </p>
              <span v-show="errors.has('name')" class="invalid-feedback">{{nameError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Compound
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select
                    id="compound"
                    v-model="tax.compound"
                    name="compound"
                    v-validate="'required'"
                    :class="{ 'is-invalid': submitted && errors.has('compound') }"
                  >
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                  <span v-show="errors.has('compound')" class="invalid-feedback">{{compoundError}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Tax Rate Percent
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  class="input"
                  id="percentage"
                  type="text"
                  v-model="tax.percentage"
                  name="percentage"
                  placeholder="Tax Rate Percent"
                  v-validate="'required'"
                  pattern="^(\d*\.)?\d+$"
                  title="Enter the percentage"
                  :class="{ 'is-invalid': submitted && errors.has('percentage') }"
                />
              </p>
              <span v-show="errors.has('percentage')" class="invalid-feedback">{{percentageError}}</span>
            </div>
          </div>
          <div class="column is-4 is-12-mobile">
            <p class="bd-notification is-info">
              <label>
                Calculate as VAT/GST
                <span class="has-text-danger">*</span>
              </label>
            </p>
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select
                    id="calculate_as_vat_gst"
                    v-model="tax.calculate_as_vat_gst"
                    name="calculate_as_vat_gst"
                    v-validate="'required'"
                    :class="{ 'is-invalid': submitted && errors.has('calculate_as_vat_gst') }"
                  >
                    <option value="0">VAT</option>
                    <option value="1">GST</option>
                  </select>

                  <span
                    v-show="errors.has('calculate_as_vat_gst')"
                    class="invalid-feedback"
                  >{{calculate_as_vat_gstError}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button class="button is-dark is-pulled-right is-small">Submit</button>
        <button1
          class="button has-background-light is-small is-pulled-right clearbuton"
          @click="resetform"
        >Clear</button1>
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
  data() {
    return {
      loading: true,
      submitted: false,
      tax: {
        name: "",
        compound: "",
        percentage: "",
        calculate_as_vat_gst: "0"
      },

      submitted: false,
      validname: "Field is required ",

      numberAllowed: "only numbers allowed"

      //validfield: " please enter the name",

      // validoption3: "select the option"
    };
  },
  computed: {
    ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
    nameError() {
      if (this.tax.name == "") return this.validname;
    },

    compoundError() {
      if (this.tax.compound == "") return this.validname;
    },

    percentageError() {
      if (this.tax.percentage == "") return this.validname;
      else return this.numberAllowed;
    },

    calculate_as_vat_gstError() {
      if (this.tax.calculate_as_vat_gst == "") return this.validname;
    }
  },

  created: function() {
    if (this.$route.query.id != "" && this.$route.query.id != null)
      this.gettax();
  },

  methods: {
    ...mapActions({
      setLoading: "setLoading"
    }),

    // doSomething() {
    //   if (this.submitted) {
    //     return;
    //   }
    //   this.submitted = true;

    //   this.submitted = false;

    //   setTimeout(
    //     function() {
    //       this.submitted = false;
    //     }.bind(this),
    //     1000
    //   );
    // },

    resetform() {
      this.tax = {
        name: "",
        compound: "",
        percentage: "",
        calculate_as_vat_gst: ""
      };
    },

    handleSubmit(e) {
      let context = this;
      if (context.$route.query.id != "" && context.$route.query.id != null) {
        context.editMode = true;
        context.setLoading(true);
        context.$validator.validate().then(valid => {
          if (valid) {
            let uri = "/Taxrate/" + context.$route.query.id;
            //console.log(context.item.cost)
            axios
              .put(uri, context.tax)
              .then(response => {
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: " updated successfully",
                    position: "is-top-right",
                    type: "is-success"
                  });

                  context.$router.push("/Tax");
                } else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    title: " updated successfully",
                    type: "is-danger",
                    position: "is-top-right"
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
          context.setLoading(false);
        });
      } else {
        context.submitted = true;
        context.setLoading(true);
        context.$validator.validate().then(valid => {
          if (valid) {
            let url = "/Taxrate";
            let config = {
              headers: {
                Authorization: "Bearer " + sessionStorage.getItem("token"),
                "content-type": "multipart/form-data",
                "content-type": "application/json"
              }
            };

            let formdata = new FormData();
            formdata.append("name", context.tax.name);
            formdata.append("compound", context.tax.compound);
            formdata.append("percentage", context.tax.percentage);
            formdata.append(
              "calculate_as_vat_gst",
              context.tax.calculate_as_vat_gst
            );

            axios
              .post(url, formdata, config)
              .then(response => {
                // console.log(response);
                //alert(11111);
                if (response.data.status == 1) {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    position: "is-top-right",
                    type: "is-success"
                  });
                  context.$router.push("/Tax");
                } else {
                  context.$buefy.toast.open({
                    duration: 4000,
                    message: response.data.message,
                    type: "is-danger",
                    position: "is-top-right"
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
          context.setLoading(false);
        });
      }
    },

    gettax() {
      this.setLoading(true);
      let uri = "/Taxrate/" + this.$route.query.id;
      axios
        .get(uri)
        .then(response => {
          this.tax = response.data.TaxRateDetails;
        })
        .finally(() => {
          this.setLoading(false);
        });
    },
    updatetax() {
      this.editMode = true;
      this.setLoading(true);
      let uri = "/Taxrate/" + this.$route.query.id;
      //console.log(this.item.cost)
      axios
        .put(uri, this.tax)
        .then(response => {
          this.$router.push({
            company_name: this.tax.name,
            address: this.tax.percentage,
            city: this.tax.calculate_as_vat_gst,
            state: this.tax.compound
          });
          // alert(response.data.message)
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
