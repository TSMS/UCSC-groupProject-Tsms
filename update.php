<?php require_once 'core/init.php'; ?>

<div class="divider"></div>
<div class="ui-tab-container col-sm-12">
    <tabset class="ui-tab">
        <tab heading="Update">
          <div class="page page-table" data-ng-controller="tableCtrl">

              <section class="panel panel-default table-dynamic">
                  <div class="panel-heading">
                    <strong><span class="glyphicon glyphicon-th"></span> Daliy Update</strong>
                  </div>
                  <!-- Datepicker -->
                    <div class="panel-body" data-ng-controller="DatepickerDemoCtrl">
                        <div class="row">
                        <div class="form-group">
                              <div class="callout callout-info">
                                    <p>Date is: {{dt | date:'fullDate'}}</p>
                                </div>
                        </div>
                        <div class="form-group col-sm-4">
                          <label>Date: </label>
                                <div class="input-group ui-datepicker">
                                    <input type="text" 
                                           class="form-control"
                                           datepicker-popup="{{format}}"
                                           ng-model="dt"
                                           is-open="opened"
                                           min="minDate"
                                           max="'2015-06-22'"
                                           datepicker-options="dateOptions" 
                                           date-disabled="disabled(date, mode)"
                                           ng-required="true" 
                                           close-text="Close">
                                    <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <form>
                           <div class="form-group">
                            <div class="col-xs-2">
                                <label>Supplier Code: </label>
                                <input class="form-control" placeholder="Sup-code" type="text">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-xs-2">
                                <label>Supplier name: </label>
                                <input class="form-control" placeholder="name" type="text">
                              </div>
                    </div>
                            <div class="form-group">
                              <div class="col-xs-2">
                                <label>Quantity: </label>
                                <input class="form-control" placeholder="qnt" type="text">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-xs-2">
                                <label>Approved kgs: </label>
                                <input class="form-control" placeholder="kgs" type="text">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-xs-2">
                                <label>supplied kgs: </label>
                                <input class="form-control" placeholder="sup-kgs" type="text">
                              </div>
                           </div>
                    <div>
                      <div class="col-xs-2">
                      </br>
                        <button type="button" class="btn btn-w-md btn-gap-v btn-success">Success</button>
                      </div>
                    </div>
                    </form>
                        </div>
                <!-- end Datepicker -->
                </section>
          </div>


          <div class="page page-table" data-ng-controller="tableCtrl">

              <section class="panel panel-default table-dynamic">
                  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Supplier tables</strong></div>

                  <div class="table-filters">
                      <div class="row">
                          <div class="col-sm-4 col-xs-6">
                              <form>
                                  <input type="text"
                                         placeholder="Search..."
                                         class="form-control"
                                         data-ng-model="searchKeywords"
                                         data-ng-keyup="search()">
                              </form>
                          </div>
                          <div class="col-sm-3 col-xs-6 filter-result-info">
                              <span>
                                  Showing {{filteredStores.length}}/{{stores.length}} entries
                              </span>              
                          </div>
                      </div>
                  </div>

                  <table class="table table-bordered table-striped table-responsive">
                      <thead>
                          <tr>
                              <th><div class="th">
                                  Store Name
                                  <span class="fa fa-angle-up"
                                        data-ng-click=" order('name') "
                                        data-ng-class="{active: row == 'name'}"></span>
                                  <span class="fa fa-angle-down"
                                        data-ng-click=" order('-name') "
                                        data-ng-class="{active: row == '-name'}"></span>
                              </div></th>
                              <th><div class="th">
                                  Price
                                  <span class="fa fa-angle-up"
                                        data-ng-click=" order('price') "
                                        data-ng-class="{active: row == 'price'}"></span>
                                  <span class="fa fa-angle-down"
                                        data-ng-click=" order('-price') "
                                        data-ng-class="{active: row == '-price'}"></span>
                              </div></th>
                              <th><div class="th">
                                  Sales (in 7 days)
                                  <span class="fa fa-angle-up"
                                        data-ng-click=" order('sales') "
                                        data-ng-class="{active: row == 'sales'}"></span>
                                  <span class="fa fa-angle-down"
                                        data-ng-click=" order('-sales') "
                                        data-ng-class="{active: row == '-sales'}"></span>
                              </div></th>
                              <th><div class="th">
                                  Rating
                                  <span class="fa fa-angle-up"
                                        data-ng-click=" order('rating') "
                                        data-ng-class="{active: row == 'rating'}"></span>
                                  <span class="fa fa-angle-down"
                                        data-ng-click=" order('-rating') "
                                        data-ng-class="{active: row == '-rating'}"></span>
                              </div></th>
                          </tr>
                      </thead>
                      <tbody>

<?php
$user = new User();
$name = DB::getInstance()->getall('suppliers');
if(!$name->count()){
    echo 'No user';
}else{
    foreach ($name->results() as $name){
?>

                          <tr data-ng-repeat="store in currentPageStores">
                              <td><?php echo $name->supplier_code; ?></td>
                              <td><?php echo $name->f_name; ?></td>
                              <td><?php echo $name->l_name; ?></td>
                              <td><?php echo $name->address_1; ?></td>
                          </tr>
<?php 
}
}
?>
                      </tbody>
                  </table>

                  <footer class="table-footer">
                      <div class="row">
                          <div class="col-md-6 page-num-info">
                              <span>
                                  Show 
                                  <select data-ng-model="numPerPage"
                                          data-ng-options="num for num in numPerPageOpt"
                                          data-ng-change="onNumPerPageChange()">
                                  </select> 
                                  entries per page
                              </span>
                          </div>
                          <div class="col-md-6 text-right pagination-container">
                              <pagination class="pagination-sm"
                                          ng-model="currentPage"
                                          total-items="filteredStores.length"
                                          max-size="4"
                                          ng-change="select(currentPage)"
                                          items-per-page="numPerPage"
                                          rotate="false"
                                          previous-text="&lsaquo;" next-text="&rsaquo;"
                                          boundary-links="true"></pagination>
                          </div>
                      </div>
                  </footer>
              </section>

          </div>

        </tab>
        <tab heading="Supplier Request">Quod ea vel dolores earum veritatis quae sunt tempore odit molestias sit optio quaerat cupiditate iure repudiandae illum doloremque consectetur incidunt!</tab>
        <tab heading="View details">Blanditiis tenetur harum distinctio voluptate asperiores non magnam delectus. Consequatur, deleniti rem magnam possimus necessitatibus iusto suscipit mollitia rerum.</tab>
    </tabset>
</div>
