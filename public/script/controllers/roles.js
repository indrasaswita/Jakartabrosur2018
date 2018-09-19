module.exports = function(app){
	app.controller('RoleController', ['$scope', '$http', 'API_URL', 
		function($scope, $http, API_URL){
			$scope.rolelists = [
				{
					'label' : 'Sale',
					'value'	: 'sale',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				},
				{
					'label'	: 'Purchase',
					'value'	: 'purchase',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				},
				{
					'label'	: 'Delivery',
					'value'	: 'delivery',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				},
				{
					'label'	: 'Work Order',
					'value'	: 'workorder',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				},
				{
					'label'	: 'Customer',
					'value'	: 'customer',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				},
				{
					'label'	: 'Report',
					'value'	: 'report',
					'bool1'	: 'Allow',
					'bool2'	: 'No Allow',
					'selected' : 0
				}
			];
			$scope.URL = 'http://localhost:8000/';
			$scope.setFormValue = function($item){
				$scope.selected = $item.name;
				if ($item.sale=='0') $scope.rolelists[0].selected = 0; else $scope.rolelists[0].selected = 1;
				if ($item.purchase=='0') $scope.rolelists[1].selected = 0; else $scope.rolelists[1].selected = 1;
				if ($item.delivery=='0') $scope.rolelists[2].selected = 0; else $scope.rolelists[2].selected = 1;
				if ($item.workorder=='0') $scope.rolelists[3].selected = 0; else $scope.rolelists[3].selected = 1;
				if ($item.customer=='0') $scope.rolelists[4].selected = 0; else $scope.rolelists[4].selected = 1;
				if ($item.report=='0') $scope.rolelists[5].selected = 0; else $scope.rolelists[5].selected = 1;

				$('#btn-add').attr('hidden', 'hidden');
				$('#btn-cancel').removeAttr('hidden');
				$('#btn-update').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
				$('#form-open').attr('action', $scope.URL+'roles/'+$item.id);
				$('#form-method').val('PUT');
				$('#form-id').val($item.id);

			};
			$scope.cancelUpdate = function(){
				$('#btn-cancel').attr('hidden', 'hidden');
				$('#btn-add').removeAttr('hidden');
				$('#btn-update').removeClass('btn-primary').addClass('btn-second').attr('disabled', 'disabled');
				$('#form-open').attr('action', $scope.URL+'roles');
				$('#form-method').val('POST');
			}
		}
	]);
};