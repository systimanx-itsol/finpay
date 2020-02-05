<template>
    <section class="hero is-fullheight dashboarding is-default is-bold">
        <layout-header></layout-header>
        <head>
            <meta charset="utf-8" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1"
            />

            <title>Laravel</title>

            <!-- Fonts -->
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,600"
                rel="stylesheet"
            />

            <!-- Styles -->
        </head>
        <body>
            <div class="container indexsec">
                <div class="columns">
                      <div class="column">
                        <h1 class="is-size-3 has-text-weight-bold ">Invoicing has never been easier! Put your business on auto-pilot</h1>
                        <p class="has-text-weight-semibold has-text-justified	">
                           Make a professional invoices in a single click with our online invoice generator. Open Source, Simple one time generation and On-Prem hosting, Our tool is trusted by millions of people.<p style="    color: #205565;
    padding-left: 5px;
    font-weight: 400;">No Credit Card/Payment Require‎d

</p>
                           <ul class="is-flex ulsec">
                             <li><router-link to="/TryDemo"
                              class="button has-background-grey-darker has-text-white is-uppercase	">Generate Free
                            </router-link> </li>
                            <li><router-link to="/free"
                              class="button has-background-grey-darker has-text-white is-uppercase	">Try Demo
                            </router-link> </li>
                              
                           </ul>
                        </p>
                    </div>
                  
                    <div class="column is-7">
                        <img src="../../js/assets/indeximg.png"  style="width:100%"/>
                    </div>
                  
                </div>
            </div>
        </body>
        <layout-footer></layout-footer>
    </section>
</template>

<script>
import LayoutHeader from "./layouts/finpay.vue";
import LayoutFooter from "./layouts/Footer.vue";

import moment from "moment";
export default {
    components: {
        LayoutHeader,
        LayoutFooter
    },
    data() {
        return {
            isImageModalActive: false,
            isImageModalActive1: false,
            isImageModalActive2: false,
            submitted: false,

            data: [],
            financial: "",
            date: " ",
            newdate: " ",
            invoice_id: "",
            client_id: "",
            invoicedraft: 0,
            sentinvoice: 0,
            dashboard_details: 0,
            DueDate: 0,
            currencysymbol: "",
            currencyplacement: "",
            currencydecimal: "",
            currencythousands: "",
            dashboard: {
                client_id: "",
                invoice_template: "0",
                from_date: "",
                to_date: ""
            },
            isPublic: true,
            dropdown: "Year To Date",
            isCardModalActive: false,
            BarchartData: null,
            chartData: {
                labels: ["Green", "Red", "Blue", "Yellow"],
                datasets: [
                    {
                        label: "Data One",
                        backgroundColor: [
                            "#41B883",
                            "#E46651",
                            "#00D8FF",
                            "#ffdd57"
                        ],
                        data: [1, 10, 5, 3]
                    }
                ]
            }
        };
    },
    computed: {
        filteredCustomers: function() {
            return this.data.filter(option => {
                return (
                    option
                        .toString()
                        .toLowerCase()
                        .indexOf(this.client_id.toLowerCase()) >= 0
                );
            });
        }
    },
    mounted() {
        setInterval(this.generateData, 2000);
        // this.$router.go();
    }
};
</script>

<style>


.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    font-size: 84px;
}

.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.1rem;
    text-decoration: none;
    text-transform: uppercase;
}

.m-b-md {
    margin-bottom: 30px;
}
</style>
