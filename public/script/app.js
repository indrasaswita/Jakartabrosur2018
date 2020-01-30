
require("angular");
require("angular-route");
require("angular-resource");
require("angular-cookies");
require("angular-sanitize");
require("node-gzip");
//require("ngx-pagination");


var app = require("./init");

require('./constants/variable')(app);
require('./constants/analytics')(app);

require('./constants/mandiri_loginmerged2')(app);
require('./constants/logo-for-print')(app);


app.LZUTF8 = require("lzutf8");
app.isBase64 = require("is-base64");

//require("./route")(app);


//CONTROLLERS
require("./controllers/global.nav.header")(app);
require("./controllers/roles")(app);
require("./controllers/salespaymentconfirm")(app);
require("./controllers/salespayments")(app);
require("./controllers/order.sales.index")(app); //ALL SALES BY CUSTOMER
require("./controllers/order.sales.modal.changefile")(app);
require("./controllers/order.sales.modal.showpreview")(app);
require("./controllers/order.sales.modal.cust-selectbank")(app);
require("./controllers/order.sales.modal.confirm")(app);
require("./controllers/order.sales.commit")(app); //COMMIT DATA SEBELOM CETAK
require("./controllers/order.shop.lists.customer")(app);
require("./controllers/order.shop.calculation.customer")(app);
require("./controllers/order.shop.create.page")(app);
require("./controllers/includes.modals.compaccno")(app);
require("./controllers/includes.nav.subnav")(app);
require("./controllers/home")(app);
require("./controllers/order.cart.index")(app);
require("./controllers/order.cart.modal.changefile")(app);
require("./controllers/order.cart.modal.addfile")(app);
require("./controllers/account.notification")(app);
require("./controllers/account.profiles")(app);
require("./controllers/account.resendemail")(app);
require("./controllers/account.login")(app);
require("./controllers/account.signup")(app);
require("./controllers/createheader")(app);
require("./controllers/trackingcustomer")(app);
require("./controllers/description")(app);
require("./controllers/main")(app);
require("./controllers/godhands")(app);
require("./controllers/order.sales.history")(app);

//ADMIN + CUSTOMER ORDER
require("./controllers/allacc.sales.cartheader")(app);
require("./controllers/allacc.printforms.smallinvoice")(app);

//ADMIN
require("./controllers/admin.tracking.index")(app);
require("./controllers/admin.cart.index")(app);
require("./controllers/admin.cart.joincart")(app);
require("./controllers/admin.cart.addbyadmin")(app);
require("./controllers/admin.master.verifcustomer")(app);
require("./controllers/admin.sales.index")(app);
require("./controllers/admin.sales.index.modal-manualpayment")(app);
require("./controllers/admin.sales.index.modal-addprooffile")(app);
require("./controllers/admin.sales.index.modal-adddelivery")(app);
require('./controllers/admin.master.compaccs.index')(app);
require('./controllers/admin.master.calendar.index')(app);
require("./controllers/admin.master.paper.changeprice")(app);
require("./controllers/admin.master.paper.newpaper")(app);
require("./controllers/admin.master.paper.paperdetailstore")(app);
require("./controllers/admin.master.jobeditor")(app);
require("./controllers/admin.master.jobactivation")(app);
require("./controllers/admin.master.jobfinishings")(app);
require("./controllers/admin.master.jobpapers")(app);
require("./controllers/admin.master.jobquantities")(app);
require("./controllers/admin.master.jobsizes")(app);
require("./controllers/admin.master.pricetext.index")(app);
require("./controllers/admin.master.customer.index")(app);
require("./controllers/admin.master.customer.pendingcompany")(app);
require("./controllers/admin.master.customer.addusernopass")(app);
require("./controllers/admin.master.shoppricing")(app);
require("./controllers/admin.master.finishing.index")(app);
require("./controllers/admin.master.vendor.index")(app);
require("./controllers/admin.changetheworld.index")(app);
require("./controllers/admin.master.onesignal.index")(app);
require("./controllers/global.includes.floatingcontact")(app);



require("./controllers/aice.index")(app);

//MY JS
// require("./customs/sidebar-affix")(app);
// require("./customs/sticky-button")(app);
// require("./customs/sticky-cart-review")(app);
require("./customs/sticky-shop-total")(app);

require("./directives/bootstrap-select-addon")(app);
require("./directives/bootstrap-tooltip")(app);
require("./directives/pagination/dirPagination")(app);