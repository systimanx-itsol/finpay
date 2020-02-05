<template>
  <div>
    <layout-finpay></layout-finpay>
    <div class="container freepage">
      <div class="columns is-multiline">
        <div class="column is-4">
          <h1>Thank you for sign up!</h1>
          <p>
            FinPay Invoicing software made for small businesses and
            freelancers. Send unlimited, professional invoices.
          </p>
        </div>
        <div class="column is-8">
          <section>
            <div class="message">
              <!-- <div class="message-header">
                                <p>context is a div.message</p>
              </div>-->
              <div class="message-body">
                <b-tabs type="is-toggle">
                  <b-tab-item>
                    <template slot="header">
                      <p class="is-uppercase is-size-6-mobile">Private</p>
                      <h6 class="is-size-7-mobile">For Personal and Freelancer</h6>
                    </template>
                    <form id="app" @submit.prevent="handleSubmit">
                      <div class="columns is-multiline">
                        <div class="column is-6">
                          <input type="text" name="name" placeholder="Company" disabled />
                        </div>
                        <div class="column is-6">
                          <input
                            type="text"
                            name="name"
                            placeholder="Name"
                            id="name"
                            v-model="trydemoPrivate.name"
                          />
                        </div>
                        <div class="column is-6">
                          <input
                            type="text"
                            name="email"
                            placeholder="Email"
                            id="email"
                            v-model="trydemoPrivate.email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            title="Enter the valid e-mail"
                          />
                        </div>
                      </div>
                      <button
                        class="button has-background-grey-darker has-text-white is-pulled-right"
                      >Try Now</button>
                    </form>
                  </b-tab-item>

                  <b-tab-item>
                    <template slot="header">
                      <p class="is-uppercase is-size-6-mobile">Company</p>
                      <h6 class="is-size-7-mobile">For Business</h6>
                    </template>
                    <form id="app" @submit.prevent="tryDemoCompany">
                      <div class="columns is-multiline">
                        <div class="column is-6">
                          <input
                            type="text"
                            name="company"
                            placeholder="Company"
                            id="company"
                            v-model="trydemoCompany.company"
                          />
                        </div>
                        <div class="column is-6">
                          <input
                            type="text"
                            name="name"
                            placeholder="Name"
                            id="name"
                            v-model="trydemoCompany.name"
                          />
                        </div>
                        <div class="column is-6">
                          <input
                            type="text"
                            name="email"
                            placeholder="Email"
                            id="email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            title="Enter the valid e-mail"
                            v-model="trydemoCompany.email"
                          />
                        </div>
                      </div>
                      <button
                        class="button has-background-grey-darker has-text-white is-pulled-right"
                      >Try Now</button>
                    </form>
                  </b-tab-item>
                </b-tabs>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <layout-footer></layout-footer>
  </div>
</template>
<script>
import { mapState, mapActions, mapGetters } from "vuex";
import LayoutFinpay from "./layouts/finpay.vue";
import LayoutFooter from "./layouts/Footer.vue";

export default {
  components: {
    LayoutFinpay,
    LayoutFooter
  },
  data() {
    return {
      trydemoPrivate: {
        name: "",
        email: ""
      },
      trydemoCompany: {
        company: "",
        name: "",
        email: ""
      }
    };
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
    handleSubmit() {
      let context = this;
      context.setLoading(true);
      context.$validator.validate().then(valid => {
        if (valid) {
          let url = "/TryDemo";
          let config = {
            headers: {
              "content-type": "application/json"
            }
          };
          if (
            context.trydemoPrivate.name == "" ||
            context.trydemoPrivate.email == ""
          ) {
            context.$buefy.toast.open({
              duration: 4000,
              message: "Name/Email field is required",
              type: "is-danger",
              position: "is-top-right"
            });
          } else {
            let formdata = new FormData();

            formdata.append("name", context.trydemoPrivate.name);
            formdata.append("email", context.trydemoPrivate.email);
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
                  context.$router.push("/invoicetry");
                }
              })
              .finally(() => {
                context.setLoading(false);
              });
          }
          context.setLoading(false);
        }
        context.setLoading(false);
      });
    },

    tryDemoCompany() {
      let context = this;
      context.setLoading(true);
      context.$validator.validate().then(valid => {
        if (valid) {
          let url = "/TryDemoCompany";
          let config = {
            headers: {
              "content-type": "application/json"
            }
          };
          if (
            context.trydemoCompany.company == "" ||
            context.trydemoCompany.name == "" ||
            context.trydemoCompany.email == ""
          ) {
            context.$buefy.toast.open({
              duration: 4000,
              message: "Company/Name/Email field is required",
              type: "is-danger",
              position: "is-top-right"
            });
          } else {
            let formdata = new FormData();

            formdata.append("company", context.trydemoCompany.company);
            formdata.append("name", context.trydemoCompany.name);
            formdata.append("email", context.trydemoCompany.email);
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
                  context.$router.push("/invoicetry");
                }
              })
              .finally(() => {
                context.setLoading(false);
              });
          }
          context.setLoading(false);
        }
        context.setLoading(false);
      });
    }
  }
};
</script>
