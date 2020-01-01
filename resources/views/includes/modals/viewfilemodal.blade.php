

<div class="modal fade" id="viewfile-modal" ng-controller="ViewfileModal">
  <!-- <input type="hidden" value="0" ng-model="cartdetailID"> -->
  <form>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Voila!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs" ng-repeat="item in logintabs">
            <li class="nav-item">
              <a class="nav-link" ng-class="{'active' : localselected.logintab == item.value}" ng-click="setSelectedTab(item.value)">[[item.label]]</a>
            </li>
          </ul>
          <div class="clear"></div>
          <div class="alert alert-sm center [[alerttype]]" role="alert" ng-show="alertshow">
            [[alertmessage]]
          </div>
          @include('includes.viewfile')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" ng-click="loginButtonClicked()" value="OK!">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </form>
</div><!-- /.modal -->