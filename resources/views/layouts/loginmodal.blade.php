

<div class="modal fade" id="loginModal" ng-controller="LoginModal">
  <form>
    <div class="modal-dialog modal-sm" id="loginModalSize" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">An access to your account!</h4>
        </div> -->
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
          <div ng-show="localselected.logintab=='login'">
          @include('includes.login')
          </div>
          <div ng-show="localselected.logintab=='register'" class="size-14">
          @include('includes.signup')
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-purple" ng-click="loginButtonClicked()" value="OK!">
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </form>
</div><!-- /.modal -->