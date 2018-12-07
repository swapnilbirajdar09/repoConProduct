<title>Construction Manager | Register User</title>
<style type="text/css">
    #addProduct fieldset{
        /*display: none;*/
        margin-bottom: 16px
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="page_title">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Register User </h3>
                    </div>
                </div>             
                <form id="userRegister" ng-app="userRegisterForm" ng-cloak ng-controller="userRegisterCtrl">
                    <fieldset>
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="customer_name">Full Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="prod_type">Product Type<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="prod_type" class="form-control w3-small" id="prod_type" ng-change="prodType()" ng-model="typeSelected">
                                        <option value="0" class="w3-text-grey" selected>REGULAR</option>                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom" >
                                <div class="form-group w3-col l12">
                                    <label for="stock_plant">Stock Plant<b class="w3-text-red w3-medium">*</b> :</label>
                                    <select name="stock_plant" class="form-control w3-small" id="stock_plant">
                                        <option value="0" class="w3-text-grey w3-light-grey " selected>Please choose any one plant</option>                                        
                                    </select>
                                </div>
                                <div class="form-group w3-col l12" ng-show='plantDiv'>
                                    <label for="stock_plant">Ex-stock Quantity<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="number" min="0" class="form-control" id="exstock_quantity" ng-model="exstock_quantity" name="exstock_quantity" placeholder="Ex-stock Quantiry" >
                                </div>
                            </div>
                        </div>
                        <div class="w3-col l12">
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="product_name">Product Name/ Part Name<b class="w3-text-red w3-medium">*</b> :</label>
                                    <input type="text" class="form-control" id="product_name" ng-model="product_name" name="product_name" placeholder="Enter product name" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="divrawing_no">Drawing Number :</label>
                                    <input type="text" class="form-control" id="drawing_no" ng-model="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 w3-margin-bottom">
                                <div class="form-group">
                                    <label for="revision_no">Revision Number :</label>
                                    <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
