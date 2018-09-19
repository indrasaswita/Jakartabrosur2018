module.exports = function(app){
	app.controller('HomePageController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.offsetdata = [
				{
					name:"Flyer",
					minqty:"> 200 lembar",
					proses:"> 1 hari"
				},
				{
					name:"Brosur Lipat",
					minqty:"> 200 lembar",
					proses:"> 2 hari"
				},
				{
					name:"Poster",
					minqty:"> 150 lembar",
					proses:"> 1 hari"
				},
				{
					name:"Kartu Nama",
					minqty:"> 30 box",
					proses:"> 1 hari"
				},
				{
					name:"Amplop",
					minqty:"> 500 lembar",
					proses:"> 3 hari"
				},
				{
					name:"Booklet",
					minqty:"> 150 buku",
					proses:"> 4 hari"
				},
				{
					name:"Paper Bag",
					minqty:"> 500 pcs",
					proses:"> 4 hari"
				},
				{
					name:"Paper Box",
					minqty:"> 500 pcs",
					proses:"> 4 hari"
				},
				{
					name:"Paper Hang Tag",
					minqty:"> 5000 pcs",
					proses:"> 2 hari"
				},
				{
					name:"Hanging Banner",
					minqty:"> 5000 pcs",
					proses:"> 2 hari"
				},
				{
					name:"Sticker Vinyl",
					minqty:"> 150 lembar",
					proses:"> 3 hari"
				},
				{
					name:"Sticker Cromo",
					minqty:"> 200 lembar",
					proses:"> 1 hari"
				},
				{
					name:"Yupo (Newtop)",
					minqty:"> 200 lembar",
					proses:"> 1 hari"
				},
				{
					name:"ID Card & RFID",
					minqty:"> 500 lembar",
					proses:"> 6 hari"
				}
			];

			$scope.digitaldata = [
				{
					name:"Flyer",
					minqty:"1-200 lembar",
					proses:"bisa ditunggu"
				},
				{
					name:"Brosur Lipat",
					minqty:"1-150 buku",
					proses:"bisa ditunggu"
				},
				{
					name:"Menu",
					minqty:"1-50 set",
					proses:"bisa ditunggu"
				},
				{
					name:"Poster",
					minqty:"1-150 lembar",
					proses:"bisa ditunggu"
				},
				{
					name:"Kartu Nama",
					minqty:"1-20 box",
					proses:"bisa ditunggu"
				},
				{
					name:"Booklet",
					minqty:"1-50 buku",
					proses:"bisa ditunggu"
				},
				{
					name:"Sticker Vinyl",
					minqty:"1-100 lembar",
					proses:"bisa ditunggu"
				},
				{
					name:"Sticker Cromo",
					minqty:"1-100 lembar",
					proses:"bisa ditunggu"
				},
				{
					name:"Sticker Label",
					minqty:"1-500 pcs",
					proses:"bisa ditunggu"
				},
				{
					name:"Paper Hang Tag",
					minqty:"1-200 lembar",
					proses:"> 2 hari"
				},
				{
					name:"Hanging Banner",
					minqty:"1-150 lembar",
					proses:"> 2 hari"
				},
				{
					name:"ID Card Digital",
					minqty:"1-200 lembar",
					proses:"> 3 hari"
				}
			];
		}
	]);
};