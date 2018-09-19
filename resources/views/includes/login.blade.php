

<div class="login-input">
  <div class="input-group" >
    <span class="input-group-addon" id="basic-addon1">@</span>
    <input type="text" id="login-username" class="form-control" data-toggle="tooltip" data-placement="right" title="email@example.com" placeholder="Email Anda" ng-model="customerData.email" name="email">
</div>
  <div class="input-group">
    <input type="password" id="login-password" class="form-control" data-toggle="tooltip" data-placement="right" title="min. 6 digits" placeholder="Password Anda" ng-model="customerData.password" name="password">
  </div>
  <div>
    Jika belum punya account?<br />Silahkan <a href="" ng-click="localselected.logintab='register'">Sign-up</a> disini!
  </div>
</div>