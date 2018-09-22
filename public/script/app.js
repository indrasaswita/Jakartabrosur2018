
require("angular");
require("angular-route");
require("angular-resource");
require("angular-cookies");
require("angular-sanitize");
require("node-gzip");
//require("ngx-pagination");


var app = require("./init");

require('./constants/variable')(app);

//require("./route")(app);

//SERVICES
//require("./services/productservice")(app);

//CONTROLLERS
//require("./controllers/offsetpricing")(app);
require("./controllers/login-modal")(app);
require("./controllers/viewfile-modal")(app);
require("./controllers/roles")(app);
require("./controllers/salespaymentconfirm")(app);
require("./controllers/salespayments")(app);
require("./controllers/order.sales.index")(app); //ALL SALES BY CUSTOMER
//require("./controllers/order.sales.history")(app); //ALL HISTORY BY CUSTOMER
require("./controllers/order.sales.commit")(app); //COMMIT DATA SEBELOM CETAK
require("./controllers/order.shop.lists.customer")(app);
require("./controllers/order.shop.calculation.customer")(app);
require("./controllers/order.shop.create.page")(app);
require("./controllers/includes.modals.compaccno")(app);
require("./controllers/home")(app);
require("./controllers/order.cart.index")(app);
require("./controllers/createheader")(app);
require("./controllers/trackingcustomer")(app);
require("./controllers/description")(app);
require("./controllers/main")(app);
require("./controllers/godhands")(app);


require("./controllers/account.profiles")(app);

//ADMIN
require("./controllers/admin.tracking.index")(app);
require("./controllers/admin.cart.index")(app);
require("./controllers/admin.cart.addbyadmin")(app);
require("./controllers/admin.sales.index")(app);
require("./controllers/admin.master.paper.index")(app);
require("./controllers/admin.master.customer.index")(app);
require("./controllers/admin.master.customer.pendingcompany")(app);



require("./controllers/aice.index")(app);

//MY JS
require("./customs/sidebar-affix")(app);
require("./customs/sticky-button")(app);
require("./customs/sticky-cart-review")(app);
require("./customs/sticky-shop-total")(app);
//require("./customs/dropzone-bootstrap")(app);

/*var Dropzone = require("./customs/dropzone");
require("./customs/dz-custom")(app, Dropzone);
Dropzone.call(this);*/

require("./directives/bootstrap-select-addon")(app);
require("./directives/bootstrap-tooltip")(app);
require("./directives/pagination/dirPagination")(app);